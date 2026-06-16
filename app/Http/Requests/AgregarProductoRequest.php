<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AgregarProductoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // PRODUCTO
            'nombre_producto' => 'required|string|min:3|max:100',
            'descripcion_producto' => 'nullable|string|min:10',
            'precio_producto' => 'required|numeric|min:0',
            'stock_producto' => 'required|integer|min:0',
            'categoria_id' => 'required|exists:categorias,id',

            // IMÁGENES
            'imagenes' => 'nullable|array',
            'imagenes.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',

            // COLOR (texto simple como tu formulario actual)
            'color' => 'required|string|max:50',

            // TALLE (uno solo seleccionado)
            'talle' => 'required|string|in:XS,S,M,L,XL',
        ];
    }

    public function messages(): array
    {
        return [
            // PRODUCTO
            'nombre_producto.required' => 'El nombre del producto es obligatorio.',
            'nombre_producto.min' => 'Debe tener al menos 3 caracteres.',
            'nombre_producto.max' => 'No puede superar los 100 caracteres.',

            'precio_producto.required' => 'El precio es obligatorio.',
            'precio_producto.numeric' => 'El precio debe ser numérico.',
            'precio_producto.min' => 'El precio no puede ser negativo.',

            'stock_producto.required' => 'El stock es obligatorio.',
            'stock_producto.integer' => 'El stock debe ser un número entero.',

            'categoria_id.required' => 'Debes seleccionar una categoría.',
            'categoria_id.exists' => 'La categoría seleccionada no existe.',

            // IMÁGENES
            'imagenes.array' => 'Formato de imágenes inválido.',
            'imagenes.*.image' => 'Cada archivo debe ser una imagen.',
            'imagenes.*.mimes' => 'Solo JPG, PNG o WEBP.',
            'imagenes.*.max' => 'Cada imagen debe pesar menos de 2MB.',

            // COLOR
            'color.required' => 'Debes ingresar un color.',
            'color.string' => 'El color debe ser texto.',
            'color.max' => 'El color no puede superar los 50 caracteres.',

            // TALLE
            'talle.required' => 'Debes seleccionar un talle.',
            'talle.string' => 'El talle debe ser válido.',
            'talle.max' => 'El talle no es válido.',
        ];
    }
}
