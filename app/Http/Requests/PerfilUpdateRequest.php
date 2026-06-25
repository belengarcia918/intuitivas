<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PerfilUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Usuario logueado puede editar su perfil
    }

    public function rules(): array
    {
        return [
            'name' => 'required|min:3|max:50',
            'apellido' => 'required|min:3|max:50',

            'email' => [
                'required',
                'email',
                Rule::unique('usuarios', 'email')->ignore(auth()->id())
            ],

            'telefono' => 'nullable|min:8|max:20',
            'direccion' => 'nullable|max:255',

            'password' => 'nullable|min:8|confirmed',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre es obligatorio',
            'name.min' => 'El nombre debe tener al menos 3 caracteres',
            'name.max' => 'El nombre no puede superar los 50 caracteres',

            'apellido.required' => 'El apellido es obligatorio',
            'apellido.min' => 'El apellido debe tener al menos 3 caracteres',
            'apellido.max' => 'El apellido no puede superar los 50 caracteres',

            'email.required' => 'El correo electrónico es obligatorio',
            'email.email' => 'Ingresá un correo electrónico válido',
            'email.unique' => 'Ese correo electrónico ya está registrado',

            'telefono.min' => 'El teléfono debe tener al menos 8 caracteres',
            'telefono.max' => 'El teléfono no puede superar los 20 caracteres',

            'direccion.max' => 'La dirección es demasiado larga',

            'password.min' => 'La contraseña debe tener al menos 8 caracteres',
            'password.confirmed' => 'Las contraseñas no coinciden',
        ];
    }
}

