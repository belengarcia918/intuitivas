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
        $variantes = $this->input('variantes');

        if (!$variantes) {
            $variantes = [];
        }

        foreach ($variantes as $i => $variante) {

            $nombreColor = strtolower(trim($variante['color_nombre']));

            $color = Color::firstOrCreate(
                [
                    'nombre' => $nombreColor
                ],
                [
                    'hex' => $variante['color_hex']
                ]
            );

            $variantes[$i]['color_id'] = $color->id;
        }

        $this->merge([
            'variantes' => $variantes
        ]);

        // CATEGORÍA (igual)
        if ($this->categoria_nombre) {

            $nombreCategoria = ucwords(strtolower(trim($this->categoria_nombre)));

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
            'variantes' => [
                'required',
                'array',
                'min:1'
            ],

            'variantes.*.color_nombre' => [
                'required',
                'string',
                'max:50'
            ],

            'variantes.*.color_hex' => [
                'required',
                'regex:/^#[A-Fa-f0-9]{6}$/'
            ],

            'variantes.*.color_id' => [
                'required',
                'exists:colores,id'
            ],

            // TALLE
            'variantes.*.talle_id' => [
                'required',
                'exists:talles,id'
            ],

            'variantes.*.stock' => [
                'required',
                'integer',
                'min:1'
            ],

            // IMÁGENES
            'imagenes' => 'required|array|min:1',
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
            'categoria_nombre.string' => 'La categoría debe ser texto.',
            'categoria_nombre.max' => 'La categoría no puede superar los 100 caracteres.',

            // VARIANTES
            'variantes.required' => 'Debes agregar al menos una variante.',
            'variantes.array' => 'Las variantes enviadas no son válidas.',
            'variantes.min' => 'Debes agregar al menos una variante.',

            // COLOR
            'variantes.*.color_nombre.required' => 'Debes ingresar un color.',
            'variantes.*.color_nombre.string' => 'El color debe ser texto.',
            'variantes.*.color_nombre.max' => 'El color no puede superar los 50 caracteres.',

            'variantes.*.color_hex.required' => 'Debes seleccionar un color.',
            'variantes.*.color_hex.regex' => 'El color hexadecimal no es válido.',

            // TALLE
            'variantes.*.talle_id.required' => 'Debes seleccionar un talle.',
            'variantes.*.talle_id.exists' => 'El talle seleccionado no existe.',

            // STOCK
            'variantes.*.stock.required' => 'El stock es obligatorio.',
            'variantes.*.stock.integer' => 'El stock debe ser un número entero.',
            'variantes.*.stock.min' => 'El stock debe ser al menos 1.',

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