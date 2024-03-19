@extends('base')
@section('title')
    @parent | Mon profil
@endsection

@section('content')
    <h1 class="text-center mb-5">{{auth()->user()->nom}}</h1>
    @if(session('success'))
        <div class="alert alert-success w-25 m-auto p-2">
            <p class="text-center">{{session('success')}}</p>
        </div>
    @endif
    <br>
    <div class="container-fluid d-flex flex-row mb-5">
        <div class="col-5 col-5 d-flex align-items-center justify-content-center">
            <img class="img-fluid m-auto"
                 src="{{ !empty(auth()->user()->photo) ? asset('img/'.auth()->user()->photo) : asset('img/defaultProfil.png') }}"
                 alt="Photo de {{ auth()->user()->prenom }}"
                 style="max-width: 50%; height: auto;">
        </div>
        <div class="bg-dark w-50 text-white col-6 p-5">
            <div class="container-fluid d-flex flex-row justify-content-center">
                <p class="col-5">nom  : </p>
                <p class="col-5">{{auth()->user()->nom}}</p>
            </div>
            <div class="container-fluid d-flex flex-row justify-content-center">
                <p class="col-5">Prénom  : </p>
                <p class="col-5">{{auth()->user()->prenom}}</p>
            </div>
            <div class="container-fluid d-flex flex-row justify-content-center">
                <p class="col-5">Téléphone  : </p>
                <p class="col-5">{{auth()->user()->telephone}}</p>
            </div>
            <div class="container-fluid d-flex flex-row justify-content-center">
                <p class="col-5">Email  : </p>
                <p class="col-5">{{auth()->user()->email}}</p>
            </div>
            <div class="container-fluid d-flex flex-row justify-content-center">
                <p class="col-5">Campus  : </p>
                <p class="col-5">{{auth()->user()->campus->nom}}</p>
            </div>

            <div class="container-fluid d-flex col-6 bg-white mt-5">
                <div class="container-fluid d-flex justify-content-around p-3">
                    <button class="btn btn-primary" type="button" onclick="window.location.href = '{{ route('profil.formModify') }}'">Modifier</button>
                    <button class="btn btn-dark" type="button" onclick="window.location.href = '{{ route('home') }}'">Retour</button>

                </div>
            </div>
        </div>
    </div>

@endsection

