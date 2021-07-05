<?php

namespace App\Http\Requests\user;

use App\Rules\UserImageExists;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->id == $this->route('user');
    }

    protected function prepareForValidation()
    {
        foreach ($this->input() as $key => $value) {
            if (empty($value)) unset($this[$key]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=> 'sometimes|required|max:255',
            'country_id'=> 'sometimes|required|exists:countries,id',
            'gender_id'=> 'sometimes|required|exists:genders,id',
            'bio'=> 'sometimes|required|max:1000',
            'image'=> 'sometimes|required|image',
            'image_id'=> ['sometimes', 'required', 'int',new UserImageExists($this->route('user')) ],
            
        ];
    }
}
