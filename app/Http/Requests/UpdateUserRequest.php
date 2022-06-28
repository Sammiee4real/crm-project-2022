<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'first_name'=>'required|string',
            'last_name'=>'required|string',
            'email'=>'required|email',
            'phone_number'=>'required',
            // 'password'=> Password::min(8)
            //                 ->letters()
            //                 ->mixedCase()
            //                 ->numbers()
            //                 ->symbols()
            //                 ->uncompromised(),
            'address'=>'required',
            'role' =>'required'
        ];
    }
}
