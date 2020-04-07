<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePublicityRequest extends FormRequest
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
            'name'      => 'required|string|max:150|unique:ads,name',
            'start_at'  => 'required|date|date_format:Y-m-d',
            'end_at'    => 'nullable|date|date_format:Y-m-d|after:start_date',
            'link'      => 'required|string|max:255|min:10',
            'publicity' => 'nullable|file'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatório!',
            'unique'   => ':attribute já cadastrado!',
            'after'    => 'A date de fim deve ser posterior a data de início.'
        ];
    }
}
