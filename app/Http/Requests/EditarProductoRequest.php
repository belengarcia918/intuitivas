<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class EditarProductoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => 'required|string|min:3|max:100',
            'descripcion' => 'required|string|min:10|max:200',
            'precio' => 'required|numeric|min:0',

            'categoria_id' => 'required|exists:categorias,id',

            'variantes' => 'required|array|min:1',

            'variantes.*.color_id' => 'required|exists:colores,id',
            'variantes.*.talle_id' => 'required|exists:talles,id',
            'variantes.*.stock' => 'required|integer|min:0',

            // opcionales al editar
            'imagenes' => 'nullable|array',
            'imagenes.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre del producto es obligatorio.',
            'nombre.min' => 'El nombre debe tener al menos 3 caracteres.',
            'nombre.max' => 'El nombre no puede superar los 100 caracteres.',

            'descripcion.required' => 'La descripción es obligatoria.',
            'descripcion.min' => 'La descripción debe tener al menos 10 caracteres.',
            'descripcion.max' => 'La descripción no puede superar los 200 caracteres.',

            'precio.required' => 'El precio es obligatorio.',
            'precio.numeric' => 'El precio debe ser numérico.',
            'precio.min' => 'El precio no puede ser menor a 0.',

            'categoria_id.required' => 'Debes seleccionar una categoría.',
            'categoria_id.exists' => 'La categoría seleccionada no existe.',

            'variantes.required' => 'El producto debe tener al menos una variante.',
            'variantes.array' => 'Formato de variantes inválido.',
            'variantes.min' => 'El producto debe tener al menos una variante.',

            'variantes.*.color_id.required' => 'Debes seleccionar un color.',
            'variantes.*.color_id.exists' => 'El color seleccionado no existe.',

            'variantes.*.talle_id.required' => 'Debes seleccionar un talle.',
            'variantes.*.talle_id.exists' => 'El talle seleccionado no existe.',

            'variantes.*.stock.required' => 'El stock es obligatorio.',
            'variantes.*.stock.integer' => 'El stock debe ser un número entero.',
            'variantes.*.stock.min' => 'El stock no puede ser negativo.',

            'imagenes.array' => 'Formato de imágenes inválido.',
            'imagenes.*.image' => 'Cada archivo debe ser una imagen.',
            'imagenes.*.mimes' => 'Solo se permiten JPG, JPEG, PNG y WEBP.',
            'imagenes.*.max' => 'Cada imagen debe pesar menos de 2MB.',
        ];
    }
}