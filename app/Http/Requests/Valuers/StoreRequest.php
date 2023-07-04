<?php

namespace App\Http\Requests\Valuers;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first_name' =>['string','required'],
            'middle_name' =>['string','nullable'],
            'last_name' =>['string','required'],
            'valuer_number' =>['string','nullable'],
            'physical_address' =>['string','required'],
            'affiliation' =>['string'],
            'gender' =>['required','string',Rule::in(['male','female'])],
            'phone' =>['string','required',Rule::unique('valuers','phone')],
            'email' =>['string','required',Rule::unique('users','email')],
            'password' =>['string','required'],
        ];
    }
}
