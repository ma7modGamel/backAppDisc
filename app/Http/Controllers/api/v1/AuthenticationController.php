<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\authentication\LoginRequest;
use App\Http\Requests\authentication\RegisterRequest;
use App\Http\Resources\TokenResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\Supscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Auth;
use Validator;



class AuthenticationController extends Controller
{

    public function forgot() {
        $credentials = request()->validate(['email' => 'required|email']);
       
        $user = User::where('email',request()->email)->first();
        if (is_null($user)) {
            return response()->json(['success'=>false, 'msg'=>'البريد الالكتروني غير صحيح']);
        } else {
            
            Password::sendResetLink($credentials);
            return response()->json(['success'=>true, 'msg'=>'تم ارسال رابط أعاده التعيين للبريد الالكتروني']);
        }
    }

    public function user($id)
    {
        $user =  User::find($id);
        return new UserResource(User::findOrFail($id));
        $user = User::find($id);
        $sub = Supscription::where('user_id', $id)->first();
        return response()->json(['success'=>true, 'user'=>$user, 'subscription'=>$sub]);
    }
    

    public function sub($id)
    {
        $sub = Supscription::where('user_id', $id)->with('package','user')->first();
        return response()->json(['success'=>true, 'subscription'=>$sub]);
    }

 
    public function me()
    {
        
        return response()->json([
            'success'=>true,
            'data'=> [
                'user'=> new UserResource(User::findOrFail(Auth::user()->id)),
                'tokens'=> TokenResource::collection(User::find(auth()->user()->id)->tokens)
            ]
        ]);
    }

    // public function register(RegisterRequest $request)
    // {
        
    //     $user = User::create([
    //         'name'=>$request->name,
    //         'email'=>$request->email,
    //         'password'=>Hash::make($request->password),
    //         'country_id'=>$request->country_id,
    //         'gender_id'=>$request->gender_id,
    //     ]);
        
    //     $token = $user->createToken( $request->device_name ?? now()->timestamp,[]);
    //     return response()->json(['success'=>true,'message'=>'Registeration successfully', 'token'=>$token->plainTextToken]);

    // }

    public function register(Request $request){
        
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
            'name' => 'required|string|min:4|unique:users',
            'password' => 'min:6|required',
            'country_id' => 'required',
            'gender_id' => 'required',
        ],[
            'email.unique'=>'عفوا البريد الاليكتروني مستخدم من قبل ',
            'name.unique'=>'عفوا الاسم مستخدم من قبل '
        ]);
       if($validator->passes())
       {

        $user=new User();
        $user->name= $request->name;
        $user->email= $request->email;
        $user->country_id= $request->country_id;
        $user->gender_id= $request->gender_id;
        $user->password = Hash::make($request->password);
        $user->save();

        $tokenResult = $user->createToken('authToken')->plainTextToken;

        return response()->json(['success'=>true,'message'=>'Registeration successfully', 'token'=>$tokenResult]);
        // return response()->json([
        // 'user'=>$data,
        // 'status' => 'true',
        // 'access_token' => $tokenResult,
        // 'token_type' => 'Bearer',
        // ]);

      }else{
        $msg= $validator->messages()->first();
        return response(['status'=>'false','message'=>$msg]);

          }
    }


    public function login(LoginRequest $request)
    {
        $user = User::where('email',$request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) return response()->json(['success'=>false,'message'=>'Login failed'], 403);
        $token = $user->createToken( $request->device_name ?? now()->timestamp,[]);
        return response()->json([
            'success'=>true,
            'token' => $token->plainTextToken
        ]);
    }

    public function logout(){
        auth()->user()->currentAccessToken()->delete();
        return response()->json(['success'=>true]); 
    }

    public function revoke($token){
        $token = auth()->user()->tokens()->where('id', $token);
        if(!$token) return response()->json(['success'=>false,'message'=>'Access not exist'], 404);
        $token->delete();
        return response()->json(['success'=>true, 'message'=>'Access revoked']); 
    }

    public function revokeAll(){
        auth()->user()->tokens()->delete();
        return response()->json(['success'=>true, 'message'=>'Access revoked']); 
    }

    


}
