if (document.querySelector('.pseudo') != undefined) {
    var pseudo = document.getElementById('pseudo');
    pseudo.style.borderColor = 'red';
}

if (document.querySelector('.mdp') != undefined) {
    var mdp = document.getElementById('mdp');
    var mdpConfirm = document.getElementById('mdp_c');

    mdp.style.borderColor = 'red';
    mdpConfirm.style.borderColor = 'red';

}

var mdpValue = 0;
document.getElementById('mdp').addEventListener('input', function () {
    mdpValue = this.value;
    console.log(mdpValue)
})


document.getElementById('mdp_c').addEventListener('input', function () {
    if (mdpValue != 0) {
        if (mdpValue == this.value) {
            document.querySelector('.matching').innerHTML = '';

            var mdp = document.getElementById('mdp');
            var mdpConfirm = document.getElementById('mdp_c');

            mdp.style.borderColor = 'green';
            mdpConfirm.style.borderColor = 'green';
        } else {
            document.querySelector('.matching').innerHTML = 'Pas de correspondance';

            var mdp = document.getElementById('mdp');
            var mdpConfirm = document.getElementById('mdp_c');

            mdp.style.borderColor = 'red';
            mdpConfirm.style.borderColor = 'red';
        }
    }
})
