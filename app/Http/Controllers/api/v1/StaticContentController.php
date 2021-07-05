<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Info;

class StaticContentController extends Controller
{
    public function contactUs(){
        $info = Info::all()->first();
        return response()->json([
            'success'=>true,
            'message' => $info->message,
            'phones'=>[
                $info->phone1,
                $info->phone2,
                $info->phone3
            ],
            'facebook'=>$info->facebook,
            'instagram'=>$info->instagram,
            'twitter'=>$info->twitter,
            'snapchat'=>$info->snapchat,
            'whatsapp'=>$info->whatsapp,
            'website'=>$info->website
        ]);
    }

    public function termsAndConditions(){
        $info = Info::all()->first();
        return response()->json([
            'success'=>true,
            'content' => $info->terms
        ]);
    }
}
