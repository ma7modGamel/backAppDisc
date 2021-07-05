<?php

namespace App\Http\Requests\user\preference\value;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'preferences'=>'required|array',
            'preferences.*.preference_id'=>'required',
            'preferences.*.value'=>'required'
        ];
    }
}
