<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\PackageResource;
use App\Models\Package;
use App\Models\Supscription;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Validator;
use Carbon\Carbon;


class PackageController extends Controller
{
    public function index(){
        return PackageResource::collection(Package::paginate(request()->limit));
    }

    public function show(Package $package){
        // $package->load('features');
        return response()->json(['success'=>true, 'data'=>PackageResource::make($package)]);
    }

    public function subscribe(Request $request){
        
        $rules = [
            'user_id' => ['required'],
            'package_id' => ['required'],
        ];
        $validate = Validator::make($request->all(), $rules);
        if ($validate->fails()) {
            return response()->json(['success'=>false, 'message'=>$validate]);
        } else {
            $package =Package::find($request['package_id']);
            $sub = Supscription::where('user_id', $request['user_id'])->first();
            if (!is_null($sub)) {
                # code...
                $sub->delete();
            }
            $data = new Supscription();
            $data->user_id = $request['user_id'];
            $data->package_id = $request['package_id'];
            $data->end_at = Carbon::now()->addMonths($package->month);
            $data->save();
        }
        return response()->json(['success'=>true, 'message'=>'Subscribed successfully']);
    }

    public function unSubscribe(Package $package){
        return response()->json(['success'=>true, 'message'=>'Unsubscribed successfully']);
    }

    public function subscriptions()
    {
        $subscriptions=Supscription::all();
        return response()->json(['success'=>true, 'subscriptions'=>$subscriptions]);
    }
    
}
