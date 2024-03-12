@extends('base')
@section('content')
    <h1 class="text-center">Sortir.com</h1>
    <form action="" method="post" class="bg-dark text-white w-50 m-auto p-4">
        <fieldset class="container-fluid d-flex flex-column align-items-center">
            <legend class="text-center">Connectez-vous</legend>
            <div class="form-group m-3">
                <label for="idUser">Idenditifiant</label>
                <input class="form-control" type="email" name="idUser" id="idUser" required placeholder="email@gmail.com">
            </div>
            <div class="form-group m-3">
                <label for="pwUser">Mot de passe</label>
                <input class="form-control" type="text" name="pwUser" id="pwUser" required placeholder="mot de passe">
            </div>
            <div class="container-fluid d-flex flex-row justify-content-center align-items-center">
                <button class="btn btn-light m-5" type="submit">Se connecter</button>
                <input type="checkbox" id="remember_me" name="remember_me" checked>
                <label class="m-2" for="remember_me">Se souvenir de moi</label>

            </div>
        </fieldset>

    </form>
    @dump($data)

@endsection
