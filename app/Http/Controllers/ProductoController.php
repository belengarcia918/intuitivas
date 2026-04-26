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
                "imagen" => "images/productos/cinto1.jpg",
                "descripcion" => "Cinto de cuero negro",
                "categoria" => "cinto"
            ],
            [
                "id" => 2,
                "nombre" => "Cinto marrón",
                "precio" => 3500,
                "imagen" => "images/productos/cinto2.png",
                "descripcion" => "Cinto de cuero marrón",
                "categoria" => "cinto"
            ],
            [
                "id" => 3,
                "nombre" => "Cartera random",
                "precio" => 8000,
                "imagen" => "images/productos/cartera1.jpg",
                "descripcion" => "Cartera random",
                "categoria" => "cartera"
            ],
            [
                "id" => 4,
                "nombre" => "Cartera no se",
                "precio" => 12000,
                "imagen" => "images/productos/cartera2.png",
                "descripcion" => "Cartera no se",
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


}
