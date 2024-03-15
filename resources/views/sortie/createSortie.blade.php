@extends('base')
@section('title')
    @parent | Creer une sortie
@endsection

@section('content')
    <script defer src="{{ asset('js/datetime-now.js') }}"></script>
    <script defer src="{{ asset('js/date-now-m.js') }}"></script>
    <script>
        window.lieux = {!! json_encode(\App\Models\Lieu::all()) !!};
        window.ville = {!! json_encode(\App\Models\Ville::all()) !!};
    </script>
    <script defer src="{{ asset('js/createSortie_afficherLieux.js') }}"></script>


    <h1 class="text-center">Creer une sortie</h1>
    <form action="" method="post">
        @csrf
        <div>
            <label for="nom">Nom de la sortie</label>
            <input type="text" name="nom" id="nom">
            @error('nom')
                {{$errors}}
            @enderror

            <label for="dateHeureDebut">Date et heure du début</label>
            <input type="datetime-local" name="dateHeureDebut" id="dateHeureDebut">
            @error('dateHeureDebut')
                {{$errors}}
            @enderror

            <label for="dateLimiteInscription">Date limite d'inscription</label>
            <input type="date" name="dateLimiteInscription" id="dateLimiteInscription" >
            @error('dateLimiteInscription')
                {{$errors}}
            @enderror

            <label for="nbInscriptionMax">Places disponnible</label>
            <input type="number" name="nbInscriptionMax" id="nbInscriptionMax" >
            @error('nbInscriptionMax')
                {{$errors}}
            @enderror

            <label for="duree">Durée </label>
            <input type="number" name="duree" id="duree" >
            @error('nbInscriptionMax')
            {{$errors}}
            @enderror

            <label for="infosSortie">Information sur la sortie</label>
            <textarea name="infosSortie" id="infosSortie" cols="5" rows="10" ></textarea>
            @error('nbInscriptionMax')
            {{$errors}}
            @enderror
        </div>
        <div>
            <div>
                <input type="radio" id="getPlace" name="ajouterLieu" value="lieu" onchange="creationLieu('lieuExistant','nouveauLieu')" checked/>
                <label for="ajouterLieu">Récupere un lieu existant</label>
            </div>
            <div>
                <input type="radio" id="creatPlace" name="ajouterLieu" value="lieu" onchange="creationLieu('nouveauLieu','lieuExistant')"  />
                <label for="creatPlace">Creer un nouveau lieu</label>
            </div>
            <p>Campus : {{Auth::user()->campus->nom}}</p>
            <label for="ville">Ville : </label>
            <select name="ville_id" id="ville" onchange="updateLieux()">
                @foreach(\App\Models\Ville::all() as $ville)
                    <option value="{{$ville->id}}">{{$ville->nom}}</option>
                @endforeach
            </select>
        </div>
        <div>
            <!--Ajouter un lieu présent dans la bdd-->
            <div id="lieuExistant">
                <label for="lieu">Lieu : </label>
                <select name="lieu_id" id="lieu" onchange="updateDonneeLieu()"></select>
                <p id="rue"></p>
                <p id="longitude"></p>
                <p id="codePostal"></p>
                <p id="latitude"></p>
            </div>

            <!--Creer un nouveau lieu-->
            <div id="nouveauLieu">
               <div>
                    <label for="nomLieu">Nom du lieu : </label>
                    <input type="text" name="nom_lieu" id="nomLieu">
                    @error('nom')
                        {{$errors}}
                    @enderror
               </div>
                <div>
                    <label for="lieu_rue_id">Rue</label>
                    <input type="text" name="rue" id="lieu_rue_id">
                    @error('rue')
                        {{$errors}}
                    @enderror
               </div>
                <div>
                    <label for="longitude">longitude : </label>
                    <input type="text" name="longitude" id="longitude">
                    @error('longitude')
                        {{$errors}}
                    @enderror
               </div>
                <div>
                    <label for="latitude">Rue</label>
                    <input type="text" name="latitude" id="latitude">
                    @error('latitude')
                        {{$errors}}
                    @enderror
               </div>
            </div>
        </div>
        <button class="btn btn-primary" type="submit">Enregistrer</button>

    </form>
    <script src="{{asset('js/creationSortie_ajouterLieu.js')}}"></script>
@endsection
