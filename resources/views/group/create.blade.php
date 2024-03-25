<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Creation</title>
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/group/create.css') }}">

</head>

<body>

    <div class="container">
        <form class="form" action="" method="post" enctype="multipart/form-data">
            @csrf
            <p class="title">Creation d'un groupe</p>
            <p class="message">Tous les champs sont obligatoires </p>
            <div class="flex">
                <label>
                    <input class="input" type="text" name="name" id="name" required
                        value="{{ old('name') }}">
                    <span>Nom du groupe</span>
                    @error('name')
                        <h5>{{ $message }}</h5>
                    @enderror
                </label>

            </div>

            <label>
                <input class="input" type="text" name="description" id="description" required
                    value="{{ old('description') }}">
                <span>La description</span>

                @error('description')
                    <h5> {{ $message }}</h5>
                @enderror
            </label>


            <label>
                <select name="select" required>
                    <option value="">
                        <h3>selectionner la categorie</h3>
                    </option>

                    <option value="1">
                        Tous le monde peut ecrire
                    </option>


                    <option value="2">
                        Uniquement l'admin peut ecrire
                    </option>

                </select>

                @error('select')
                    <h5> {{ $message }}</h5>
                @enderror
            </label>

            <button class="submit">Créer</button>
            <p class="signin">Revenir en arrierre <a href="{{ route('dashboard') }}">Cliquez ici</a> </p>



        </form>
    </div>
    <script>
        new TomSelect('select');
    </script>


</body>

</html>
