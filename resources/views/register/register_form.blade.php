<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link rel="stylesheet" href="{{ asset('css/register_login/registerlogin_form.css') }}">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>

<body>

    <div class="container">

        <div class="instruction">
            <h3 data-aos="zoom-out-up" data-aos-duration="3000">Veuillez remplir tous les champs</h3>
        </div>

        <form action="" method="post">
            @csrf

            <div>
                <p> <input data-aos="fade-down-right" data-aos-duration="3000" id="pseudo" type="text"
                        name="pseudo" placeholder="Votre pseudo" autocomplete="off" value="{{ old('pseudo') }}"
                        required></p>
                @error('pseudo')
                    <h5 class="pseudo">{{ $message }}</h5>
                @enderror
            </div>

            <div>
                <p> <input data-aos="fade-down-right" data-aos-duration="3000" id="mdp" type="password"
                        name="password" placeholder="Votre mot de passe" autocomplete="off" required>
                </p>
                <span class="matching"></span>
                @error('password')
                    <h5 class="mdp"> {{ $message }}</h5>
                @enderror
            </div>

            <div>
                <p> <input data-aos="fade-down-right" data-aos-duration="3000" id="mdp_c" type="password"
                        name="password_confirmation" placeholder="Confrmer le mot de passe" autocomplete="off" required>
                </p>
            </div>


            <div>
                <p> <input type="submit" value="S'inscrire"></p>
            </div>

        </form>

        <div class="pass">
            <h4> <a href="{{ route('login') }}">Vous avez deja un compte?</a> </h4>
        </div>

    </div>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="{{ asset('js/register.js') }}"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>
