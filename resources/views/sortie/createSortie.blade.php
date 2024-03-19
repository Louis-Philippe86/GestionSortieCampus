@extends('base')
@section('title')
    @parent | Creer une sortie
@endsection

@section('content')
{{--    /////////////////////////////////////////////////////////////////--}}
    <!--Script pour générer des dates par deffaut-->
    <script defer src="{{ asset('js/datetime-now.js') }}"></script>
    <script defer src="{{ asset('js/date-now-m.js') }}"></script>

{{--    /////////////////////////////////////////////////////////////////--}}
    <!--Script pour l'affichage des menus de création de lieu-->
    <script>
        window.lieux = {!! json_encode(\App\Models\Lieu::all()) !!};
        window.ville = {!! json_encode(\App\Models\Ville::all()) !!};
    </script>
    <script defer src="{{ asset('js/createSortie_afficherLieux.js') }}"></script>
    <script src="{{asset('js/creationSortie_ajouterLieu.js')}}"></script>
{{--    /////////////////////////////////////////////////////////////////--}}

    @if($errors->any())
        <div class="alert alert-warning w-50 m-auto">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <h1 class="text-center">Creer une sortie</h1>
    <form action="" method="post" >
        <div class="container-fluid d-flex flex-row">
        @csrf
            <div class="container-fluid col-6">
                <div class="col-12">
                    <div class="container-fluid d-flex flex-row justify-content-center mt-3">
                        <label class="col-6" for="nom">Nom de la sortie</label>
                        <input class="col-6" type="text" name="nom" id="nom" value="nomSortie">
                    </div>
                    <div class="container-fluid d-flex flex-row justify-content-center mt-3">
                        <label class="col-6"  for="dateHeureDebut">Date et heure du début</label>
                        <input class="col-6"  type="datetime-local" name="dateHeureDebut" id="dateHeureDebut">
                    </div>
                    <div class="container-fluid d-flex flex-row justify-content-center mt-3">
                        <label class="col-6"  for="dateLimiteInscription">Date limite d'inscription</label>
                        <input class="col-6" type="date" name="dateLimiteInscription" id="dateLimiteInscription" >
                    </div>
                    <div class="container-fluid d-flex flex-row justify-content-center mt-3">
                        <label class="col-6" for="nbInscriptionMax">Places disponnible</label>
                        <input class="col-6" type="number" name="nbInscriptionMax" id="nbInscriptionMax" value="10">
                    </div>
                    <div class="container-fluid d-flex flex-row justify-content-center mt-3">
                        <label class="col-6" for="duree">Durée </label>
                        <input class="col-6" type="number" name="duree" id="duree" value="90">
                    </div>
                    <div class="container-fluid d-flex flex-row justify-content-center mt-3">
                        <label class="col-6" for="infosSortie">Information sur la sortie</label>
                        <textarea class="col-6" name="infosSortie" id="infosSortie" cols="5" rows="10" >Informtion sur la sortie</textarea>
                    </div>
                </div>
            </div>
            <div class="container-fluid col-6 d-flex flex-column ">
                <div class="col-12">
                    <p class=" fw-bold col-8 text-center">Vous êtes inscrit au campus de {{ Auth::user()->campus->nom }}</p>
                    <div class="container-fluid mt-3 col-8 d-flex align-items-center">
                    </div>
                    <div class="container-fluid d-flex flex-row col-8">
                        <div class="container-fluid d-flex flex-row justify-content-center mt-3">
                            <input  type="radio" id="getPlace" name="ajouterLieu" value="lieu" onchange="creationLieu('lieuExistant','nouveauLieu')" checked/>
                            <label class="ms-3" for="ajouterLieu">Récupere un lieu existant</label>
                        </div>
                        <div class="container-fluid d-flex flex-row justify-content-center mt-3">
                            <input type="radio" id="creatPlace" name="ajouterLieu" value="lieu" onchange="creationLieu('nouveauLieu','lieuExistant')"  />
                            <label class="ms-3" for="creatPlace">Creer un nouveau lieu</label>
                        </div>
                    </div>
                    <div class="container-fluid d-flex flex-row justify-content-center mt-3">
                        <label class="col-4" for="ville">Ville : </label>
                        <select class="col-4" name="ville_id" id="ville" onchange="updateLieux()">
                            @foreach(\App\Models\Ville::all() as $ville)
                                <option value="{{$ville->id}}">{{$ville->nom}}</option>
                            @endforeach
                        </select>
                    </div>


                        <!--Ajouter un lieu présent dans la bdd-->
                        <section id="lieuExistant">
                            <div class="container-fluid d-flex flex-row justify-content-center mt-3 mb-5">
                                <label class="col-4" for="lieu">Lieu : </label>
                                <select class="col-4" name="lieu_id" id="lieu" onchange="updateDonneeLieu()"></select>
                            </div>
                            <div class="container-fluid d-flex flex-row justify-content-center mt-3">
                                <p class="col-4" id="rue"></p>
                                <p class="col-4" id="longitude"></p>
                            </div>
                            <div class="container-fluid d-flex flex-row justify-content-center mt-3">
                                <p class="col-4" id="codePostal"></p>
                                <p class="col-4" id="latitude"></p>
                            </div>
                        </section>

                        <!--Creer un nouveau lieu-->
                        <section class="pt-5" id="nouveauLieu">
                            <p class="fw-bold col-11 text-center">Saisissez les information relative au lieu de la ville séléctionné</p>
                            <div class="container-fluid d-flex flex-row justify-content-center mt-3">
                                <label class="col-4" for="nomLieu">Nom du lieu : </label>
                                <input class="col-4" type="text" name="nom_lieu" id="nomLieu" value="nom du lieu">
                            </div>
                            <div class="container-fluid d-flex flex-row justify-content-center mt-3">
                                <label class="col-4" for="lieu_rue_id">Rue</label>
                                <input class="col-4" type="text" name="rue" id="lieu_rue_id" value="nom de la rue">
                            </div>

                            <div class="container-fluid d-flex flex-row justify-content-center mt-3">
                                <label class="col-4" for="longitude">longitude : </label>
                                <input class="col-4" type="text" name="longitude" id="longitude" value="50">
                            </div>

                            <div class="container-fluid d-flex flex-row justify-content-center mt-3">
                                <label class="col-4" for="latitude">latitude :</label>
                                <input class="col-4" type="text" name="latitude" id="latitude" value="100">
                            </div>

                        </section>
                </div>
            </div>
        </div>
        <div class="container-fluid d-flex flex-row justify-content-center mt-5 mb-5">
            <button class="btn btn-primary ms-3 col-2" type="submit">Enregistrer</button>
            <button class="btn btn-dark ms-4 col-2" type="button" onclick="window.location.href = '{{ route('home') }}'">Retour</button>
        </div>
    </form>

@endsection
