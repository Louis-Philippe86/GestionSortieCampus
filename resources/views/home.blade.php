@extends('base')
@section('title')
    @parent | Home
@endsection


@section('content')

    @if($errors->any())
        <div class="alert alert-warning w-50 m-auto">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <h1 class="text-center mb-5">Sortir.com</h1>
    <section>
        <h5>Filtrer les sorties</h5>
        <form action="" method="post" >
            <div class="container-fluid d-flex flex-row">
                @csrf
                <div class="container-fluid d-flex flex-row col-12 ">
                    <div class="col-6">
                        <div class="container-fluid d-flex flex-row mt-3">
                            <label class="col-2" for="campus">Campus : </label>
                            <select class="col-3" name="campus_id" id="campus" >
                                @foreach(\App\Models\Campus::all() as $campus)
                                    <option value="{{$campus->id}}">{{$campus->nom}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="container-fluid d-flex flex-row mt-3">
                            <label class="col-2"  for="search">Rechercher</label>
                            <input class="col-5"  type="search" name="search" id="search">
                        </div>
                        <div class="container-fluid d-flex flex-row mt-3">
                            <label class="col-1"  for="dateMin">Entre </label>
                            <input class="col-3" type="date" name="dateMin" id="dateMin" >
                            <label class="col-1 ms-5"  for="dateMax">et </label>
                            <input class="col-3" type="date" name="dateMax" id="dateMax" >
                        </div>
                    </div>
                    <div class="container-fluid d-flex flex-column justify-content-center col-4 ">
                        <div class="container-fluid d-flex flex-row">
                            <input type="checkbox" id="ownSortie" name="ownSortie" checked />
                            <label class="ms-2" for="ownSortie">Sortie dont je suis l'organisateur</label>
                        </div>
                        <div class="container-fluid d-flex flex-row">
                            <input type="checkbox" id="sortieInscrit" name="sortieInscrit" />
                            <label class="ms-2" for="sortieInscrit">Sortie où je suis inscris</label>
                        </div>
                        <div class="container-fluid d-flex flex-row">
                            <input type="checkbox" id="sortieNonInscrit" name="sortieNonInscrit" />
                            <label class="ms-2" for="sortieNonInscrit">Sortie où je ne suis pas inscris</label>
                        </div>
                        <div class="container-fluid d-flex flex-row">
                            <input type="checkbox" id="sortieTermine" name="sortieTermine" />
                            <label class="ms-2" for="sortieTermine">Sortie passées</label>
                        </div>
                    </div >
                    <div class="d-flex justify-content-center align-items-center col">
                        <button class="btn btn-primary w-50 ms-3" type="submit">Rechercher</button>
                    </div>
                </div>
            </div>
        </form>
    </section>
{{--    @dump($datas);--}}
    <section class="container-fluid col-11 mt-5">
        <table class=" table table-bordered table-striped  mb-5">
            <thead class="">
            <tr class="table-dark align-middle">
                <th class="col-2 text-center">Nom de la sortie</th>
                <th class="col-1 text-center">Date de la sortie</th>
                <th class="col-1 text-center">Clôture</th>
                <th class="col-1 text-center">Inscrits / Places</th>
                <th class="col-1 text-center">Etat</th>
                <th class="col-1 text-center">Inscrit</th>
                <th class="col-1 text-center">Organisateur</th>
                <th class="col-5 text-center">Action</th>
            </tr>
            </thead>
            <tbody>
            @dump(\App\Models\Sortie::query()->find(24)->etat_id->libelle);


            @for($i = 0; $i<count($datas);$i++)
                <tr>
                    <td>{{$datas[$i]->nom}}</td>
                    <td>{{$datas[$i]->dateHeureDebut}}</td>
                    <td>{{$datas[$i]->dateLimiteInscription}}</td>
                    <td>../{{$datas[$i]->nbInscriptionMax}}</td>
{{--                    @dump($datas[$i])--}}
                    <td>{{$datas[$i]->etat_id}}</td>
                    <td>boolean inscrit</td>
                    <td>{{$datas[$i]->participant_id}}</td>
                    <td>action</td>

                </tr>
            @endfor
            </tbody>

        </table>
    </section>


@endsection
