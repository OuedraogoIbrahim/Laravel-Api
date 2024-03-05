<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Favoris</title>
    <link rel="stylesheet" href="{{ asset('css/home/home.css') }}">
</head>

<body>

    @empty($no_success)

        <div class="container" style="margin-top: 20px">
            @php
                $count = count($match);
            @endphp

            @for ($i = 0; $i < $count; $i++)
                <div class="match">

                    @if ($match[$i]['event_status'] == 'Finished')
                        @php
                            $score_final = $match[$i]['event_ft_result'];
                        @endphp
                    @else
                        @php
                            $score_final = null;
                        @endphp
                    @endif

                    @if ($match[$i]['event_final_result'] != '' && $match[$i]['event_status'] != 'Finished')
                        @php
                            $score_actuel = $match[$i]['event_final_result'];

                        @endphp
                    @else
                        @php
                            $score_actuel = null;
                        @endphp
                    @endif

                    <div class="domicile">

                        <p class="domicile-image"> <img src=" {{ $match[$i]['home_team_logo'] }} "> </p>
                        <a class="link"
                            href="{{ route('team', ['team' => $match[$i]['event_home_team']]) }}">{{ $match[$i]['event_home_team'] }}</a>

                    </div>

                    <div class="time">
                        @if (
                            $match[$i]['event_status'] == 'Finished' ||
                                $match[$i]['event_status'] == '' ||
                                $match[$i]['event_status'] == 'After Pen.')
                            <a class="match-finished-notbegin"
                                href="{{ route('match.details', ['home' => $match[$i]['event_home_team'], 'away' => $match[$i]['event_away_team'], 'date' => $match[$i]['event_date'], 'key' => $match[$i]['event_key'], 'home_team' => $match[$i]['home_team_key'], 'away_team' => $match[$i]['away_team_key']]) }}">
                                {{ $score_final ?? $match[$i]['event_time'] }} </a>

                            <span>{{ $match[$i]['event_status'] }}</span>
                            <div style="background-position: right center"
                                class="{{ 'like ' . $match[$i]['event_key'] . ' ' . $match[$i]['event_date'] . ' anim-like' }}">
                            </div>
                        @endif

                        @if (
                            $match[$i]['event_status'] != 'Finished' &&
                                $match[$i]['event_status'] != '' &&
                                $match[$i]['event_status'] != 'After Pen.')
                            <a class="match-played" id="{{ 'match-played' . $match[$i]['event_key'] }}"
                                href="{{ route('match.details', ['home' => $match[$i]['event_home_team'], 'away' => $match[$i]['event_away_team'], 'date' => $match[$i]['event_date'], 'key' => $match[$i]['event_key'], 'home_team' => $match[$i]['home_team_key'], 'away_team' => $match[$i]['away_team_key']]) }}">
                                {{ $score_actuel }} </a>

                            <span class="{{ 't' . $match[$i]['event_key'] }}">{{ $match[$i]['event_status'] }}
                            </span>
                            <div style="background-position: right center"
                                class="{{ 'like ' . $match[$i]['event_key'] . ' ' . $match[$i]['event_date'] . ' anim-like' }}">

                            </div>
                        @endif

                    </div>

                    <div class="exterieur">

                        <a class="link"
                            href="{{ route('team', ['team' => $match[$i]['event_away_team']]) }}">{{ $match[$i]['event_away_team'] }}</a>
                        <p class="exterieur-image"> <img src=" {{ $match[$i]['away_team_logo'] }} "> </p>

                    </div>

                </div>
            @endfor

        </div>
    @else
        <div style="color: white;">{{ $no_success }}</div>
    @endempty

    <script src="{{ asset('js/favorite.js') }}"></script>
    <script>
        var likes = document.querySelectorAll('.like');

        likes.forEach(like => {
            like.addEventListener('click', function() {

                like.style.backgroundPosition = 'left';
                var xhr = new XMLHttpRequest();

                xhr.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        var data = JSON.parse(this.response);
                        if ('erreur' in data) {
                            var erreur = data.erreur;
                            console.log('Suppression echoue');
                        } else {
                            location.reload();
                        }
                    }
                }
                xhr.open('DELETE', 'favorite/' + like.classList[1], true);

                // Récupérer le jeton CSRF à partir de la balise meta
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                // Ajouter le jeton CSRF à l'en-tête de la requête
                xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);

                xhr.send();

            })
        })
    </script>
</body>

</html>
