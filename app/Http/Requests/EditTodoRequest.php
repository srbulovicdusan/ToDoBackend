<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditTodoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
   

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required|integer',
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'priority' => 'required',
            'completed' => 'required',
        ];
    }
}
