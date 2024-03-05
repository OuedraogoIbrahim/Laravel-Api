document.getElementById('changing-events').addEventListener('click', function () {
    if (this.className == 'active-button') {

        var eventScroll = document.querySelector('.event-scroll');
        if (eventScroll) {
            eventScroll.style.height = null;
            eventScroll.style.transition = '3s';
            this.className = 'no-active-button';
            this.innerHTML = 'Agrandir';
        }
    } else {
        var eventScroll = document.querySelector('.event-scroll');
        eventScroll.style.height = eventScroll.scrollHeight + 'px';
        eventScroll.style.transition = '3s';
        this.className = 'active-button';
        this.innerHTML = 'Reduire';

    }
})

if (document.getElementById('changing-stats')) {
    document.getElementById('changing-stats').addEventListener('click', function () {
        if (this.className == 'active-button') {
            var eventScroll = document.querySelector('.stats-scroll');
            if (eventScroll) {
                eventScroll.style.height = null;
                eventScroll.style.transition = '1.4s';
                this.className = 'no-active-button';
                this.innerHTML = 'Agrandir';
            }
        } else {
            var eventScroll = document.querySelector('.stats-scroll');
            eventScroll.style.height = eventScroll.scrollHeight + 'px';
            eventScroll.style.transition = '1.4s';
            this.className = 'active-button';
            this.innerHTML = 'Reduire';

        }
    })
}