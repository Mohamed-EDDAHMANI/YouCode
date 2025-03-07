<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuestionRequest extends FormRequest
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
            'questionDesignation' => 'required',
            'type' => 'in:choices,bool',
            'is_correct' => 'required_if:type,choices|integer|min:0|max:3',
        ];
    }

    public function messages()
    {
        return [
            'questionDesignation.required' => 'La question est obligatoire.',
            'questionDesignation.min' => 'La question doit contenir au moins 5 caractères.',
            'type.required' => 'Veuillez sélectionner un type de question.',
            'designation.required' => 'Les réponses sont obligatoires.',
            'designation.min' => 'Il faut au moins 2 réponses.',
            'designation.max' => 'Vous ne pouvez pas ajouter plus de 4 réponses.',
            'is_correct.required_if' => 'Veuillez sélectionner une réponse correcte.',
            'is_correct.integer' => 'La réponse correcte doit être un numéro valide.',
            'vrai.required_if' => 'Veuillez sélectionner Vrai ou Faux.',
        ];
    }
}
