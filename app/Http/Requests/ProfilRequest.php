<?php

namespace App\Http\Requests;


use App\Models\Campus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;


class ProfilRequest extends FormRequest
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
    public function rules(Request $request): array
    {


        return [
            'prenom'=>['required','min:3'],
            'nom'=>['required','min:3'],
            'telephone'=>['required'],
            'email'=>['required','email'],
            'password'=>['required','confirmed'],
            'password_confirmation'=>['required'],
            'campus_id'=>['required'],
        ];
    }
    public function messages() : array
    {
        return [
            'prenom.required' => 'Le prénom est requis.',
            'prenom.min' => 'Le prénom doit avoir au moins :min caractères.',
            'nom.required' => 'Le nom est requis.',
            'nom.min' => 'Le nom doit avoir au moins :min caractères.',
            'telephone.required' => 'Le téléphone est requis.',
            'email.required' => "L'email est requis.",
            'email.email' => "L'email doit être une adresse email valide.",
            'password.required' => "Le mot de passe est requis.",
            'password.confirmed' => "La confirmation du mot de passe ne correspond pas.",
            'campus_id.required' => "Le campus est requis.",
        ];
    }








}
