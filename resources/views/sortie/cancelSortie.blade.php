@extends('base')
@section('title')
    @parent | Annuler une sortie
@endsection

@section('content')


    @error('motif')
        <p class="alert alert-warning text-center w-50 m-auto">{{$message}}</p>
    @enderror
    @if(session('success'))
        <p class="alert alert-success text-center w-50 m-auto">{{session('success')}}</p>
    @endif

    <h1 class="text-center">Annuler une sortie</h1>
    <form action="" method="post" >
        <div class="container-fluid">
            @csrf
            <div class="container-fluid col-6">
                <div class="col-12">
                    <div class="container-fluid d-flex flex-row justify-content-center mt-3">
                        <label class="col-6" for="nom">Nom de la sortie</label>
                        <p class="col-6" type="text" id="nom">{{$sortie->nom}} </p>
                    </div>
                    <div class="container-fluid d-flex flex-row justify-content-center mt-3">
                        <label class="col-6"  for="dateHeureDebut">Début de la sortie</label>
                        <p class="col-6" type="text" id="dateHeureDebut">{{ \Carbon\Carbon::parse($sortie->dateHeureDebut)->format('d/m/Y à H:i')}} </p>
                    </div>
                    <div class="container-fluid d-flex flex-row justify-content-center mt-3">
                        <label class="col-6"  for="campus">Campus</label>
                        <p class="col-6" type="text" id="campus">{{$sortie->campus->nom}} </p>
                    </div>
                    <div class="container-fluid d-flex flex-row justify-content-center mt-3">
                        <label class="col-6" for="lieu">Places disponnible</label>
                        <p class="col-6" type="text" id="lieu">{{$sortie->lieu->afficherLieu()}} </p>
                    </div>
                    <div class="container-fluid d-flex flex-row justify-content-center mt-3">
                        <label class="col-6" for="motif">Information sur la sortie</label>
                        <textarea class="col-6" name="motif" id="motif" cols="5" rows="10" >Motif de l'annulation</textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid d-flex flex-row justify-content-center mt-5">
            <button class="btn btn-primary ms-3 col-2" type="submit">Enregistrer</button>
            <button class="btn btn-dark ms-4 col-2" type="button" onclick="window.location.href = '{{ route('home') }}'">Retour</button>
        </div>
    </form>

@endsection
