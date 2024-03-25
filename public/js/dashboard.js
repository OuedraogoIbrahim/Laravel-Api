let act = document.querySelector('.active');
act.addEventListener('click', function () {
    act.classList = 'no-active';
    let nav = document.querySelector('.navbar');
    nav.style.width = 0;
    nav.style.transition = '2s';
    nav.style.visibility = 'hidden';

    // act.style.visibility = 'visible'
}
);