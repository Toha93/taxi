<?php

namespace App\Http\Controllers;
use App\Models\Rate;
use App\Models\Auto;
use Illuminate\Http\Request;

class RateController extends Controller
{
    public function get(){
        return Rate::all();
}

public function create(Request $request){
    $validator = $request->validate([
        'name'      => 'required',
        'min_price'  => 'required',
        'km_price'  => 'required',
        'minut_price' => 'required',
        'free_km' => 'required',
        'free_min' => 'required'
    ]);
        $rate = new Rate;
        $rate->name    = $request->name;
        $rate->min_price   = $request->min_price;
        $rate->km_price = $request->km_price;
        $rate->minut_price   = $request->minut_price;
        $rate->free_km    = $request->free_km;
        $rate->free_min    = $request->free_min;
        if($rate->save()){
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
        $rate = Rate::where('id', $request->id)->firstOrFail();
        if(isset($request->name) and !empty($request->name)){
            $rate->name = $request->name;
        }
        if(isset($request->min_price) and !empty($request->min_price)){
            $rate->min_price = $request->min_price;
        }
        if(isset($request->km_price) and !empty($request->km_price)){
            $rate->km_price = $request->km_price;
        }
        if(isset($request->minut_price) and !empty($request->minut_price)){
            $aurateto->minut_price = $request->minut_price;
        }
        if(isset($request->free_km) and !empty($request->free_km)){
            $rate->free_km = $request->free_km;
        }
        if(isset($request->free_km) and !empty($request->free_km)){
            $rate->free_min = $request->free_min;
        }
        if($rate->save()){
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
        $rate = Rate::where('id', $request->id);
        if($rate->count()){
            $rate->delete();
            return response()->json(['success'=>true]);
        }
        else{
            return response()->json(['success'=>false]); 
            
        }
        
}
}
