<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\Rate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp;

class OrderController extends Controller
{
    public function create (Request $request){
        $client = new GuzzleHttp\Client();
        $coord1 = $request->from_coord;

        $json = json_decode(file_get_contents('http://188.165.251.166:5000/route/v1/driving/'.$request->from_coord.';'.$request->to_coord), true);


        $rate = Rate::where('id', $request->rate_id)->first();
        
        $order = new Order;

        $minuts = $json['routes'][0]['duration']/60 - $rate->free_min;
        if($minuts<0){
            $minuts = 0;
        }
        $km = $json['routes'][0]['distance']/1000 - $rate->free_km;
        if($km<0){
            $km = 0;
        }

        $order->from_adr     = $request->from_adr;
        $order->to_adr       = $request->to_adr;
        $order->from_coord   = $request->from_coord;
        $order->to_coord     = $request->to_coord;
        $order->min_price    = $rate->min_price;
        $order->price_km     = $rate->km_price;
        $order->price_minuts = $rate->minut_price;
        $order->final_price  = $rate->min_price+($minuts*$rate->minut_price) + ($km*$rate->km_price);
        $order->save();
    }

    public function get (Request $request){
        return Order::where('user_id', $request->user()->id);
    }

}
