
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{route('home')}}">Accueil</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a @class(['nav-link','active'=> request()->route()->getName() ==='{{#}}'])  aria-current="page" href="#">Villes</a>
                </li>
                <li class="nav-item">
                    <a @class(['nav-link','active'=> request()->route()->getName() ==='{{#}}'])  aria-current="page" href="#">Campus</a>
                </li>
                <li class="nav-item">
                    <a @class(['nav-link','active'=> request()->route()->getName() ==='{{#}}'])  aria-current="page" href="{{route('profil.show')}}">Mon Profil</a>
                </li>
                <li class="nav-item">
                    <a @class(['nav-link','active'=> request()->route()->getName() ==='sortie.form-create'])  aria-current="page" href="{{route('sortie.form-create')}}">Creer une sortie</a>
                </li>
                <li class="nav-item">
                    <a @class(['nav-link','active'=> request()->route()->getName() ==='{{#}}'])  aria-current="page" href="{{route('login.logout')}}">Se déconnecter</a>
                </li>
                <li class="nav-item">
                    <a @class(['nav-link','active'=> request()->route()->getName() ==='{{#}}'])  aria-current="page" href="{{route('sortie.formCanceled')}}">Annuler Une sortie</a>
                </li>
            </ul>
        </div>
        <div>
            <p class="fst-italic me-3">Bienvenue, {{\Illuminate\Support\Facades\Auth::user()->prenom}}</p>
        </div>
    </div>

</nav>

