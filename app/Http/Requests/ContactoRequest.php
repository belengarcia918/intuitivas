<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ContactoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nombre' => 'required|string|max:100',
            'email' => 'required|email|max:150',
            'motivo' => 'required|string|max:200',
            'consulta' => 'required|string|min:10|max:1000',
        ];
    }

    public function messages(): array 
    {
        return [
            'nombre.required' => 'El nombre es obligatorio.',
            'email.required' => 'El email es obligatorio',
            'email.email' => 'Formato de email inválido.',
            'motivo.required' => 'El motivo es obligatorio.',
            'consulta.min' => 'Debe tener al menos 10 caracteres',
            'consulta.required' => 'La consulta motivo es obligatoria.',
        ];

    }

}
