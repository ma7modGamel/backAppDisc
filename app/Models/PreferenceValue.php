<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class PreferenceValue extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = ['name', 'image', 'preference_id'];
    public $translatable = ['name'];
    
}
