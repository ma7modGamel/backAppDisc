<?php

namespace App\Http\Controllers\Api;

use App\Ad;
use App\Contact;
use App\Http\Controllers\Controller;
use App\Info;
use App\Product;
use App\Rating;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function info()
    {
        $info = Info::all()->first(); 
        return response($info , 200);
    }

    public function contactus(Request $request){
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required'
        ]);
        if($validator->passes()){
            $data = new Contact;
            $data->title = $request->title;
            $data->content = $request->content;
            $data->save();

         return response(['status'=>200,'message'=>'تم الارسال']);


        }else{
            $msg= $validator->messages()->first();
            return response(['status'=>204,'message'=>$msg]);

        }

    }
    public function home()
    {
        $ads=Ad::all();
        $lasts = Product::orderBy('created_at','desc')->take(6)->get();
        $most = Product::orderBy('views','desc')->take(6)->get();
        $offers = Product::where('offer','>',0)->take(6)->get();
        return response(['status'=>200,'ads'=>$ads,'lasts'=>$lasts,'offers'=>$offers,'mosts'=>$most]);
    }
    public function lasts()
    {
        $lasts = Product::orderBy('created_at','desc')->take(30)->get();
        return response($lasts ,200);
    }
    public function lastsexp()
    {
        $lasts = Product::orderBy('created_at','desc')->take(30)->get();
        $products =$lasts->sortByDesc('price');
        return response($products ,200);
    }
    public function lastschp()
    {
        $lasts = Product::orderBy('created_at','desc')->take(30)->get();
        $products =$lasts->sortBy('price');
        return response($products ,200);
    }
    public function lastsrate()
    {
        $lasts = Product::orderBy('created_at','desc')->take(30)->get();
        foreach ($lasts as $last) {
            $rates = Rating::where('product_id',$last->id)->pluck('rate');
            if (count($rates->toArray())==0) {
                $rate = 0;
            } else {
                $rate = array_sum($rates->toArray()) / count($rates->toArray());
            }
            $rating[]=["id"=>$last->id,"rate"=>$rate];
        }
        $ratings = collect($rating)->sortByDesc('rate');
        foreach ($ratings as $rating) {
            $Product=Product::find($rating['id']);
            $Products[]=$Product;
        }
        return response($Products ,200);
    }
    public function offers()
    {
        $offers = Product::where('offer','>',0)->take(6)->get();
        return response($offers ,200);
    }
    public function offerslast()
    {
        $offers = Product::where('offer','>',0)->take(6)->get();
        $products =$offers->sortByDesc('created_at');
        return response($products ,200);
    }
    public function offersexp()
    {
        $offers = Product::where('offer','>',0)->take(6)->get();
        $products =$offers->sortByDesc('price');
        return response($products ,200);
    }
    public function offerschp()
    {
        $offers = Product::where('offer','>',0)->take(6)->get();
        $products =$offers->sortBy('price');
        return response($products ,200);
    }
    public function offersrate()
    {
        $offers = Product::where('offer','>',0)->take(6)->get();
        foreach ($offers as $offer) {
            $rates = Rating::where('product_id',$offer->id)->pluck('rate');
            if (count($rates->toArray())==0) {
                $rate = 0;
            } else {
                $rate = array_sum($rates->toArray()) / count($rates->toArray());
            }
            $rating[]=["id"=>$offer->id,"rate"=>$rate];
        }
        $ratings = collect($rating)->sortByDesc('rate');
        foreach ($ratings as $rating) {
            $Product=Product::find($rating['id']);
            $Products[]=$Product;
        }
        return response($Products ,200);
    }
}
