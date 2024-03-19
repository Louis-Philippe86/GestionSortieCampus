@extends('base')
@section('title')
    @parent | Se connecter
@endsection


@section('content')
    <h1 class="text-center">Sortir.com</h1>
    @if(session('error'))
        <div class="alert alert-warning m-auto text-center w-50 mb-3">{{session('error')}}</div>
    @endif
    <form action="" method="post" class="bg-dark text-white w-50 m-auto p-4">
        @csrf
        <fieldset class="container-fluid d-flex flex-column align-items-center">
            <legend class="text-center">Connectez-vous</legend>
            <div class="form-group m-3">
                <label for="email">Email</label>
                <input class="form-control" type="email" name="email" id="email" required placeholder="email@gmail.com" value="admin@admin.com">
            </div>
            <div class="form-group m-3">
                <label for="password">Mot de passe</label>
                <input class="form-control" type="password" name="password" id="password" value="admin" required placeholder="mot de passe">
            </div>
            <div class="container-fluid d-flex flex-row justify-content-center align-items-center">
                <button class="btn btn-light m-5" type="submit">Se connecter</button>
            </div>
        </fieldset>

    </form>


@endsection
