<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Accueil</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/home/home.css') }}">
</head>

<body>

    @if (session('status'))
        <div class="status">{{ session('status') }}</div>
    @endif

    <div class="loader">

        <span class="letter">C</span>
        <span class="letter">H</span>
        <span class="letter">A</span>
        <span class="letter">R</span>
        <span class="letter">G</span>
        <span class="letter">E</span>
        <span class="letter">M</span>
        <span class="letter">E</span>
        <span class="letter">N</span>
        <span class="letter">T</span>

    </div>

    <div class="big-container">

        <div class="logo">
            <h4 class="btn">
                <strong>ODISHA</strong>
                <div id="container-stars">
                    <div id="stars"></div>
                </div>

                <div id="glow">
                    <div class="circle"></div>
                    <div class="circle"></div>
                </div>
            </h4>
        </div>

        <div class="form">
            <form action="{{ route('team') }}" method="get">
                <input type="search" id="search-team-input" name="team" placeholder="Nom de l'equipe recherché"
                    required autocomplete="off">
                <button>Rechercher</button>
                <ul id="suggestions-team-list"></ul>

            </form>

            <form action="{{ route('competition') }}" method="get">
                <input type="search" id="search-input" name="competition" placeholder="Nom de la competition recherché"
                    required autocomplete="off">
                <ul id="suggestions-list"></ul>
                <button>Rechercher</button>
            </form>
        </div>

        <div class="calendar">
            <h4> Vous recherchez une date precise?</h4>
            <form action="" method="GET">
                <input type="date" name="date" id="date" value="{{ now()->format('Y-m-d') }}">
            </form>
        </div>

        <div class="date">
            @for ($i = 3; $i >= 1; $i--)
                <a
                    href="{{ route('specifity.date', [
                        'date' => now()->subDays($i)->toDateString(),
                    ]) }}">
                    {{ now()->subDays($i)->format('d-M') }}</a>
            @endfor
            <a href="{{ route('home') }}" class="active">{{ 'Aujourd\'hui' }} </a>

            @for ($i = 1; $i <= 3; $i++)
                <a
                    href="{{ route('specifity.date', [
                        'date' => now()->addDays($i)->toDateString(),
                    ]) }}">
                    {{ now()->addDays($i)->format('d-M') }} </a>
            @endfor
        </div>

        <div class="container">
            @foreach ($leagues as $league)
                <div class="country">
                    @php
                        $count = count($league);
                    @endphp
                    <div class="head">
                        <img src="{{ $league[0]['country_logo'] }} ">
                        <h1> {{ $league[0]['league_name'] }} </h1>
                        <h5> {{ $league[0]['league_round'] }}</h5>
                    </div>
                    @for ($i = 0; $i < $count; $i++)
                        <div class="match">
                            @php
                                if ($league[$i]['event_status'] == 'Finished') {
                                    $score_final = $league[$i]['event_ft_result'];
                                } else {
                                    $score_final = null;
                                }

                                if ($league[$i]['event_final_result'] != '' && $league[$i]['event_status'] != 'Finished') {
                                    $score_actuel = $league[$i]['event_final_result'];
                                } else {
                                    $score_actuel = null;
                                }

                            @endphp
                            <div class="domicile">

                                <p class="domicile-image"> <img src=" {{ $league[$i]['home_team_logo'] }} "> </p>
                                <a class="link"
                                    href="{{ route('team', ['team' => $league[$i]['event_home_team']]) }}">{{ $league[$i]['event_home_team'] }}</a>

                            </div>

                            <div class="time">
                                @if (
                                    $league[$i]['event_status'] == 'Finished' ||
                                        $league[$i]['event_status'] == '' ||
                                        $league[$i]['event_status'] == 'After Pen.')
                                    <a class="match-finished-notbegin"
                                        href="{{ route('match.details', ['home' => $league[$i]['event_home_team'], 'away' => $league[$i]['event_away_team'], 'date' => $league[$i]['event_date'], 'key' => $league[$i]['event_key'], 'home_team' => $league[$i]['home_team_key'], 'away_team' => $league[$i]['away_team_key']]) }}">
                                        {{ $score_final ?? $league[$i]['event_time'] }} </a>

                                    <span>{{ $league[$i]['event_status'] }}</span>
                                    @if (!isset($favorites))
                                        <div
                                            class="{{ 'like ' . $league[$i]['event_key'] . ' ' . $league[$i]['event_date'] }}">
                                        </div>
                                    @else
                                        @php
                                            $favorites_count = 0;
                                        @endphp
                                        @foreach ($favorites as $f)
                                            @if ($f->match_key == $league[$i]['event_key'])
                                                @php
                                                    $favorites_count = 1;
                                                @endphp
                                                <div style="background-position: right center"
                                                    class="{{ 'like ' . $league[$i]['event_key'] . ' ' . $league[$i]['event_date'] }}">
                                                </div>
                                            @endif
                                        @endforeach

                                        @if ($favorites_count == 0)
                                            <div
                                                class="{{ 'like ' . $league[$i]['event_key'] . ' ' . $league[$i]['event_date'] }}">
                                            </div>
                                        @endif
                                    @endif
                                @endif

                                @if (
                                    $league[$i]['event_status'] != 'Finished' &&
                                        $league[$i]['event_status'] != '' &&
                                        $league[$i]['event_status'] != 'After Pen.')
                                    <a class="match-played" id="{{ 'match-played' . $league[$i]['event_key'] }}"
                                        href="{{ route('match.details', ['home' => $league[$i]['event_home_team'], 'away' => $league[$i]['event_away_team'], 'date' => $league[$i]['event_date'], 'key' => $league[$i]['event_key'], 'home_team' => $league[$i]['home_team_key'], 'away_team' => $league[$i]['away_team_key']]) }}">
                                        {{ $score_actuel }} </a>

                                    <span
                                        class="{{ 't' . $league[$i]['event_key'] }}">{{ $league[$i]['event_status'] }}</span>

                                    @if (!isset($favorites))
                                        <div
                                            class="{{ 'like ' . $league[$i]['event_key'] . ' ' . $league[$i]['event_date'] }}">
                                        </div>
                                    @else
                                        @php
                                            $favorites_count = 0;
                                        @endphp
                                        @foreach ($favorites as $f)
                                            @if ($f->match_key == $league[$i]['event_key'])
                                                @php
                                                    $favorites_count = 1;
                                                @endphp
                                                <div style="background-position: right center"
                                                    class="{{ 'like ' . $league[$i]['event_key'] . ' ' . $league[$i]['event_date'] }}">
                                                </div>
                                            @endif
                                        @endforeach

                                        @if ($favorites_count == 0)
                                            <div
                                                class="{{ 'like ' . $league[$i]['event_key'] . ' ' . $league[$i]['event_date'] }}">
                                            </div>
                                        @endif
                                    @endif
                                @endif


                            </div>

                            <div class="exterieur">

                                <a class="link"
                                    href="{{ route('team', ['team' => $league[$i]['event_away_team']]) }}">{{ $league[$i]['event_away_team'] }}</a>
                                <p class="exterieur-image"> <img src=" {{ $league[$i]['away_team_logo'] }} "> </p>

                            </div>

                        </div>
                    @endfor
                </div>
            @endforeach
        </div>

        <div class="fixed">
            <span class="favorite"> <a href="{{ route('favorite') }}">Favoris</a></span>
            <span class="register"> <a href="{{ route('register') }}">S'inscrire</a></span>
        </div>

    </div>

    @guest
        <div class="guest">
            <h3>Connectez vous pour ajouter un favori </h3>
            <h5>Pas de compte ? créez en un </h5>
            <a href="{{ route('login') }}">Se connecter</a>
            <a href="{{ route('register') }}">S'nscrire</a>

        </div>
    @endguest

    <script src="{{ asset('js/home.js') }}"></script>

    <script>
        // Redirection lors du choix d'une date
        document.getElementById('date').addEventListener('change', function() {
            window.location.href = 'matchs/' + this.value;
        })

        //********Chargement de la page ******************
        const loader = document.querySelector('.loader');

        window.addEventListener('load', function() {
            loader.classList.add('loader-disparition');
        })

        // **************************************************************
        $(document).ready(function() {
            $('#search-input').on('input', function() {
                // Nettoyez les espaces blancs en début et fin de la chaîne
                let query = $(this).val().trim();

                if (query.length <= 1) {
                    $('.suggestions').hide();
                    $('#suggestions-list').empty();
                } else if (query.length >= 2) {
                    $.ajax({
                        url: 'search/suggestions',
                        method: 'GET',
                        data: {
                            query: query
                        },
                        success: function(data) {
                            // Supprimez les suggestions précédentes
                            $('#suggestions-list').empty();

                            // Ajoutez les nouvelles suggestions à la liste (limité à 5 suggestions)
                            for (let i = 0; i < Math.min(5, data.length); i++) {
                                $('#suggestions-list').append(
                                    '<li class="suggestion" data-suggestion="' + data[i] +
                                    '"> <a href="competition?competition=' +
                                    encodeURIComponent(data[i]) + '">' + data[i] +
                                    '</a></li>'

                                );
                            }

                            $('.suggestions').show();
                        },
                        error: function(error) {
                            console.error('Erreur lors de la récupération des suggestions',
                                error);
                        }
                    });
                } else {
                    // La chaîne de recherche est vide, nettoyez la liste des suggestions
                    $('.suggestions').hide();
                    $('#suggestions-list').empty();
                }
            });
        });

        //************************************************************************

        $(document).ready(function() {
            $('#search-team-input').on('input', function() {
                // Nettoyez les espaces blancs en début et fin de la chaîne
                let query = $(this).val().trim();

                if (query.length <= 1) {
                    $('.suggestions').hide();
                    $('#suggestions-team-list').empty();
                } else if (query.length >= 2) {
                    $.ajax({
                        url: 'search/suggestions/teams',
                        method: 'GET',
                        data: {
                            query: query
                        },
                        success: function(data) {
                            // Supprimez les suggestions précédentes
                            $('#suggestions-team-list').empty();

                            // Ajoutez les nouvelles suggestions à la liste (limité à 5 suggestions)
                            for (let i = 0; i < Math.min(5, data.length); i++) {
                                $('#suggestions-team-list').append(
                                    '<li class="suggestion" data-suggestion="' + data[i] +
                                    '"><a href="team?team=' + encodeURIComponent(data[i]) +
                                    '">' + data[i] + '</a></li>'


                                );
                            }

                            $('.suggestions').show();
                        },
                        error: function(error) {
                            console.error(
                                'Erreur lors de la récupération des suggestions',
                                error);
                        }
                    });
                } else {
                    // La chaîne de recherche est vide, nettoyez la liste des suggestions
                    $('.suggestions').hide();
                    $('#suggestions-team-list').empty();
                }
            });

        });
    </script>

</body>

</html>
