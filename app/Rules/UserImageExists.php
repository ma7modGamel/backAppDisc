<?php

namespace App\Rules;

use App\Models\UserImage;
use Illuminate\Contracts\Validation\Rule;

class UserImageExists implements Rule
{

    private $user_id;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($user_id){
        $this->user_id = $user_id;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return UserImage::where('user_id',$this->user_id)->where('id',$value)->count() > 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute value not found.';
    }
}
