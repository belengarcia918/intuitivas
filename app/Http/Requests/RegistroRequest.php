<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class RegistroRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Permitimos que cualquier visitante pueda registrarse
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'      => 'required|min:3|max:50',
            'apellido'  => 'required|min:3|max:50',
            'email'     => 'required|email|unique:usuarios,email',
            'telefono'  => 'nullable|min:8|max:20',
            'direccion' => 'nullable|max:255',
            'password'  => 'required|min:8|confirmed',
            'terminos'  => 'required'
        ];
    }

    /**
     * Get the custom messages for validation errors.
     */
    public function messages(): array
    {
        return [
            'name.required'       => 'El nombre es obligatorio',
            'name.min'            => 'El nombre debe tener al menos 3 caracteres',
            'name.max'            => 'El nombre no puede superar los 50 caracteres',

            'apellido.required'   => 'El apellido es obligatorio',
            'apellido.min'        => 'El apellido debe tener al menos 3 caracteres',
            'apellido.max'        => 'El apellido no puede superar los 50 caracteres',

            'email.required'      => 'El correo electrónico es obligatorio',
            'email.email'         => 'Ingresá un correo electrónico válido',
            'email.unique'        => 'Ese correo electrónico ya está registrado',

            'telefono.min'        => 'El teléfono debe tener al menos 8 caracteres',
            'telefono.max'        => 'El teléfono no puede superar los 20 caracteres',
            
            'direccion.max'       => 'La dirección de envío es demasiado larga',

            'password.required'   => 'La contraseña es obligatoria',
            'password.min'        => 'La contraseña debe tener al menos 8 caracteres',
            'password.confirmed'  => 'Las contraseñas ingresadas no coinciden',

            'terminos.required'   => 'Debés aceptar los términos y condiciones de uso para registrarte'
        ];
    }
}
