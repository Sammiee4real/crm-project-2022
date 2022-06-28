<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
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
            'title' => 'required|string',
            'description' =>'required|string',
            'deadline'=>'required|date',
            // 'status'=>'required|string',
            'project_id'=>'required|string'
        ];
    }

    public function messages(){
        
        return [
            'project_id.required' => 'Project field cannot be empty'
        ];
    }
}
