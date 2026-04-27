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
                "nombre" => "Cinto negro",
                "precio" => 3000,
                "imagenes" => [
                    "images/productos/cinto1.jpg",
                    "images/productos/cinto1-2.png"
                ],
                "categoria" => "cinto"
            ],
            [
                "id" => 2,
                "nombre" => "Cinto marrón",
                "precio" => 3500,
                "imagenes" => ["images/productos/cinto2.png"],
                "categoria" => "cinto"
            ],
            [
                "id" => 3,
                "nombre" => "Cartera random",
                "precio" => 8000,
                "imagenes" => ["images/productos/cartera1.jpg"],
                "categoria" => "cartera"
            ],
            [
                "id" => 4,
                "nombre" => "Cartera no se",
                "precio" => 12000,
                "imagenes" => ["images/productos/cartera2.png"],
                "categoria" => "cartera"
            ]
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
      $ultimos = array_slice($productos, -2); 

      // Aquí es donde le decís qué archivo abrir:
       return view('frontend.principal', ['ultimosProductos' => $ultimos]);
    }

}
