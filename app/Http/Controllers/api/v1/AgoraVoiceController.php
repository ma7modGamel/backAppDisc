<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Call;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Classes\AgoraDynamicKey\RtcTokenBuilder;
use App\Events\MakeAgoraCall;
use Carbon\Carbon;

class AgoraVoiceController extends Controller
{


    public function ccll(Request $request)
    {
        $user = User::find($request->user_id);
        $lcall = Call::where('user1','!=',$request->user_id)->where('max',1)->orderBy('created_at','desc')->get();
        if (empty($lcall[0])) {
            $call = new Call();
            $call->topic_id = $request->topic;
            $call->max_call_minutes = 60;
            $call->user1 = $request->user_id;
            $call->gender = $request->gender;
            $call->max = 1;
            $call->save();
        } else {
            foreach ($lcall as $key => $ocall) {
                // dd($ocall, $ocall->firstuser , $ocall->topic);
                if ($ocall->topic_id == $request->topic) {
                    if ($request->gender == 3) {
                        if ($ocall->gender ==3) {
                            $call = $ocall;
                            $call->user2 = $request->user_id;
                            $call->max = 2;
                            $call->save();
                            break;
                        }elseif ($user->gender_id == $ocall->gender) {
                            $call = $ocall;
                            $call->user2 = $request->user_id;
                            $call->max = 2;
                            $call->save();
                            break;
                        } else {
                            $call = new Call();
                            $call->topic_id = $request->topic;
                            $call->max_call_minutes = 60;
                            $call->gender = $request->gender;
                            $call->user1 = $request->user_id;
                            $call->max = 1;
                            $call->save();
                            break;
                        }
                    }elseif ($user->gender_id == $ocall->gender) {
                        if ($request->gender == $ocall->firstuser->gender_id) {
                            $call = $ocall;
                            $call->user2 = $request->user_id;
                            $call->max = 2;
                            $call->save();
                            break;
                        } 
                    }else{
                        $call = new Call();
                        $call->topic_id = $request->topic;
                        $call->max_call_minutes = 60;
                        $call->gender = $request->gender;
                        $call->user1 = $request->user_id;
                        $call->max = 1;
                        $call->save();
                        break;
                    }
                } else {
                    $call = new Call();
                    $call->topic_id = $request->topic;
                    $call->max_call_minutes = 60;
                    $call->user1 = $request->user_id;
                    $call->max = 1;
                    $call->save();
                    break;
                }
                
                
            }
        }
        

        // dd($lcall,$call);
    }

