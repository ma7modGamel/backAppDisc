<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\user\preference\value\StoreRequest;
use Illuminate\Http\Request;

class PreferenceValueController extends Controller
{
    public function store(StoreRequest $request){
        return response()->json(['success'=>true, 'message'=>'Preferences updated successfully']);
    }
}
