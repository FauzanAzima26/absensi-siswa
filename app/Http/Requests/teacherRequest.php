<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class teacherRequest extends FormRequest
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
    public function rules(): array
    {
        $routeId= $this->route('guru');
        return [
            'nip' => 'required|string|max:20|unique:teachers,nip,'.$routeId . ',uuid',
            'name' => 'required|string|max:255',
            'class_id' => 'required|exists:kelas,id',
            'address' => 'required|string',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|unique:teachers,email,'.$routeId. ',uuid',
            'image' => $this->isMethod('POST') ? 'required|image|mimes:jpg,jpeg,png|max:2048' : 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'password' => $this->isMethod('POST') ? 'required|string|min:8' : 'nullable|string|min:8',
        ];
    }
}
