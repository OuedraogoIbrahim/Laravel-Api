<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/composition/composition.css') }}">
    <title>Composition</title>
</head>

<body>

    @if ($compositions != [])

        <section class="compos">

            <div class="home">
                @php
                    $compo_home = $compositions['home_team']['starting_lineups'];
                    $substitutes = $compositions['home_team']['substitutes'];
                @endphp

                <span class="home-team">{{ $match_infos['event_home_team'] }}</span>
                <span class="formation">{{ $match_infos['event_home_formation'] }}</span>

                <div class="compo-home-team">
                    @foreach ($compo_home as $ch)
                        <div class="group">
                            <span class="player">{{ $ch['player'] }}</span>
                            <p> <img class="picture-player" src="{{ $ch['player_image'] }}"></p>
                        </div>
                    @endforeach

                </div>

                <div class="substitutes">
                    <h2>Remplaçants</h2>
                    @foreach ($substitutes as $substitute)
                        <span class="player-substitute">
                            {{ $substitute['player'] }}
                        </span>
                    @endforeach

                </div>

                <span class="coach">
                    Entraineur : {{ $compositions['home_team']['coaches'][0]['coache'] ?? null }}
                </span>
            </div>

            <div class="away">
                @php
                    $compo_away = $compositions['away_team']['starting_lineups'];
                    $substitutes = $compositions['away_team']['substitutes'];
                @endphp
                <span class="away-team">{{ $match_infos['event_away_team'] }}</span>
                <span class="formation">{{ $match_infos['event_away_formation'] }}</span>

                <div class="compo-away-team">
                    @foreach ($compo_away as $ch)
                        <div class="group">
                            <span class="player">{{ $ch['player'] }}</span>
                            <p> <img class="picture-player" src="{{ $ch['player_image'] }}"></p>

                        </div>
                    @endforeach

                </div>

                <div class="substitutes">
                    <h2>Remplaçants</h2>
                    @foreach ($substitutes as $substitute)
                        <span class="player-substitute">
                            {{ $substitute['player'] }}
                        </span>
                    @endforeach
                </div>

                <span class="coach">
                    Entraineur : {{ $compositions['away_team']['coaches'][0]['coache'] ?? null }}
                </span>
            </div>

        </section>
    @endif
</body>

</html>
