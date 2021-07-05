<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\PreferenceResource;
use App\Models\Preference;
use Illuminate\Http\Request;

class PreferenceController extends Controller
{
    public function index(){
        return PreferenceResource::collection(Preference::with('values')->paginate(request()->limit));
    }
}
