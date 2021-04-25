<?php

namespace App\Http\Controllers;
use App\Models\Auto;
use App\Models\Rate;
use App\Models\auto_rates;
use Illuminate\Http\Request;

class AutoController extends Controller
{
        public function get(){
                return Auto::where('id','>',0)->with("driver")->with("rates")->get();
        }
    
        public function create(Request $request){
            $validator = $request->validate([
                'mark'      => 'required',
                'model'  => 'required',
                'reg_num'  => 'required',
                'color' => 'required',
                'year' => 'required'
            ]);
                $auto = new Auto;
                $auto->mark    = $request->mark;
                $auto->model   = $request->model;
                $auto->reg_num = $request->reg_num;
                $auto->color   = $request->color;
                $auto->year    = $request->year;
                if($auto->save()){
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
                $auto = Auto::where('id', $request->id)->firstOrFail();
                if(isset($request->mark) and !empty($request->mark)){
                    $auto->mark = $request->mark;
                }
                if(isset($request->model) and !empty($request->model)){
                    $auto->model = $request->model;
                }
                if(isset($request->reg_num) and !empty($request->reg_num)){
                    $auto->reg_num = $request->reg_num;
                }
                if(isset($request->color) and !empty($request->color)){
                    $auto->color = $request->color;
                }
                if(isset($request->year) and !empty($request->year)){
                    $auto->year = $request->year;
                }
                if($auto->save()){
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
                $auto = Auto::where('id', $request->id);
                if($auto->count()){
                    $auto->delete();
                    return response()->json(['success'=>true]);
                }
                else{
                    return response()->json(['success'=>false]); 
                    
                }
                
        }

        public function addRate(Request $request){
            $autoRate = new auto_rates;
            $checkRateAuto = auto_rates::where('auto_id',$request->auto_id)->where('rate_id',$request->rate_id);
            If(!$checkRateAuto->count()){
                $autoRate->auto_id = $request->auto_id;
                $autoRate->rate_id = $request->rate_id;
                $autoRate->save();
                return response()->json(['success'=>true]);
            }else{
                return response()->json(['success'=>false]); 
            }
        }
    }

