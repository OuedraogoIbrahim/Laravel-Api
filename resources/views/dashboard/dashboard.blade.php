<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My-Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard/dashboard.css') }}">
</head>

<body>

    <div class="card">

        <ul class="navbar">

            {{-- <div class="active">fermer</div> --}}

            <li class="profil">
                <h3>{{ $user->pseudo }}</h3>
                <div class="profil-details">
                    <ul>
                        <li class="nav-item"> <a href="">Mon profil </a></li>
                        <li class="nav-item"> <a href="{{ route('group.create') }}">Creer un groupe </a></li>
                        <li class="nav-item"> <a href="{{ route('logout') }}"> Deconnexion</a></li>
                    </ul>
                </div>
            </li>

            <li class="group">
                <h3>Vos groupes</h3>
                <div class="groups">
                    @if ($groups->isNotEmpty())
                        <ul>
                            @foreach ($groups as $g)
                                <li class="nav-item"> <a
                                        href="{{ route('msgGroup', ['name' => str_replace(' ', '-', $g->name), 'id' => $g->id]) }}">{{ $g->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <h4>Vous n'etes dans aucun groupe</h4>
                    @endif
                </div>
            </li>

            <li class="favorites">
                <h3>Mes favoris</h3>
                <a href="{{ route('favorite') }}">Voir mes favoris</a>
            </li>

        </ul>
    </div>

    <script src="{{ asset('js/dashboard.js') }}"></script>



</body>

</html>
