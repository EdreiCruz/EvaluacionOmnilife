<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class empleados extends FormRequest
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
            'url' => ['required',
                Rule::unique('empleados')->ignore($this->route('empleado'))],
            'nombre' =>['required',
                Rule::notIn("£","¥","è","ù","ì","ò","Ç","Ø","ø","Å","å","Æ","æ","ß","¤","¡","ä","ö","ü","à","Ü","Ö","Ä",["0-9"])]
        ];
    }
}
