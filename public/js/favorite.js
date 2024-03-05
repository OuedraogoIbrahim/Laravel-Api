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
                        if (d.event_status == "Finished" || d.event_status == 'After Pen.' || d.event_status == 'Half Time') {
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
        console.log('reinitialisation');
        clearInterval(intervalId);
    }, 60000);
}
