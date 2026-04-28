<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /* LISTA DE PRODUCTOS */
    private function obtenerProductos()
    {
        return [
            [
                "id" => 1,
                "nombre" => "Sweater Tania",
                "precio" => 49000,
                "imagenes" => [
                    "images/productos/sweater1.jpg",
                    "images/productos/sweater1-2.jpg"
                ],
                "colores" => [
                    ['nombre' => 'Bordó', 'hex' => '#800020'],
                    ['nombre' => 'Negro', 'hex' => '#000000'],
                    ['nombre' => 'Marrón', 'hex' => '#6D4C41'],
                ],
                "talles" => ['S', 'M', 'L', 'XL'],
                "categoria" => "sweater"
            ],
            [
                "id" => 2,
                "nombre" => "Sweater Ignacia",
                "precio" => 62000,
                "imagenes" => [
                    "images/productos/sweater2.jpg",
                    "images/productos/sweater2-2.jpg"
                ],
                "colores" => [
                    ['nombre' => 'Teal Oscuro', 'hex' => '#004D40'],
                    ['nombre' => 'Azul Desaturado', 'hex' => '#5C7C99'],
                    ['nombre' => 'Azul Apagado', 'hex' => '#4A6C8C'],
                ],
                "talles" => ['S', 'M', 'L', 'XL'],
                "categoria" => "sweater"
            ],
            [
                "id" => 3,
                "nombre" => "Blazer DeLuca",
                "precio" => 90000,
                "imagenes" => [
                    "images/productos/blazer1.jpg",
                    "images/productos/blazer1-2.jpg"
                ],
                "colores" => [
                    ['nombre' => 'Celeste Apagado Claro', 'hex' => '#B7CBD6'],
                    ['nombre' => 'Blanco', 'hex' => '#FAFAFA'],
                ],
                "talles" => ['S', 'M', 'L', 'XL'],
                "categoria" => "blazer"
            ],
            [
                "id" => 4,
                "nombre" => "Blazer sastrero",
                "precio" => 52000,
                "imagenes" => [
                    "images/productos/blazer2.jpg",
                    "images/productos/blazer2-2.jpg"
                ],
                "colores" => [
                    ['nombre' => 'Beige', 'hex' => '#F5F5DC'],
                    ['nombre' => 'Crema', 'hex' => '#FFFDD0'],
                    ['nombre' => 'Blanco', 'hex' => '#FFFFFF'],
                ],
                "talles" => ['S', 'M', 'L', 'XL'],
                "categoria" => "blazer"
            ],
            [
                "id" => 5,
                "nombre" => "Pantalón Alis",
                "precio" => 47000,
                "imagenes" => [
                    "images/productos/pantalones1.jpg",
                    "images/productos/pantalones1-2.jpg"
                ],
                "colores" => [
                    ['nombre' => 'Gris Oscuro', 'hex' => '#424242'],
                    ['nombre' => 'Negro', 'hex' => '#000000'],
                ],
                "talles" => ['S', 'M', 'L', 'XL'],
                "categoria" => "pantalones"
            ],
            [
                "id" => 6,
                "nombre" => "Pantalón jean Kentia",
                "precio" => 62000,
                "imagenes" => [
                    "images/productos/pantalones2.jpg",
                    "images/productos/pantalones2-2.jpg"
                ],
                "colores" => [
                    ['nombre' => 'Claro', 'hex' => '#A8C3D8'],
                    ['nombre' => 'Clásico', 'hex' => '#4F6D8A'],
                    ['nombre' => 'Oscuro', 'hex' => '#2F3E4E'],
                ],
                "talles" => ['S', 'M', 'L', 'XL'],
                "categoria" => "pantalones"
            ],
            [
                "id" => 7,
                "nombre" => "Camisa Manuela",
                "precio" => 43000,
                "imagenes" => [
                    "images/productos/camisa1.jpg",
                    "images/productos/camisa1-2.jpg"
                ],
                "colores" => [
                    ['nombre' => 'Blanco Frío', 'hex' => '#F5F7F8'],
                    ['nombre' => 'Celeste Apagado Claro', 'hex' => '#B7CBD6'],
                ],
                "talles" => ['S', 'M', 'L', 'XL'],
                "categoria" => "camisa"
            ],
            [
                "id" => 8,
                "nombre" => "Camisa Marga",
                "precio" => 35000,
                "imagenes" => [
                    "images/productos/camisa2.png",
                    "images/productos/camisa2-2.png"
                ],
                "colores" => [
                    ['nombre' => 'Celeste Claro', 'hex' => '#C7D9F2'],
                    ['nombre' => 'Celeste Clásico', 'hex' => '#9FBFE5'],
                    ['nombre' => 'Celeste Oscuro', 'hex' => '#6F95C8'],
                ],
                "talles" => ['S', 'M', 'L', 'XL'],
                "categoria" => "camisa"
            ],
            [
                "id" => 9,
                "nombre" => "Sweater Macarena",
                "precio" => 30000,
                "imagenes" => [
                    "images/productos/sweater3.png",
                    "images/productos/sweater3-2.png"
                ],
                "colores" => [
                    ['nombre' => 'Marrón', 'hex' => '#6D4C41'],
                    ['nombre' => 'Blanco', 'hex' => '#FFFFFF'],
                ],
                "talles" => ['S', 'M', 'L', 'XL'],
                "categoria" => "sweater"
            ],
            [
                "id" => 10,
                "nombre" => "Blazer Brun",
                "precio" => 47000,
                "imagenes" => [
                    "images/productos/blazer3.jpg",
                    "images/productos/blazer3-2.jpg"
                ],
                "colores" => [
                    ['nombre' => 'Beige Claro', 'hex' => '#E8E2D8'],
                    ['nombre' => 'Gris Rayado', 'hex' => '#8A8178'],
                ],
                "talles" => ['S', 'M', 'L', 'XL'],
                "categoria" => "blazer"
            ],
            [
                "id" => 11,
                "nombre" => "Pantalón Africa",
                "precio" => 52000,
                "imagenes" => [
                    "images/productos/pantalones3.png",
                    "images/productos/pantalones3-2.png"
                ],
                "colores" => [
                    ['nombre' => 'Marrón Chocolate', 'hex' => '#5A2E1F'],
                    ['nombre' => 'Marrón Cuero', 'hex' => '#7A3E26'],
                ],
                "talles" => ['S', 'M', 'L', 'XL'],
                "categoria" => "pantalones"
            ],
            [
                "id" => 12,
                "nombre" => "Camisa Tavard",
                "precio" => 47000,
                "imagenes" => [
                    "images/productos/camisa3.jpg",
                    "images/productos/camisa3-2.jpg"
                ],
                "colores" => [
                    ['nombre' => 'Azul Cielo Medio', 'hex' => '#6FA8DC'],
                    ['nombre' => 'Azul Suave', 'hex' => '#7EAED6'],
                    ['nombre' => 'Blanco', 'hex' => '#FFFFFF'],
                ],
                "talles" => ['S', 'M', 'L', 'XL'],
                "categoria" => "camisa"
            ],
            
        ];
    }

    /* TODO EL CATALOGO */
    public function verCatalogo()
    {
        $productos = $this->obtenerProductos();

        return view('frontend.productos.index', compact('productos'));
    }

    /* POR CATEGORIA */
    public function categoria($categoria)
    {
        $productos = $this->obtenerProductos();

        $filtrados = collect($productos)
            ->where('categoria', $categoria)
            ->values()
            ->all();

        return view('frontend.productos.index', [
            'productos' => $filtrados,
            'categoria' => $categoria
        ]);
    }

    /* DETALLE DEL PRODUCTO */
    public function mostrarProducto($id)
    {
        $productos = $this->obtenerProductos();

        $producto = collect($productos)->firstWhere('id', $id);

        return view('frontend.productos.show', compact('producto'));
    }

    /* MÉTODO PARA LA HOME */
    public function principal() 
    {
      $productos = $this->obtenerProductos();
      $ultimos = array_slice($productos, -4); 

      // Aquí es donde le decís qué archivo abrir:
       return view('frontend.principal', ['ultimosProductos' => $ultimos]);
    }

}
