<?php

namespace App\Http\Requests;

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
            'nombre_producto' => 'required|string|min:3|max:100',
            'descripcion_producto' => 'nullable|string|min:10',
            'precio_producto' => 'required|numeric|min:0',
            'stock_producto' => 'required|integer|min:0',
            'categoria_id' => 'required|exists:categorias,id',
            'color' => 'required|string|min:3|max:50',
            'talle' => 'required|string|in:XS,S,M,L,XL',

            // Imagen opcional al editar
            'imagen_producto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'activo' => 'nullable|boolean'
        ];
    }

    public function messages(): array
    {
        return [

            // NOMBRE
            'nombre_producto.required' => 'El nombre del producto es obligatorio.',
            'nombre_producto.min' => 'El nombre debe tener al menos 3 caracteres.',
            'nombre_producto.max' => 'El nombre no puede superar los 100 caracteres.',

            // DESCRIPCIÓN
            'descripcion_producto.min' => 'La descripción debe tener al menos 10 caracteres si decides colocar una.',

            // PRECIO
            'precio_producto.required' => 'El precio es obligatorio.',
            'precio_producto.numeric' => 'El precio debe ser un valor numérico.',
            'precio_producto.min' => 'El precio no puede ser menor a 0.',

            // STOCK
            'stock_producto.required' => 'El stock es obligatorio.',
            'stock_producto.integer' => 'El stock debe ser un número entero.',
            'stock_producto.min' => 'El stock no puede ser negativo.',

            // CATEGORÍA
            'categoria_id.required' => 'Debes seleccionar una categoría.',
            'categoria_id.exists' => 'La categoría seleccionada no existe.',

            // COLOR
            'color.required' => 'Debes ingresar un color.',
            'color.string' => 'El color debe ser texto válido.',
            'color.min' => 'El color debe tener al menos 3 caracteres.',
            'color.max' => 'El color no puede superar los 50 caracteres.',

            // TALLE
            'talle.required' => 'Debes seleccionar un talle.',
            'talle.in' => 'El talle seleccionado no es válido (XS, S, M, L, XL).',

            // IMAGEN
            'imagen_producto.image' => 'El archivo debe ser una imagen.',
            'imagen_producto.mimes' => 'La imagen debe ser JPG, JPEG, PNG o WEBP.',
            'imagen_producto.max' => 'La imagen no puede superar los 2MB.',
        ];
    }
}
