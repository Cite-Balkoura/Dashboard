const second = 1000, minute = second * 60, hour = minute * 60, day = hour * 24;

module.exports = {
    start: (eventId, date) => {
        const countdown = new Date(date).getTime();

        const days = document.getElementById(eventId + ".days"),
            hours = document.getElementById(eventId + ".hours"),
            minutes = document.getElementById(eventId + ".minutes"),
            seconds = document.getElementById(eventId + ".seconds");

        setInterval(() => {
            const distance = countdown - new Date().getTime();
            days.innerText = Math.floor(distance / (day)).toString() + " j";
            hours.innerText = Math.floor((distance % (day)) / (hour)).toString() + " h";
            minutes.innerText = Math.floor((distance % (hour)) / (minute)).toString() + " min";
            seconds.innerText = Math.floor((distance % (minute)) / second).toString() + " s";
        }, 1000);
    }
}
