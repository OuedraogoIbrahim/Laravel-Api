<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Accueil</title>
    <link rel="stylesheet" href="{{ asset('css/home/home.css') }}">
</head>

<body>




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
        <form action="">
            <input type="search" name="equipe" placeholder="Nom de l'equipe recherché" required>
            <button>Rechercher</button>
        </form>

        <form action="">
            <input type="search" name="competition" placeholder="Nom de la competition recherché" required>
            <button>Rechercher</button>
        </form>
    </div>
    <div class="competitions"></div>


    <div class="date">
        @for ($i = 3; $i >= 1; $i--)
            <a class="{{ $date ==now()->subDays($i)->toDateString()? 'active': null }}"
                href="{{ route('specifity.date', [
                    'date' => now()->subDays($i)->toDateString(),
                ]) }}">
                {{ now()->subDays($i)->format('d-M') }}</a>
        @endfor
        <a class="{{ $date == now()->toDateString() ? 'active' : null }}"
            href="{{ route('home') }}">{{ 'Aujourd\'hui' }} </a>

        @for ($i = 1; $i <= 3; $i++)
            <a class="{{ $date ==now()->addDays($i)->toDateString()? 'active': null }}"
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
                            <a class="link" href="">{{ $league[$i]['event_home_team'] }}</a>

                        </div>

                        <div class="time">
                            @if ($league[$i]['event_status'] == 'Finished' || $league[$i]['event_status'] == '')
                                <a class="match-finished-notbegin"
                                    href="{{ route('match.details', ['home' => $league[$i]['event_home_team'], 'away' => $league[$i]['event_away_team'], 'date' => $league[$i]['event_date'], 'key' => $league[$i]['event_key'], 'home_team' => $league[$i]['home_team_key'], 'away_team' => $league[$i]['away_team_key']]) }}">
                                    {{ $score_final ?? $league[$i]['event_time'] }} </a>

                                <span>{{ $league[$i]['event_status'] }}</span>
                            @endif

                            @if ($league[$i]['event_status'] != 'Finished' && $league[$i]['event_status'] != '')
                                <a class="match-played"
                                    href="{{ route('match.details', ['home' => $league[$i]['event_home_team'], 'away' => $league[$i]['event_away_team'], 'date' => $league[$i]['event_date'], 'key' => $league[$i]['event_key'], 'home_team' => $league[$i]['home_team_key'], 'away_team' => $league[$i]['away_team_key']]) }}">
                                    {{ $score_actuel }} </a>

                                <span>{{ $league[$i]['event_status'] }}</span>
                            @endif


                        </div>

                        <div class="exterieur">

                            <a class="link" href="">{{ $league[$i]['event_away_team'] }}</a>
                            <p class="exterieur-image"> <img src=" {{ $league[$i]['away_team_logo'] }} "> </p>

                        </div>

                    </div>
                @endfor
            </div>
        @endforeach
    </div>
</body>

</html>
