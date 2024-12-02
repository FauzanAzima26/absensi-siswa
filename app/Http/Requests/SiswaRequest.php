<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SiswaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        $routeId = $this->route('siswa');

        return [
            'nisn' => 'required|integer|unique:siswas,nisn,' . $routeId . ',uuid',
            'name' => 'required|string|max:255',
            'class_id' => 'required', 
            'date_of_birth' => 'required|date',
            'address' => 'required|string|max:500',
        ];
    }

}

