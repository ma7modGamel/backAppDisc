<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Topic extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = ['name', 'image' ,'live_count'];
    public $translatable = ['name'];
    
    public function calls(){
        return $this->hasMany(Call::class);
    }
}
