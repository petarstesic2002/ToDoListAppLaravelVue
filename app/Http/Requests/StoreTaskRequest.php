<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use \Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreTaskRequest extends FormRequest
{
    public function rules():array{
        return [
            'title' => 'required|min:2|max:255',
            'description' => 'required|min:2|max:255'
        ];
    }
    public function messages(): array
    {
        return [
            'title.required' => 'Naziv je obavezan.',
            'title.min' => 'Naziv mora imati bar 2 karaktera.',
            'title.max' => 'Naziv ne sme biti duzi od 255 karaktera.',
            'description.required' => 'Opis je obavezan.',
            'description.min' => 'Opis mora imati bar 2 karaktera.',
            'description.max' => 'Opis ne sme biti duzi od 255 karaktera.',
        ];
    }
    public function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json([
            'success' => 'false',
            'message' => 'Greške u validaciji',
            'data' => $validator->errors()
        ]));
    }
}
