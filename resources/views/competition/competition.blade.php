<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Competition</title>
    <link rel="stylesheet" href="{{ asset('css/competition/competition.css') }}">
</head>

<body>

    <section class="active" id="teams">

        <div class="teams-group">
            @foreach ($teams as $team)
                <div class="team">
                    <p> <img src="{{ $team['team_logo'] }}"> </p>
                    <h3><a href="{{ route('team', ['team' => $team['team_name']]) }}">{{ $team['team_name'] }}</a></h3>
                </div>
            @endforeach
        </div>

    </section>

    <section class="scorers">

        <table>


            <thead>
                <tr>
                    <th>Position</th>
                    <th>Nom</th>
                    <th>Buts</th>
                    <th>Equipe</th>
                    <th>Buts sur penaltie</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($scorers as $s)
                    <tr>
                        <td>{{ $s['player_place'] }}</td>
                        <td>{{ $s['player_name'] }}</td>
                        <td>{{ $s['goals'] }} </td>
                        <td>{{ $s['team_name'] }} </td>
                        <td>{{ $s['penalty_goals'] }} </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
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
                    <tr>
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

        <button id="teams-teams" onclick="afficher('teams' , event)">
            Equipes
        </button>



        <button id="scorers" onclick="afficher('scorers' , event)">
            Buteurs
        </button>

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
