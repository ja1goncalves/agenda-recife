<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateReportRequest extends FormRequest
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
            'subject'    => 'required|string|max:100',
            'motivation' => 'nullable|string|max:150',
            'body'       => 'required|string',
            'email'      => 'required|string|max:50',
        ];
    }
}
