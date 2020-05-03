<?php

namespace salesSys\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticuloFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Validaciones de valores para el modelo/tabla articulo
     * @return array
     */
    public function rules()
    {
        return [
            'idcategoria' => 'required',
            'codigo' => 'required|max:50',
            'nombre' => 'required|max:100',
            'stock' => 'required|numeric',
            'descripcion' => 'max:512', // opcional
            'imagen' => 'mimes:jpeg,png,jpg,gif|max:1000' // formato de imagenes permitidas
        ];
    }
}
