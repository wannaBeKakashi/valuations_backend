<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClientStoreRequest extends FormRequest
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
            'physical_address' =>['string','required'],
            'gender' =>['required','string',Rule::in(['male','female'])],
            'phone' =>['string','required',Rule::unique('clients','phone')],
            'email' =>['string','required',Rule::unique('users','email')],
            'password' =>['string','required'],
        ];
    }
}
