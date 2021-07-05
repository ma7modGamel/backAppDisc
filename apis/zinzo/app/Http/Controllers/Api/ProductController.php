<?php

namespace App\Http\Controllers\Api;

use App\Cat;
use App\Fav;
use Auth;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCollection;
use App\Product;
use App\Rating;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function product($id)
    {
        $is_fav = 0;
        $product = Product::find($id);
        $product->increment('views');
        $rates = Rating::where('product_id',$id)->pluck('rate');
        if (count($rates->toArray())==0) { 
            $rate = 0;
        } else {
            $rate = array_sum($rates->toArray()) / count($rates->toArray());
        }
        if (Auth::check()) {
            $user = Auth::user();
            $fav = Fav::where('user_id',$user->id)->where('product_id',$id)->first();
            
            if (!is_null($fav)) {
                $is_fav =1;
            }
        }
        return response(['status'=>200,'product'=>$product,'is_fav'=>$is_fav,'rate'=>$rate,'ratingcount'=>count($rates->toArray())]);
    }
    public function search(Request $request)
    {
        $products = Product::where('name_ar' , 'like' , '%'.$request->search.'%')
        ->orWhere('name_en' , 'like' , '%'.$request->search.'%')
        ->orWhere('details_ar' , 'like' , '%'.$request->search.'%')
        ->orWhere('details_en' , 'like' , '%'.$request->search.'%')->get();
        if (count($products)) {
            return response(['status'=>200,'products'=>$products]);
        }else{
            return response(['status'=>204,'msg'=>'notfound']);
        }
    }
    public function cats()
    {
        $cats = Cat::all();
        return response($cats,200);
    }
    public function cat($id)
    {
        $cat = Cat::find($id);
        $products = $cat->products;

        return response($products,200);
    }
    public function catlast($id)
    {
        $cat = Cat::find($id);
        $products = $cat->products->sortByDesc('created_at');

        return response($products,200);
    }
    public function catexp($id)
    {
        $cat = Cat::find($id);
        $products = $cat->products->sortByDesc('price');
        return response($products,200);
    }
    public function catchp($id)
    {
        $cat = Cat::find($id);
        $products = $cat->products->sortBy('price');
        return response($products,200);
    }
    public function catrate($id)
    {
        $cat = Cat::find($id);
        $products = $cat->products;
        foreach ($products as $product) {
            $rates = Rating::where('product_id',$product->id)->pluck('rate');
            if (count($rates->toArray())==0) {
                $rate = 0;
            } else {
                $rate = array_sum($rates->toArray()) / count($rates->toArray());
            }
            $rating[]=["id"=>$product->id,"rate"=>$rate];
        }
        $ratings = collect($rating)->sortByDesc('rate');
        foreach ($ratings as $rating) {
            $Product=Product::find($rating['id']);
            $Products[]=$Product;
        }
        return response($Products ,200);
    }

}
