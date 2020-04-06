<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateEventRequest extends FormRequest
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
            'name'          => 'required|string|max:100',
            'artist'        => 'nullable|string|max:100',
            'location'      => 'required|string|max:150',
            'when'          => 'required|string|date_format:d/m/Y',
            'end_at'        => 'nullable|string|date_format:d/m/Y',
            'indicated'     => 'nullable|string|max:2',
            'featured'      => 'nullable|string|max:2',
            'description'   => 'required|string',
            'sale_link'     => 'required|string|max:255',
            'main_pictures' => 'nullable|image',
            'pictures'      => 'nullable|image'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatório!',
            'unique'   => ':attribute já cadastrado!',
        ];
    }
}
