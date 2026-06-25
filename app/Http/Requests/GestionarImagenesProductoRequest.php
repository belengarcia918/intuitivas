<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class GestionarImagenesProductoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'imagenes'   => 'required|array|min:1',
            'imagenes.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'imagenes.required' => 'Debes seleccionar al menos una imagen.',
            'imagenes.array'    => 'Formato de imágenes inválido.',
            'imagenes.min'      => 'Debes seleccionar al menos una imagen.',

            'imagenes.*.image' => 'Cada archivo debe ser una imagen.',
            'imagenes.*.mimes' => 'Solo se permiten imágenes JPG, JPEG, PNG o WEBP.',
            'imagenes.*.max'   => 'Cada imagen debe pesar menos de 2 MB.',
        ];
    }
}
