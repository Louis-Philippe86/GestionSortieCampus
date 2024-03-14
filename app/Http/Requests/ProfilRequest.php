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
            'nom'=>['required'],
            'telephone'=>['required'],
            'email'=>['required'],
            'password'=>['required','confirmed'],
            'password_confirmation'=>['required'],
            'campus_id'=>['required'],
        ];
    }







}
