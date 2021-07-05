<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Preference extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = ['tag', 'name'];
    public $translatable = ['name'];
    
    public function values(){
        return $this->hasMany(PreferenceValue::class);
    }
}
