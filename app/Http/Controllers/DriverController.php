<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\driver;
use App\Models\auto_drivers;

class DriverController extends Controller
{
    public function get(Request $request){
        if(isset($request->id) and !empty($request->id)){
            return driver::where('id',$request->id)->firstOrFail();
        }else{
            return driver::all();
        }
    }

    public function create(Request $request){
        $validator = $request->validate([
            'name'      => 'required',
            'birthday'  => 'required',
            'cart_num'  => 'required',
            'cart_data' => 'required',
        ]);
            $driver = new driver;
            $driver->name      = $request->name;
            $driver->birthday  = $request->birthday;
            $driver->cart_num  = $request->cart_num;
            $driver->cart_data = $request->cart_data;
            if($driver->save()){
                return response()->json(['success'=>true]);
            }
            else{
                return response()->json(['success'=>false]);
            }
    }

    public function update(Request $request){
        $validator = $request->validate([
            'id' => 'required',
        ]);
            $driver = driver::where('id', $request->id)->firstOrFail();
            if(isset($request->name) and !empty($request->name)){
                $driver->name = $request->name;
            }
            if(isset($request->birthday) and !empty($request->birthday)){
                $driver->birthday = $request->birthday;
            }
            if(isset($request->cart_num) and !empty($request->cart_num)){
                $driver->cart_num = $request->cart_num;
            }
            if(isset($request->cart_data) and !empty($request->cart_data)){
                $driver->cart_data = $request->cart_data;
            }
            if($driver->save()){
                return response()->json(['success'=>true]);
            }
            else{
                return response()->json(['success'=>false]);
            }
            
    }

    public function delete (Request $request){
        $validator = $request->validate([
            'id' => 'required',
        ]);
            $driver = driver::where('id', $request->id);
            if($driver->count()){
                $driver->delete();
                return response()->json(['success'=>true]);
            }
            else{
                return response()->json(['success'=>false]); 
                
            }
            
    }

    public function addDriverAuto(Request $request){
        $autoDriver = new auto_drivers;
        $checkDriverAuto = auto_drivers::where('driver_id',$request->driver_id)->where('auto_id',$request->auto_id);
        If(!$checkDriverAuto->count()){
            $autoDriver->auto_id = $request->auto_id;
            $autoDriver->driver_id = $request->driver_id;
            $autoDriver->save();
            return response()->json(['success'=>true]);
        }else{
            return response()->json(['success'=>false]); 
        }
    }
}
