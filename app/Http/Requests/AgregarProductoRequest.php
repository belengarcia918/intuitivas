<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Categoria;
use App\Models\Color;

class AgregarProductoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        // COLOR
        if ($this->color_nombre) {

            $nombreColor = strtolower(trim($this->color_nombre));

            $color = Color::firstOrCreate(
                [
                    'nombre' => $nombreColor
                ],
                [
                    'hex' => $this->color_hex
                ]
            );

            $this->merge([
                'color_id' => $color->id
            ]);
        }

        // CATEGORÍA
        if ($this->categoria_nombre) {

            $nombreCategoria = ucwords(
                strtolower(
                    trim($this->categoria_nombre)
                )
            );

            $categoria = Categoria::firstOrCreate([
                'nombre' => $nombreCategoria
            ]);

            $this->merge([
                'categoria_id' => $categoria->id
            ]);
        }
    }

    public function rules(): array
    {
        return [

            // PRODUCTO
            'nombre' => 'required|string|min:3|max:100',
            'descripcion' => 'required|string|min:10|max:200',
            'precio' => 'required|numeric|min:0',

            // CATEGORÍA
            'categoria_nombre' => 'required|string|max:100',
            'categoria_id' => 'required|exists:categorias,id',

            // COLOR
            'color_nombre' => 'required|string|max:50',
            'color_hex' => [
                'required',
                'regex:/^#[A-Fa-f0-9]{6}$/'
            ],
            'color_id' => 'required|exists:colores,id',

            // VARIANTE
            'talle_id' => 'required|exists:talles,id',
            'stock' => 'required|integer|min:0',

            // IMÁGENES
            'imagenes' => 'nullable|array',
            'imagenes.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
        ];
    }

    public function messages(): array
    {
        return [

            // NOMBRE
            'nombre.required' => 'El nombre del producto es obligatorio.',
            'nombre.min' => 'Debe tener al menos 3 caracteres.',
            'nombre.max' => 'No puede superar los 100 caracteres.',

            // DESCRIPCIÓN
            'descripcion.required' => 'La descripción es obligatoria.',
            'descripcion.string' => 'La descripción debe ser texto.',
            'descripcion.min' => 'La descripción debe tener al menos 10 caracteres.',
            'descripcion.max' => 'La descripción no puede superar los 200 caracteres.',

            // PRECIO
            'precio.required' => 'El precio es obligatorio.',
            'precio.numeric' => 'El precio debe ser numérico.',
            'precio.min' => 'El precio no puede ser negativo.',

            // CATEGORÍA
            'categoria_nombre.required' => 'Debes ingresar una categoría.',
            'categoria_id.exists' => 'La categoría seleccionada no existe.',

            // COLOR
            'color_nombre.required' => 'Debes ingresar un color.',
            'color_nombre.string' => 'El color debe ser texto.',
            'color_nombre.max' => 'El color no puede superar los 50 caracteres.',

            'color_hex.required' => 'Debes seleccionar un color.',
            'color_hex.regex' => 'El color hexadecimal no es válido.',

            'color_id.exists' => 'El color seleccionado no existe.',

            // TALLE
            'talle_id.required' => 'Debes seleccionar un talle.',
            'talle_id.exists' => 'El talle seleccionado no existe.',

            // STOCK
            'stock.required' => 'El stock es obligatorio.',
            'stock.integer' => 'El stock debe ser un número entero.',
            'stock.min' => 'El stock no puede ser negativo.',

            // IMÁGENES
            'imagenes.required' => 'Debes subir al menos una imagen.',
            'imagenes.array' => 'Formato de imágenes inválido.',
            'imagenes.min' => 'Debes subir al menos una imagen.',

            'imagenes.*.required' => 'La imagen es obligatoria.',
            'imagenes.*.image' => 'Cada archivo debe ser una imagen.',
            'imagenes.*.mimes' => 'Solo se permiten JPG, JPEG, PNG y WEBP.',
            'imagenes.*.max' => 'Cada imagen debe pesar menos de 2MB.',
        ];
    }
}