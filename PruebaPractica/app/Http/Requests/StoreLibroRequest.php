<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLibroRequest extends FormRequest
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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombre' => 'required|string',
            'descripcion' => 'string|nullable',
            'idioma' => 'required|string',
            'precio' => 'required|numeric',
            'estado' => 'required|boolean',
            'fecha_ingreso' => 'required|date'
        ];
    }
}
