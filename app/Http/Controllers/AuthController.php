<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function Test(Request $request){
        return response()->json([
            'success'=>true,
            'message'=>'api is running'
        ]);
    }
    public function Register(Request $request)
    {

        $validator = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|same:password',
            'password_confirm' => 'required|same:password'
        ]);
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] = $user->createToken('application.token')->accessToken;
        $success['name'] =  $user->name;
        $user = User::where('email',$request['email'])->first();
        return response()->json([
            'token'=>$success['token'],
            'name'=>$success['name'],
            'user'=>$user
        ]);
    }
    public function Login(Request $request){
        $email = $request->email;
        $password = $request->password;


        $user = User::where('email',$email)->first();
        if($user){
            if(Hash::check($password,$user->password)){

                $token = $user->createToken('application.token')->accessToken;
                $userID = $user->id;
                $profile = User::where('id', $userID)->get();

                $result = array ('user'=>$profile);

                return response()->json([
                    'success'=>true,
                    'token'=>$token,
                    'name'=>$user->name,
                    'user_info'=>$result

                ]);

            }
            return response()->json([
                'success'=>false,
                'message'=>'Пароль неверен'
            ]);
        }else{
            return response()->json([
                'success'=>false,
                'message'=>'Пользователь не найден'
            ]);
        }
    }
    public function Logout(Request $request){
        $request->user()->token()->revoke();

        return response()->json([
            'success'=>true,
            'message' => 'You are successfully logged out',
        ]);
    }

}