    public function token(Request $request)
    {
        if($request->gender && $request->topic && $request->user_id){
            $gender = $request->gender;
            $topic = $request->topic;
            $user = User::find($request->user_id);
            $lcall = Call::where('user1','!=',$request->user_id)->where('max',1)->orderBy('created_at','desc')->get();
            if (empty($lcall[0])) {
                $call = new Call();
                $call->topic_id = $request->topic;
                $call->max_call_minutes = 60;
                $call->user1 = $request->user_id;
                $call->gender = $request->gender;
                if (isset($request->country)){
                    $call->country = $request->country;

                }
                $call->max = 1;
                $call->save();
            } else {
                foreach ($lcall as $key => $ocall) {
                    // dd($ocall, $ocall->firstuser , $ocall->topic);
                    // if country not null
                    if (isset($request->country)){
                        if ($ocall->topic_id == $request->topic && $ocall->country == $request->country) {
                            if ($request->gender == 3) {
                                if ($ocall->gender ==3) {
                                    $call = $ocall;
                                    $call->user2 = $request->user_id;
                                    $call->max = 2;
                                    $call->save();
                                    break;
                                }elseif ($user->gender_id == $ocall->gender ) {
                                    $call = $ocall;
                                    $call->user2 = $request->user_id;
                                    $call->max = 2;
                                    $call->save();
                                    break;
                                } else {
                                    $call = new Call();
                                    $call->topic_id = $request->topic;
                                    $call->max_call_minutes = 60;
                                    $call->gender = $request->gender;
                                    $call->user1 = $request->user_id;
                                    $call->country = $request->country;
                                    $call->max = 1;
                                    $call->save();
                                    break;
                                }
                            }elseif ($user->gender_id == $ocall->gender) {
                                if ($request->gender == $ocall->firstuser->gender_id ) {
                                    $call = $ocall;
                                    $call->user2 = $request->user_id;
                                    $call->max = 2;
                                    $call->save();
                                    break;
                                }
                            }else{
                                $call = new Call();
                                $call->topic_id = $request->topic;
                                $call->max_call_minutes = 60;
                                $call->gender = $request->gender;
                                $call->user1 = $request->user_id;
                                $call->country = $request->country;
                                $call->max = 1;
                                $call->save();
                                break;
                            }
                        } else {
                            $call = new Call();
                            $call->topic_id = $request->topic;
                            $call->max_call_minutes = 60;
                            $call->user1 = $request->user_id;
                            $call->country = $request->country;
                            $call->max = 1;
                            $call->save();
                            break;
                        }

                    }
                    if ($ocall->topic_id == $request->topic) {
                        if ($request->gender == 3) {
                            if ($ocall->gender ==3) {
                                $call = $ocall;
                                $call->user2 = $request->user_id;
                                $call->max = 2;
                                $call->save();
                                break;
                            }elseif ($user->gender_id == $ocall->gender) {
                                $call = $ocall;
                                $call->user2 = $request->user_id;
                                $call->max = 2;
                                $call->save();
                                break;
                            } else {
                                $call = new Call();
                                $call->topic_id = $request->topic;
                                $call->max_call_minutes = 60;
                                $call->gender = $request->gender;
                                $call->user1 = $request->user_id;
                                $call->max = 1;
                                $call->save();
                                break;
                            }
                        }elseif ($user->gender_id == $ocall->gender) {
                            if ($request->gender == $ocall->firstuser->gender_id) {
                                $call = $ocall;
                                $call->user2 = $request->user_id;
                                $call->max = 2;
                                $call->save();
                                break;
                            }
                        }else{
                            $call = new Call();
                            $call->topic_id = $request->topic;
                            $call->max_call_minutes = 60;
                            $call->gender = $request->gender;
                            $call->user1 = $request->user_id;
                            $call->max = 1;
                            $call->save();
                            break;
                        }
                    } else {
                        $call = new Call();
                        $call->topic_id = $request->topic;
                        $call->max_call_minutes = 60;
                        $call->user1 = $request->user_id;
                        $call->max = 1;
                        $call->save();
                        break;
                    }


                }
            }
            $channel_id = ''.$call->id;

            $appID ='d67c342a9aed4b6284c1eaacb570be5c';
            $appCertificate = '5235a3d9a58a486baea84f8e6c35bf3d';
            $channelName = $channel_id;
            $user = $request->user_id;
            $role = RtcTokenBuilder::RoleAttendee;
            $expireTimeInSeconds = 3600;
            $currentTimestamp = now()->getTimestamp();
            $privilegeExpiredTs = $currentTimestamp + $expireTimeInSeconds;
            $uid = $user;


            $token = RtcTokenBuilder::buildTokenWithUserAccount($appID, $appCertificate, $channelName, $user, $role, $privilegeExpiredTs);
            return response()->json([
                    'app_id' => $appID,
                    'app_certificate' => $appCertificate,
                    'agora_token' => $token,
                    'channel_id' => $channel_id,
                    'u_id' => $uid,

            ]);
        }else{

            return "data not complete";
        }
    }

    public function endcall(Request $request)
    {
        $call = Call::find($request->call_id);
        $call->end_at = Carbon::now();
        $call->call_min = $request->call_min;
        $call->save();
        
        return response()->json(['success'=>true, 'call'=>$call]);
    }


}