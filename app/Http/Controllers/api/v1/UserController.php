<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\user\AddImageRequest;
use App\Http\Requests\user\UpdateRequest;
use App\Http\Resources\UserImageResource;
use App\Models\User;
use App\Http\Resources\UserResource;
use App\Models\UserImage;
use Illuminate\Http\Request;
 
class UserController extends Controller
{
    public function myImages(){
        return UserImageResource::collection(UserImage::where('user_id',auth()->user()->id)->paginate(request()->limit));
    } 

    public function addImage(AddImageRequest $request){
        $file = $request->file('image');
        $file->storeAs(
            'public/user/images',
            auth()->user()->id . '-' . time() . '.' . $file->getClientOriginalExtension()
        );
        $path0 = 'public/storage/user/images/'.auth()->user()->id . '-' . time() . '.' . $file->getClientOriginalExtension();
        UserImage::create([
            'user_id'=>auth()->user()->id,
            'image'=>$path0
        ]);
        return response()->json(['success'=>true, 'message'=>'Image added successfully']);
    }

    public function update(UpdateRequest $request){
        $data = $request->only([
            'name',
            'country_id',
            'gender_id',
            'bio'
        ]);
        if ($request->hasFile('image')){
            $file = $request->file('image');
            $file->storeAs(
                'public/user/images',auth()->user()->id . '-' . time() . '.' . $file->getClientOriginalExtension()
            );
            $path0 = 'public/storage/user/images/'.auth()->user()->id . '-' . time() . '.' . $file->getClientOriginalExtension();
        
            $data['image']=$path0;
        }
        auth()->user()->update($data);
        return response()->json(['success'=>true, 'message'=>'Data updated successfully']);
    }

    public function deleteimg($id)
    {
        $img = UserImage::find($id);
        $img->delete();
        return response()->json(['success'=>true, 'message'=>'Image deleted successfully']);
    }

    public function addlike($id)
    {
        $user = User::find($id);
        $user->like_count +=1;
        $user->save();
        return response()->json(['success'=>true, 'message'=>'successfully']);

    }
    public function search_user(Request $request){
        $users = User::where('name','like','%'.$request->user_name.'%')->get();
            return UserResource::collection($users);


    }
}
