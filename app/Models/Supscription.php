<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supscription extends Model
{
    use HasFactory;

    public function package(){
        return $this->belongsTo(Package::class,'package_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
 