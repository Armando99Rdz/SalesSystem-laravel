<?php

namespace salesSys\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoriaFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // el usuario es autorizado para usar este request
    }

    /**
     * Agregando reglas para los valores provenientes de formularios
     * @return array
     */
    public function rules()
    {
        return [
            'nombre' => 'required|max:50', // obligatorio de 50 caracteres como max
            'descripcion' => 'max:256'
        ];
    }
}
