<?php

namespace Practica\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonaUpdateRequest extends FormRequest
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
          'ci'=>'unique:personas,ci|digits_between:5,10',
          'nombre'=>'required|max:50|',
          'apellido'=>'required|max:50',
          'sexo'=>'required',
          'fechadenacimiento'=>'required|date',
          'direccion'=>'required|max:100',
          'lugardenacimiento'=>'required|max:100',
          'estadocivil'=>'required',
          'gradoinstruccion'=>'required',
        ];
    }
}
