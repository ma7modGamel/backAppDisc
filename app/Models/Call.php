<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Resources\UserResource;
use App\Models\User;

class Call extends Model
{
    use HasFactory; 

    public function users(){
        return $this->belongsToMany(User::class, CallUser::class, 'call_id', 'user_id');
    }

    public function firstuser(){
        return $this->belongsTo(User::class,'user1');
    }

    public function seconduser(){
        return $this->belongsTo(User::class,'user2');
    }

    public function topic(){
        return $this->belongsTo(Topic::class,'topic_id');
    }

    
}
