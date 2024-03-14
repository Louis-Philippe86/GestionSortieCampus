@extends('base')
@section('title')
    @parent | Modifier le profil
@endsection

@section('content')
    <h1 class="text-center">Mon Profil</h1>
    @if(session('error'))
        <div class="alert alert-danger w-25 m-auto">
            <p class="text-center">{{session('error')}}</p>
        </div>
    @endif

    <form class="container-fluid d-flex flex-row" action="" method="post">
        @csrf
        <div class="col-4 col-4 d-flex align-items-center justify-content-center col">
            <img class="img-fluid" src="{{asset('img/7th-citadel-image.webp')}}"
                 alt="Photo de {{auth()->user()->prenom}}" style="max-width: 80%; height: auto;">
        </div>
        <div class="container-fluid d-flex flex-column col-8">
            <div class="container-fluid d-flex flex-row col-6 m-3">
                <label class="col-6" for="prenom">Prenom:</label>
                <input class="col-6" type="text" id="prenom" name="prenom" value="{{Auth::user()->prenom}}" required>
            </div>

            <div class="container-fluid d-flex flex-row col-6 m-3">
                <label class="col-6" for="nom">Nom:</label>
                <input class="col-6" type="text" id="nom" name="nom" value="{{Auth::user()->nom}}" required>
            </div>

            <div class="container-fluid d-flex flex-row col-6 m-3">
                <label class="col-6" for="telephone">Telephone:</label>
                <input class="col-6" type="tel" id="telephone" name="telephone" value="{{Auth::user()->telephone}}" required>
            </div>

            <div class="container-fluid d-flex flex-row col-6 m-3">
                <label class="col-6" for="email">Email:</label>
                <input class="col-6" type="email" id="email" name="email" required>
            </div>
            <div class="container-fluid d-flex flex-row col-6 m-3">
                <label class="col-6" for="campus">Campus :</label>
                <select class="col-6" name="campus_id" id="campus">
                    @foreach(\App\Models\Campus::all() as $campus)
                        <option value="{{$campus->id}}" {{Auth::user()->campus->nom == $campus->nom ? 'selected' :''}} >
                            {{$campus->nom}}</option>
                    @endforeach
                </select>
            </div>

            <div class="container-fluid d-flex flex-row col-6 m-3">
                <label class="col-6" for="password">Mot de passe :</label>
                <input class="col-6" type="password" id="motDePasse" name="password" required>
            </div>
            <div class="container-fluid d-flex flex-row col-6 m-3">
                <label class="col-6" for="password_confirmation">Confirmer le mot de passe:</label>
                <input class="col-6" type="password" id="password_confirmation" name="password_confirmation" required>
            </div>
            <div class="container-fluid d-flex flex-row col-6 m-3">
                <label class="col-6" for="updatePhoto">Modifier la photo</label>
                <button class="btn btn-warning col-6" type="button" id="updatePhoto" name="updatePhoto" >Importer une photo</button>
            </div>

            <div class="container-fluid d-flex flex-row mt-5">
                <button class="btn btn-primary w-25 ms-3" type="submit">Enregistrer</button>
                <button class="btn btn-dark ms-4 w-25" type="button" onclick="window.location.href = '{{ route('profil.show') }}'">Retour</button>
            </div>
        </div>

    </form>

@endsection
