<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'phone' => 'required|digits_between:8,15|unique:candidat,phone',
            'address' => 'required|string|max:255',
            'dateBorn' => 'required|date|before:' . now()->subYears(18)->format('Y-m-d'),
            'cin' => 'required|image|mimes:jpg,png,jpeg|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'dateBorn.after' => 'Vous devez avoir moins de 18 ans pour vous inscrire.',
        ];
    }
}
