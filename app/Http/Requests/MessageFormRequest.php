<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Contracts\Validation\ValidatesWhenResolved;
use Illuminate\Http\Exceptions\HttpResponseException;

class MessageFormRequest extends FormRequest implements ValidatesWhenResolved
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
        if($this->request->has("cancel")) {
            return [];
        }
        
        return [
            'telefone' => 'required',
            'mensagem' => 'required',
            'data_envio' => 'required',
        ];
    }
    
    public function messages()
    {
        return [
            'telefone.required' => 'O telefone deve ser informado',
            'mensagem.required' => 'A mensagem deve ser informada',
            'data_envio.max' => 'A data de envio deve ser informada'
        ];
    }
    
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['errors' => $validator->errors()], 422));
    }
}
