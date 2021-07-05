<?php

namespace App\Http\Controllers\api\v1;

use App\Events\CallAcceptEvent;
use App\Events\CallInitEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\call\joinTopicRequest;
use App\Models\Call;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Http\Request;

class CallController extends Controller
{
    public function joinTopic(Topic $topic, joinTopicRequest $request){
        $call = $topic->calls()->withCount('users')->having('users_count', '<', 2)->first();
        if (!$call) $call = $topic->calls()->create();

        $call->users()->attach(auth()->user()->id);
        if ($call->users_count > 1) event(new CallInitEvent($call));
        
        return response()->json(['data'=>$call]);
    }

    public function accept(Call $call){
        event(new CallAcceptEvent($call));
        return response()->json([]);
    }

    public function usercalls($id)
    {
        $user =User::find($id);
        $calls = Call::where('user1', '!=', NULL)->where('user2', '!=', NULL)->where('user1',$id)->orWhere('user2',$id)->with('topic','firstuser','seconduser')->get();
        if (!empty($calls)) {
            $user->call_count = $calls->count();
            $user->save();
        }
        return response()->json(['success'=>true, 'calls'=>$calls]);
    }

}
 