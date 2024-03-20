@extends('base')
@section('title')
    @parent | Afficher
@endsection

@section('content')
    <h1 class="text-center m-5">Sortie à {{$sortie->nom}} organisé par {{$sortie->participant->nom}}</h1>
    <section class=" container-fluid bg-dark text-white m-5 col-11 p-3">
        <div class="container-fluid d-flex flex-row">
            <div class="container-fluid col-5">
                <div class="col-12">
                    <div class="container-fluid d-flex flex-row justify-content-center mt-3">
                        <p class="col-6" >Nom de la sortie :</p>
                        <p class="col-6" >{{$sortie->nom}}</p>
                    </div>
                    <div class="container-fluid d-flex flex-row justify-content-center mt-3">
                        <p class="col-6" >Date et heure du début :</p>
                        <p class="col-6" >{{\Carbon\Carbon::parse($sortie->dateHeureDebut)->format('d/m/Y à H:i')}}</p>
                    </div>
                    <div class="container-fluid d-flex flex-row justify-content-center mt-3">
                        <p class="col-6" >Date limite d'inscription :</p>
                        <p class="col-6">{{\Carbon\Carbon::parse($sortie->dateLimiteInscription)->format('d/m/Y')}}</p>
                    </div>
                    <div class="container-fluid d-flex flex-row justify-content-center mt-3">
                        <p class="col-6">Nombre de place disponnible :</p>
                        <p class="col-6">{{$sortie->nbInscriptionMax}}</p>
                    </div>
                    <div class="container-fluid d-flex flex-row justify-content-center mt-3">
                        <p class="col-6">Durée :</p>
                        <p class="col-6">{{$sortie->duree}} minute</p>
                    </div>
                    <div class="container-fluid d-flex flex-row justify-content-center mt-3">
                        <p class="col-6">Information sur la sortie :</p>
                        <p class="col-6">{{$sortie->infosSortie}}</p>
                    </div>
                </div>
            </div>
            <div class="container-fluid col-5 d-flex flex-column ">
                <div class="col-12">
                    <div class="container-fluid d-flex flex-row justify-content-center mt-3">
                        <p class="col-6">Campus : </p>
                        <p class="col-6">{{$sortie->participant->campus->nom}}</p>
                    </div>
                    <div class="container-fluid d-flex flex-row justify-content-center mt-3">
                        <p class="col-6" >Nom du lieu : </p>
                        <p class="col-6" >{{$sortie->lieu->nom}}</p>
                    </div>
                    <div class="container-fluid d-flex flex-row justify-content-center mt-3">
                        <p class="col-6" >Rue :</p>
                        <p class="col-6" >{{$sortie->lieu->rue}}</p>
                    </div>

                    <div class="container-fluid d-flex flex-row justify-content-center mt-3">
                        <p class="col-6" >longitude : </p>
                        <p class="col-6" >{{$sortie->lieu->longitude}}</p>
                    </div>

                    <div class="container-fluid d-flex flex-row justify-content-center mt-3">
                        <p class="col-6" >latitude :</p>
                        <p class="col-6" >{{$sortie->lieu->latitude}}</p>
                    </div>
                </div>
            </div>
        </div>

        @if($sortie->etat_id == 6)

            <p class="text-center fst-italic fw-bold text-white mt-5 mb-5">Sortie annulee</p>
        @endif
    </section>
    @if($sortie->etat_id == 1)
        <form class="d-flex justify-content-center align-items-center mb-5" method="post">
            @csrf
            <button class="btn btn-primary col-2 m-auto" type="submit">Publier</button>
        </form>
    @endif
{{--    <section class="mb-5">--}}
{{--        <h3>Participants</h3>--}}
{{--        TODO:Ajouter les participants inscrit--}}

{{--    </section>--}}
@endsection
