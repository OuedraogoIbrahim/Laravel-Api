<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Match</title>
    <link rel="stylesheet" href="{{ asset('css/match/match.css') }}">
</head>

<body>


    @if ($statistiques != [])
        <section class="stats">
            <div class="stats-scroll">
                <div class="head">

                    <div class="domicile">
                        <p> <img src="{{ $match_infos['home_team_logo'] }}"></p>
                        <h3>{{ $match_infos['event_home_team'] }}</h3>
                    </div>

                    <div class="time-score">
                        <h3>
                            {{ $match_infos['event_final_result'] != '-' ? $match_infos['event_final_result'] : $match_infos['event_time'] }}
                        </h3>

                        <span> {{ $match_infos['event_date'] . ' - ' . $match_infos['league_round'] }}</span>

                        <h4>
                            {{ $match_infos['event_status'] }}
                        </h4>
                    </div>

                    <div class="exterieur">
                        <p> <img src="{{ $match_infos['away_team_logo'] }}"></p>
                        <h3>{{ $match_infos['event_away_team'] }}</h3>
                    </div>

                </div>

                <div class="statistiques">
                    @php
                        $count = count($statistiques);
                    @endphp
                    @for ($i = 0; $i < $count; $i++)
                        <div class="stats-details">
                            <span class="stats-home">{{ $statistiques[$i]['home'] }}</span>
                            <span class="subject">{{ $statistiques[$i]['type'] }}</span>
                            <span class="stats-away">{{ $statistiques[$i]['away'] }}</span>
                        </div>
                    @endfor
                </div>
            </div>
            <div id="changing-stats" class="no-active-button">Agrandir</div>
        </section>
    @endif

    <section id="events" class="active">
        <div class="event-scroll">
            <div class="head">

                <div class="domicile">
                    <p> <img src="{{ $match_infos['home_team_logo'] }}"></p>
                    <h3>{{ $match_infos['event_home_team'] }}</h3>
                </div>

                <div class="time-score">

                    <h3>
                        {{ $match_infos['event_final_result'] != '-' ? $match_infos['event_final_result'] : $match_infos['event_time'] }}
                    </h3>

                    <span> {{ $match_infos['event_date'] . ' - ' . $match_infos['league_round'] }}</span>

                    <h4>
                        {{ $match_infos['event_status'] }}
                    </h4>

                </div>

                <div class="exterieur">
                    <p> <img src="{{ $match_infos['away_team_logo'] }}"></p>
                    <h3>{{ $match_infos['event_away_team'] }}</h3>
                </div>

            </div>

            @if ($stats_during_match != [])
                <div class="statistiques">
                    @foreach ($stats_during_match as $stat_during_match)
                        <div class="stats-details">
                            <span class="stats-home">{{ $stat_during_match['home'] }}</span>
                            <span class="subject">{{ $stat_during_match['type'] }}</span>
                            <span class="stats-away">{{ $stat_during_match['away'] }}</span>
                        </div>
                    @endforeach
                </div>
            @endif

            @if ($events != [])
                <div class="event-detail">
                    <h2> Evenements</h2>

                    @foreach ($events as $event)
                        @if (
                            (isset($event['home_scorer']) && $event['home_scorer'] != '') ||
                                (isset($event['home_fault']) && $event['home_fault'] != '') ||
                                (isset($event['category_team']) && $event['category_team'] == 'home'))
                            <div class="home-details">

                                @if ($event['type'] == 'Carton')
                                    <span class="time-time">{{ $event['time'] . ' minutes' }}</span>
                                    <span class="type-type">{{ $event['type'] }}</span>
                                    <h5>{{ $event['home_fault'] }}</h5>
                                    <h5>{{ $event['card'] }}</h5>
                                @endif

                                @if ($event['type'] == 'But')
                                    <span class="time-time">{{ $event['time'] . ' minutes' }}</span>
                                    <span class="type-type">{{ $event['type'] }}</span>
                                    <h5> Bu : {{ $event['home_scorer'] }}</h5>
                                    <h5> Pa : {{ $event['home_assist'] != '' ? $event['home_assist'] : 'Neant' }}
                                    </h5>
                                @endif

                                @if ($event['type'] == 'Remplacement')
                                    <span class="time-time">{{ $event['time'] . ' minutes' }}</span>
                                    <span class="type-type">{{ $event['type'] }}</span>
                                    <h5> In : {{ $event['in'] }} </h5>
                                    <h5> Out : {{ $event['out'] }}</h5>
                                @endif
                            </div>
                        @else
                            <div class="away-details">
                                @if ($event['type'] == 'Carton')
                                    <span class="time-time">{{ $event['time'] . ' minutes' }}</span>
                                    <span class="type-type">{{ $event['type'] }}</span>
                                    <h5>{{ $event['away_fault'] }}</h5>
                                    <h5>{{ $event['card'] }}</h5>
                                @endif

                                @if ($event['type'] == 'But')
                                    <span class="time-time">{{ $event['time'] . ' minutes' }}</span>
                                    <span class="type-type">{{ $event['type'] }}</span>
                                    <h5> Bu : {{ $event['away_scorer'] }}</h5>
                                    <h5> Pa : {{ $event['away_assist'] != '' ? $event['away_assist'] : 'Neant' }}
                                    </h5>
                                @endif

                                @if ($event['type'] == 'Remplacement')
                                    <span class="time-time">{{ $event['time'] . ' minutes' }}</span>
                                    <span class="type-type">{{ $event['type'] }}</span>
                                    <h5> In : {{ $event['in'] }} </h5>
                                    <h5> Out : {{ $event['out'] }}</h5>
                                @endif
                            </div>
                        @endif
                    @endforeach

                </div>

            @endif

            <div class="team-results">

                @if (isset($face_to_face['H2H']))
                    @php
                        $count = count($face_to_face['H2H']);
                        if ($count > 5) {
                            $count = 5;
                        }
                    @endphp
                    <div class="face-to-face">

                        <h2>Confrontations directes</h2>
                        @for ($i = 0; $i < $count; $i++)
                            <div class="infos-confrontation">

                                <div class="home-team">
                                    {{ $face_to_face['H2H'][$i]['event_home_team'] }}
                                </div>

                                <div class="time-score">
                                    <h4>
                                        {{ $face_to_face['H2H'][$i]['event_date'] }}
                                    </h4>

                                    <h4> {{ $face_to_face['H2H'][$i]['event_final_result'] }}</h4>


                                </div>

                                <div class="away-team">
                                    {{ $face_to_face['H2H'][$i]['event_away_team'] }}
                                </div>
                            </div>
                        @endfor

                    </div>
                @endif

            </div>
        </div>
        <div id="changing-events" class="no-active-button">Agrandir</div>
    </section>


    <section class="ranking">
        @php
            $ranking = $ranking['total'];
            $count = count($ranking);
        @endphp

        <table>


            <thead>
                <tr>
                    <th>Position</th>
                    <th>Equipes</th>
                    <th>Jr</th>
                    <th>Pts</th>
                    <th>V</th>
                    <th>N</th>
                    <th>D</th>
                    <th>BM</th>
                    <th>BE</th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 0; $i < $count; $i++)
                    <tr
                        {{ $request['home_team'] == $ranking[$i]['team_key'] || $request['away_team'] == $ranking[$i]['team_key'] ? 'class=team-active' : null }}>
                        <td>{{ $ranking[$i]['standing_place'] }}</td>
                        <td>{{ $ranking[$i]['standing_team'] }}</td>
                        <td>{{ $ranking[$i]['standing_P'] }} </td>
                        <td>{{ $ranking[$i]['standing_PTS'] }} </td>
                        <td>{{ $ranking[$i]['standing_W'] }} </td>
                        <td>{{ $ranking[$i]['standing_D'] }} </td>
                        <td>{{ $ranking[$i]['standing_L'] }} </td>
                        <td>{{ $ranking[$i]['standing_F'] }} </td>
                        <td>{{ $ranking[$i]['standing_A'] }} </td>
                    </tr>
                @endfor
            </tbody>
        </table>
    </section>

    <section class="comments">
        <h1 class="cm-space">Espace commentaires</h1>
        <div class="my-comments">
            @forelse ($comments as $c)
                <div class="comment">
                    {{ $c->message }}

                    <span>{{ $c->sender }} {{ $c->created_at }}</span>
                </div>
            @empty
                <h2>Soyez le premier à laisser un commentaire</h2>
            @endforelse

        </div>
        @auth
            <form action="" method="POST" class="send-comment">
                @csrf
                <textarea name="message">Ecrivez votre commentaire par ici</textarea>
                <input type="submit" value="Commenter">
            </form>
        @endauth
        @guest
            <ul class="no-connect">
                <li style="text-align: center;font-style:italic;font-size:20px">Se connecter/S'inscrire pour pouvoir
                    commenter</li>
                <li><a href="{{ route('register') }}">S'inscrire</a></li>
                <li><a href="{{ route('login') }}">Se connecter</a></li>
            </ul>
        @endguest


    </section>

    <div class="menu">

        @if (
            $match_infos['lineups']['home_team']['starting_lineups'] != [] &&
                $match_infos['lineups']['away_team']['starting_lineups'] != []
        )
            <button id="compos">
                <a
                    href="{{ route('match.composition', ['home' => $match_infos['event_home_team'], 'away' => $match_infos['event_away_team'], 'date' => $match_infos['event_date'], 'key' => $match_infos['event_key']]) }}">Compositions</a>
            </button>
        @endif

        <button id="events-events" onclick="afficher('events' , event)">
            Evenements
        </button>


        @if ($statistiques != [] && $match_infos['event_status'] == 'Finished')
            <button id="stats" onclick="afficher('stats' , event)">
                Statistiques
            </button>
        @endif

        <button id="ranking" onclick="afficher('ranking' ,event)">
            Classement
        </button>

        <button id="comments" onclick="afficher('comments' , event)">Commentaires</button>

    </div>

    <script src="{{ asset('js/match.js') }}"></script>

    <script>
        // t.removeAttribute('id'); supprimer l'id


        function afficher(id, event) {

            var t = document.querySelector('.' + id);
            if (t == null) {
                t = null
            } else {
                //Recuperation du bouton sur lequel on appuie
                var event = event.target;
                // ******************8***

                // Modification de son id
                var f = event.id;
                f = f.trim(); //enleve les espaces au debut et a la fin
                event.id = f + '-' + f;
                // *********************

                //Recuperation de l'ancien element actif
                var ancienneClasse = document.querySelector('.active');
                //**********************88

                // Modification de sa classse
                ancienneClasse.className = ancienneClasse.id;
                // ************************

                // Recuperation de l'ancien bouton actif
                var g = document.querySelector('#' + ancienneClasse.id + '-' + ancienneClasse.id);
                var h = g.id;
                h = ancienneClasse.id;
                g.id = h;

                //************************************8

                //Modification de l'element dont le bouton devenu actif
                t.className = 'active';
                t.id = id;


            }
        }
    </script>





</html>
