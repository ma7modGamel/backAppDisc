<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Package extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = ['tag', 'name', 'price', 'currency', 'image', 'month'];
    public $translatable = ['name'];
    
    public function features(){
        return $this->hasMany(Feature::class);
    }
}
