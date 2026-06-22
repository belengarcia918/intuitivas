<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'codigo_postal' => 'required|string|max:20',
            'calle'         => 'required|string|max:100',
            'numero'        => 'required|integer|min:1',
            'barrio'        => 'required|string|max:100',
            'ciudad'        => 'required|string|max:100',
            'provincia'     => 'required|string|max:100',

            'metodo_pago' => 'required|in:efectivo,debito,visa,mastercard,naranjax,mercadopago',
        ];
    }

    public function messages(): array
    {
        return [
            // Código postal
            'codigo_postal.required' => 'Debes ingresar un código postal.',
            'codigo_postal.max'      => 'El código postal no puede superar los 20 caracteres.',

            // Calle
            'calle.required' => 'Debes ingresar una calle.',
            'calle.max'      => 'La calle no puede superar los 100 caracteres.',

            // Número
            'numero.required' => 'Debes ingresar un número.',
            'numero.integer'  => 'El número debe ser un valor válido.',
            'numero.min'      => 'El número debe ser mayor a cero.',

            // Barrio
            'barrio.required' => 'Debes ingresar un barrio.',
            'barrio.max'      => 'El barrio no puede superar los 100 caracteres.',

            // Ciudad
            'ciudad.required' => 'Debes ingresar una ciudad.',
            'ciudad.max'      => 'La ciudad no puede superar los 100 caracteres.',

            // Provincia
            'provincia.required' => 'Debes ingresar una provincia.',
            'provincia.max'      => 'La provincia no puede superar los 100 caracteres.',

            // Método de pago
            'metodo_pago.required' => 'Debes seleccionar un método de pago.',
            'metodo_pago.max'      => 'El método de pago seleccionado no es válido.',
        ];
    }
}