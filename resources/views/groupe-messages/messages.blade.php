<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chat Group</title>
    <link rel="stylesheet" href="{{ asset('css/groupe_messages/messages.css') }}">
</head>

<body>

    <section class="container">

        <ul class="messages">
            @foreach ($messages as $m)
                <li class="message {{ Auth::user()->pseudo == $m->write_by ? 'me' : null }}">{{ $m->message }}</li>
                <li class="details">{{ $m->write_by }} <span> ****** </span> {{ $m->created_at }}</li>
            @endforeach
        </ul>

    </section>
    <div>
        <form action="" method="post">
            @csrf
            <textarea name="message" id="message" placeholder="Ecrivez votre message" required></textarea>
            <input type="submit" value="envoyer votre message">
        </form>
    </div>

    <script>
        const textarea = document.getElementById('message');

        textarea.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = this.scrollHeight + 'px';
        });
    </script>
</body>

</html>
