<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>team</title>
    <link rel="stylesheet" href="{{ asset('css/team/team.css') }}">
</head>

<body>

    <div class="logo">

        <h1>{{ $query }}</h1>
        <p> <img src="{{ $team_logo }}"></p>
    </div>



    <section id="team" class="active">

        <div class="team-group">
            <div class="goalkeepers">
                @php
                    $goalkeepers = $players['Goalkeepers'];
                @endphp

                <h3>Gardiens</h3>
                <table>


                    <thead>
                        <tr>
                            <th>Num</th>
                            <th>Nom</th>
                            <th>Age</th>
                            <th>Mj</th>
                            <th>Buts</th>
                            <th>Assist(s)</th>
                            <th>Carton-Jaune</th>
                            <th>Carton-Rouge</th>
                            <th>Note</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($goalkeepers as $g)
                            <tr>
                                <td>{{ $g['player_number'] }}</td>
                                <td>{{ $g['player_name'] . '  ' }} <img src="{{ $g['player_image'] }} ">
                                </td>
                                <td>{{ $g['player_age'] }} </td>
                                <td>{{ $g['player_match_played'] }} </td>
                                <td>{{ $g['player_goals'] }} </td>
                                <td>{{ $g['player_assists'] }} </td>
                                <td>{{ $g['player_yellow_cards'] }} </td>
                                <td>{{ $g['player_red_cards'] }} </td>
                                <td>{{ $g['player_rating'] }} </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="defenders">
                @php
                    $defenders = $players['Defenders'];
                @endphp

                <h3>Defenseurs</h3>
                <table>


                    <thead>
                        <tr>
                            <th>Num</th>
                            <th>Nom</th>
                            <th>Age</th>
                            <th>Mj</th>
                            <th>Buts</th>
                            <th>Assist(s)</th>
                            <th>Carton-Jaune</th>
                            <th>Carton-Rouge</th>
                            <th>Note</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($defenders as $d)
                            <tr>
                                <td>{{ $d['player_number'] }}</td>
                                <td>{{ $d['player_name'] . '  ' }} <img src="{{ $d['player_image'] }} ">
                                </td>
                                <td>{{ $d['player_age'] }} </td>
                                <td>{{ $d['player_match_played'] }} </td>
                                <td>{{ $d['player_goals'] }} </td>
                                <td>{{ $d['player_assists'] }} </td>
                                <td>{{ $d['player_yellow_cards'] }} </td>
                                <td>{{ $d['player_red_cards'] }} </td>
                                <td>{{ $d['player_rating'] }} </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="Milieux">
                @php
                    $midfielders = $players['Midfielders'];
                @endphp

                <h3>Milieux</h3>
                <table>


                    <thead>
                        <tr>
                            <th>Num</th>
                            <th>Nom</th>
                            <th>Age</th>
                            <th>Mj</th>
                            <th>Buts</th>
                            <th>Assist(s)</th>
                            <th>Carton-Jaune</th>
                            <th>Carton-Rouge</th>
                            <th>Note</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($midfielders as $m)
                            <tr>
                                <td>{{ $m['player_number'] }}</td>
                                <td>{{ $m['player_name'] . '  ' }} <img src="{{ $m['player_image'] }} ">
                                </td>
                                <td>{{ $m['player_age'] }} </td>
                                <td>{{ $m['player_match_played'] }} </td>
                                <td>{{ $m['player_goals'] }} </td>
                                <td>{{ $m['player_assists'] }} </td>
                                <td>{{ $m['player_yellow_cards'] }} </td>
                                <td>{{ $m['player_red_cards'] }} </td>
                                <td>{{ $m['player_rating'] }} </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="Milieux">
                @php
                    $forwards = $players['Forwards'];
                @endphp

                <h3>Attaquants</h3>
                <table>


                    <thead>
                        <tr>
                            <th>Num</th>
                            <th>Nom</th>
                            <th>Age</th>
                            <th>Mj</th>
                            <th>Buts</th>
                            <th>Assist(s)</th>
                            <th>Carton-Jaune</th>
                            <th>Carton-Rouge</th>
                            <th>Note</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($forwards as $f)
                            <tr>
                                <td>{{ $f['player_number'] }}</td>
                                <td>{{ $f['player_name'] . '  ' }} <img src="{{ $f['player_image'] }} ">
                                </td>
                                <td>{{ $f['player_age'] }} </td>
                                <td>{{ $f['player_match_played'] }} </td>
                                <td>{{ $f['player_goals'] }} </td>
                                <td>{{ $f['player_assists'] }} </td>
                                <td>{{ $f['player_yellow_cards'] }} </td>
                                <td>{{ $f['player_red_cards'] }} </td>
                                <td>{{ $f['player_rating'] }} </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    @if ($injured_players != [])

        <section class="hurt">

            <h3>Joueurs blessés</h3>

            @foreach ($injured_players as $ip)
                <div class="hurt-group">
                    <span>{{ $ip['name'] }}</span>
                    <p> <img src="{{ $ip['image'] }}"></p>
                </div>
            @endforeach

        </section>

    @endif


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
                        {{ strtolower($team_logo) == strtolower($ranking[$i]['team_logo']) ? 'class=team-active' : null }}>
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


    <div class="menu">

        <button id="team-team" onclick="afficher('team' , event)">
            Equipes
        </button>

        @if ($injured_players != [])
            <button id="hurt" onclick="afficher('hurt' , event)">
                Blessés
            </button>
        @endif
        <button id="ranking" onclick="afficher('ranking' ,event)">
            Classement
        </button>

    </div>


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


</body>

</html>
