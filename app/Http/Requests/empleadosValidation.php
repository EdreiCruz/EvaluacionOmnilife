<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class empleadosValidation extends FormRequest
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
            'codigo' => ['required',Rule::unique('empleados')->ignore($this->route('empleado'))],
            'nombre' =>['required'],
            'salarioPesos'=>['required'],
            'salarioDolares'=>['required','min:1'],
            'direccion'=>['required'],
            'estado'=>['required'],
            'ciudad'=>['required'],
            'telefono'=>['required'],
            'correo'=>['required','email']
        ];
    }
}
