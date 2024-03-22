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
    @if(session('success'))
        <div class="alert alert-success w-50 m-auto">
            <p class="text-center">{{session('success')}}</p>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-warning w-50 m-auto">
            <p class="text-center">{{session('error')}}</p>
        </div>
    @endif


    <h1 class="text-center mb-5">Sortir.com</h1>
    <section>
        <h5>Filtrer les sorties</h5>

        <form action="" method="get" >

            <div class="container-fluid d-flex flex-row">
                @csrf
                <div class="container-fluid d-flex flex-row col-12 ">
                    <div class="col-6">
                        <div class="container-fluid d-flex flex-row mt-3">
                            <label class="col-2" for="campus">Campus : </label>
                            <select class="col-3" name="campus_id" id="campus" >
                                @foreach(\App\Models\Campus::all() as $campus)
                                    <option value="{{$campus->id}}" @if(isset($_GET['campus_id']) && $_GET['campus_id'] == $campus->id) selected @endif>{{$campus->nom}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="container-fluid d-flex flex-row mt-3">
                            <label class="col-2"  for="search">Rechercher :</label>
                            <input class="col-5"  type="search" name="search" id="search" value="{{ request('search') }}" >

                        </div>
                        <div class="container-fluid d-flex flex-row mt-3">
                            <label class="col-1"  for="dateMin">Entre </label>
                            <input class="col-3" type="date" name="dateMin" id="dateMin" value="{{ request('dateMin') }}">
                            <label class="col-1 ms-5"  for="dateMax">et </label>
                            <input class="col-3" type="date" name="dateMax" id="dateMax" value="{{ request('dateMax') }}" >
                        </div>
                    </div>
                    <div class="container-fluid d-flex flex-column justify-content-center col-4 ">
                        <div class="container-fluid d-flex flex-row">
                            <input type="checkbox" id="ownSortie" name="ownSortie" @if(isset($_GET['ownSortie'])) checked @endif/>
                            <label class="ms-2" for="ownSortie" >Sortie dont je suis l'organisateur</label>
                        </div>
                        <div class="container-fluid d-flex flex-row">
                            <input type="checkbox" id="sortieInscrit" name="sortieInscrit" @if(isset($_GET['sortieInscrit'])) checked @endif />
                            <label class="ms-2" for="sortieInscrit">Sortie où je suis inscris</label>
                        </div>
                        <div class="container-fluid d-flex flex-row">
                            <input type="checkbox" id="sortieNonInscrit" name="sortieNonInscrit" @if(isset($_GET['sortieNonInscrit'])) checked @endif />
                            <label class="ms-2" for="sortieNonInscrit">Sortie où je ne suis pas inscris</label>
                        </div>
                        <div class="container-fluid d-flex flex-row">
                            <input type="checkbox" id="sortieTermine" name="sortieTermine" @if(isset($_GET['sortieTermine'])) checked @endif/>
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

    <section class="container-fluid col-11 mt-5 mb-5 pb-5">
        <table class=" table table-bordered table-striped  mb-5">
            <thead class="">
            <tr class="table-dark align-middle">
                <th class="col-2 text-center">Nom de la sortie</th>
                <th class="col-2 text-center">Date de la sortie</th>
                <th class="col-1 text-center">Clôture</th>
                <th class="col-1 text-center">Inscrits / Places</th>
                <th class="col-1 text-center">Etat</th>
                <th class="col-1 text-center">Inscrit</th>
                <th class="col-2 text-center">Organisateur</th>
                <th class="col text-center">Action</th>
            </tr>
            </thead>
            <tbody>
            @if($datas != null || $datas!=0)
                @for($i = 0; $i<count($datas);$i++)
    {{--         Si l'organisateur de la sortie est celui qui est connecté, alors on affcihe les sortie avec l'etat : "Cree"--}}
                    @if($datas[$i]->etat->libelle != 'Cree' || $datas[$i]->participant->nom == Auth::user()->nom)
                        <tr class="align-middle">
                            <td>{{$datas[$i]->nom}}</td>
                            <td>{{ \Carbon\Carbon::parse($datas[$i]->dateHeureDebut)->format('d/m/Y à H:m') }}</td>
                            <td>{{ \Carbon\Carbon::parse($datas[$i]->dateLimiteInscription)->format('d/m/Y') }}</td>
                            <td class="text-center">{{$datas[$i]->participants->count()}} / {{$datas[$i]->nbInscriptionMax}}</td>
                            <td class="text-center">{{$datas[$i]->etat->libelle}}</td>
                            <td class="text-center">
                                @foreach($datas[$i]->participants as $inscrit)
                                    @if($inscrit->nom == Auth::user()->nom)
                                        X
                                    @endif
                                @endforeach

                            </td>
                            <td>{{$datas[$i]->participant->nom}} {{$datas[$i]->participant->prenom[0]}}.</td>
                            <td>
                                @foreach(\App\Http\Controllers\AccueilController::optionAction($datas[$i], \Illuminate\Support\Facades\Auth::user()) as $option)
                                    {!! $option !!}
                                @endforeach
                            </td>
                        </tr>
                    @endif
                @endfor
            @endif
            </tbody>
        </table>

    </section>
@endsection
