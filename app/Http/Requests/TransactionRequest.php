<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TransactionRequest extends FormRequest
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
            'vehicle' => 'required_if:expense,1'
        ];
    }

    public function messages(){
        return [
            'vehicle.required_if' => 'El :attribute es requerido'
        ];
    }

    public function attributes(){
        return [
            'vehicle' => trans_choice('tags.vehicle', 1)
        ];
    }
}
