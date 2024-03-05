
var xhr = new XMLHttpRequest();
var intervalId;
var erreur;
intervalId = setInterval(() => {

    xhr.onreadystatechange = function () {

        if (this.readyState == 4 && this.status == 200) {
            var data = JSON.parse(this.response);
            if ('erreur' in data) {
                erreur = data.erreur;
                console.log('Aucun match');
            } else {
                data.forEach(dt => {
                    dt.forEach(d => {
                        if (d.event_status == "Finished" || d.event_status == 'After Pen.') {
                            document.getElementById('match-played' + d.event_key).style.backgroundColor = 'grey';
                            document.getElementById('match-played' + d.event_key).classList = 'match-finished-notbegin';
                        } else {
                            var time = document.querySelector('.t' + d.event_key);
                            if (time != null) {
                                var score = document.getElementById('match-played' + d.event_key);
                                time.innerHTML = d.event_status;
                                score.innerHTML = d.event_final_result;
                            }
                        }
                    });
                });
            }
        }
    }

    xhr.open('GET', 'live', true);
    xhr.send();


}, 30000);

if (typeof (erreur) != 'undefined') {
    setTimeout(() => {
        clearInterval(intervalId);
    }, 60000);
}

const likes = document.querySelectorAll('.like');

likes.forEach(like => {
    let countLike = 0;
    let requestInProgress = false; // Autorisation que d'1 requete a la fois

    like.addEventListener('click', () => {


        if (document.querySelector('.guest')) {
            document.querySelector('.guest').classList = 'guest-active';
            document.body.style.overflow = 'hidden';
            document.querySelector('.big-container').style.filter = 'blur(5px)';
            return;
        }

        if (document.querySelector('.guest-active')) {
            return;
        }
        if (requestInProgress) {
            return;
            // return alert('Une requete est deja en cours');
        }
        $classes = like.classList;
        if ($classes.length == 3) {
            var key = $classes[1];
            var date = $classes[2];
            const xhr = new XMLHttpRequest();

            if (countLike === 0) {
                requestInProgress = true;
                xhr.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        like.classList.toggle('anim-like');
                        countLike = 1;
                        like.style.backgroundPosition = 'right';
                        requestInProgress = false;
                    }
                };

                xhr.open('POST', 'favorite/' + key + '/' + date, true);

                // Récupérer le jeton CSRF à partir de la balise meta
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                // Ajouter le jeton CSRF à l'en-tête de la requête
                xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
                xhr.send();

            } else {
                requestInProgress = true;
                xhr.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        countLike = 0;
                        like.style.backgroundPosition = 'left';
                        requestInProgress = false;
                    }
                };

                xhr.open('DELETE', 'favorite/' + key, true);

                // Récupérer le jeton CSRF à partir de la balise meta
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                // Ajouter le jeton CSRF à l'en-tête de la requête
                xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
                xhr.send();
            }
        }
    });


    like.addEventListener('animationend', () => {
        like.classList.toggle('anim-like');
    });
});


document.body.addEventListener('click', function (event) {
    if (document.querySelector('.guest-active')) {
        if (!document.getElementById('no-connect')) {
            document.querySelector('.guest-active').id = 'no-connect';
            return;
        }

        var maDiv = document.querySelector('.guest-active');

        if (!maDiv.contains(event.target)) {
            document.querySelector('.guest-active').id = null;
            document.querySelector('.guest-active').classList = 'guest';
            document.querySelector('.big-container').style.filter = 'unset';
            document.body.style.overflow = 'auto';

        }

    }
})