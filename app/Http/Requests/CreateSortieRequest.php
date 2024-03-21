<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateSortieRequest extends FormRequest
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

        $rules = [
            'nom'=>['required'],
            'dateHeureDebut'=>['required'],
            'duree'=>['required'],
            'dateLimiteInscription'=>['required'],
            'nbInscriptionMax'=>['required'],
            'infosSortie'=>['required'],
            'campus_id'=>['required'],
            'participant_id'=>['required'],


        ];

        if (!$request->has('lieu_id')) {
            $rules = array_merge($rules, [

                'lieu.nom' => ['required'],
                'lieu.rue' => ['required'],
                'lieu.latitude' => ['required'],
                'lieu.longitude' => ['required'],
                'lieu.ville_id' => ['required'],
            ]);
        }
        return $rules;
    }

    protected function prepareForValidation(): void
    {
        //Recuperation du campus_id de l'authentifié
        $this->merge(['campus_id'=> Auth::user()->campus->id]);
        $this->merge(['participant_id'=> Auth::user()->id]);


        /*
         * Si le lieu est un nouveau lieu crée par l'utilisateur,
         * il y'a absence de l'attribut 'lieu_id'
         * On creer le tableau qui contient les élément définissant le lieu pour l'instancier plus tard
         */
        if (!$this->has('lieu_id')) {
            $lieuData = [
                'nom' => $this->input('nom_lieu'),
                'rue' => $this->input('rue'),
                'latitude' => $this->input('latitude'),
                'longitude' => $this->input('longitude'),
                'ville_id' => $this->input('ville_id'),
            ];
            //Ajout du tableau contenant les informations sur le lieu
            $this->merge(['lieu' => $lieuData]);
            //Netoyage de la requête
            $this->request->remove('nom_lieu');
            $this->request->remove('rue');
            $this->request->remove('latitude');
            $this->request->remove('longitude');
            $this->request->remove('ville_id');
            $this->request->remove('ajouterLieu');
        }
    }

    public function messages() : array
    {
        return [
            'lieu.nom.required' => 'Le nom du lieu est requis.',
            'lieu.latitude.required' => 'La latitude est requise.',
            'lieu.longitude.required' => 'La longitude est requise.',
            'lieu.rue.required' => 'La rue est requise.',
            'lieu.ville_id.required' => 'La ville est requis.',

            'nom.required' => "Le nom de la sortie est requis.",
            'dateHeureDebut.required' => "Date de début obligatoire",
            'duree.required' => "Durée requise",
            'dateLimiteInscription.required' => "La date limite d'inscription est obligatoire.",
            'nbInscriptionMax.required' => "Le nombre d'inscrit doit être renseigné",
            'infosSortie.required' => "Décrivez la sortie",
            'campus_id.required' => "Le campus est obliatoire",


        ];

    }
}
