<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientRequest extends FormRequest
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
            'contact_name' => 'required|string|max:255',
            'contact_email' =>'required|string|email|max:255|unique:clients',
            'company_name'=>'required|string',
            'company_address'=>'required|min:10',
            'contact_phone_number'=>'required|min:11',
            'company_city'=> 'required|string',
            'company_zip' => 'required|string',
            'company_vat' => 'required|numeric'            
        ];
    }
}
