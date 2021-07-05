<?php

namespace App\Http\Controllers\Api;

use App\Address;
use App\City;
use App\Fav;
use App\Http\Controllers\Controller;
use App\Product;
use App\Rating;
use App\Sector;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function useraddresses()
    {
        $user = Auth::user();
        $addresses = Address::where('user_id',$user->id)->get();
        return response($addresses , 200);
    }

    public function createaddress()
    {
        $cities = City::all();
        $sectors = Sector::all();
        return response(['status'=>200,'cities'=>$cities,'sectors'=>$sectors]);
    }

    public function addaddress(Request $request){
        $user = Auth::user();
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'street' => 'required'
        ]);
        if($validator->passes()){
            $address = new Address;
            $address->user_id = $user->id;
            $address->lat = $request->lat;
            $address->long = $request->long;
            $address->city_id = $request->city_id;
            $address->sector_id = $request->sector_id;
            $address->name = $request->name;
            $address->street = $request->street;
            $address->mark = $request->mark;
            $address->building = $request->building;
            $address->floor = $request->floor;
            $address->flat = $request->flat;
            $address->save();

         return response(['status'=>200,'message'=>'تم الحفظ']);


        }else{
            $msg= $validator->messages()->first();
            return response(['status'=>204,'message'=>$msg]);

        }

    }

    public function getaddress($id)
    {
        $address = Address::find($id);
        return response($address , 200);
    }

    public function removeaddress($id)
    {
        $address = Address::find($id);
        $address->delete();
        return response(['status'=>200,'message'=>'تم الحذف']);
    }

    public function updateaddress(Request $request , $id){
        $address = Address::find($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'street' => 'required'
        ]);
        if($validator->passes()){

         $address->update(['lat' => $request->lat
         ,'long' => $request->long
         ,'name' => $request->name
         ,'sictor_id' => $request->sictor_id
         ,'city_id' => $request->city_id
         ,'street' => $request->street
         ,'mark' => $request->mark
         ,'building' => $request->building
         ,'floor' => $request->floor
         ,'flat' => $request->flat]);
         return response(['status'=>200,'message'=>'تم الحفظ']);


        }else{
            $msg= $validator->messages()->first();
            return response(['status'=>204,'message'=>$msg]);

        }

    }
    public function addfav(Request $request){
        $user = Auth::user();
        $validator = Validator::make($request->all(), [
            'product_id' => 'required'
        ]);
        if($validator->passes()){
            $fav = new Fav;
            $fav->user_id = $user->id;
            $fav->product_id = $request->product_id;
            $fav->save();

         return response(['status'=>200,'message'=>'تم الحفظ']);


        }else{
            $msg= $validator->messages()->first();
            return response(['status'=>204,'message'=>$msg]);

        } 

    }
    public function favs()
    {
        $user = Auth::user();
        $favs = Fav::where('user_id',$user->id)->orderBy('created_at','desc')->get();
        return response($favs , 200);
    }

    public function removefav($id)
    {
        $fav = Fav::find($id);
        $fav->delete();
        return response(['status'=>200,'message'=>'تم الحذف']);
    }
    public function addrate(Request $request)
    {
        $user = Auth::user();
        $rate = Rating::where('user_id' ,$user->id)->where('product_id',$request->product_id)->first();
        if (is_null($rate)) {
            $data = new Rating;
            $data->user_id = $user->id;
            $data->product_id =$request->product_id;
            $data->rate =$request->rate;
            $data->save();
        }else{
            $rate->delete();
            $data = new Rating;
            $data->user_id = $user->id;
            $data->product_id =$request->product_id;
            $data->rate =$request->rate;
            $data->save();
        }
        return response(['status'=>200,'message'=>'تم الحفظ']);
    }

}
