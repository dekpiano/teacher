countDow("2022/02/28 08:30:00", "28t0830", "show-28t0830");
countDow("2022/02/28 09:30:00", "28t0930", "show-28t0930");
countDow("2022/02/28 10:30:00", "28t1030", "show-28t1030");
countDow("2022/02/28 11:00:00", "28t1100", "show-28t1100");
countDow("2022/02/28 11:30:00", "28t1130", "show-28t1130");
countDow("2022/02/28 13:00:00", "28t1300", "show-28t1300");
countDow("2022/02/28 13:30:00", "28t1330", "show-28t1330");
countDow("2022/02/28 14:00:00", "28t1400", "show-28t1400");

countDow("2022/03/01 08:30:00", "1t0830", "show-1t0830");
countDow("2022/03/01 09:30:00", "1t0930", "show-1t0930");
countDow("2022/03/01 10:30:00", "1t1030", "show-1t1030");
countDow("2022/03/01 11:30:00", "1t1130", "show-1t1130");
countDow("2022/03/01 13:00:00", "1t1300", "show-1t1300");
countDow("2022/03/01 13:30:00", "1t1330", "show-1t1330");
countDow("2022/03/01 14:00:00", "1t1400", "show-1t1400");
countDow("2022/03/01 12:00:00", "1t1200", "show-1t1200");

countDow("2022/03/02 08:30:00", "t0830", "show-t0830");
countDow("2022/03/02 09:30:00", "t0930", "show-t0930");
countDow("2022/03/02 10:30:00", "t1030", "show-t1030");
countDow("2022/03/02 11:00:00", "t1100", "show-t1100");
countDow("2022/03/02 11:30:00", "t1130", "show-t1130");
countDow("2022/03/02 13:00:00", "t1300", "show-t1300");
countDow("2022/03/02 13:30:00", "t1330", "show-t1330");
countDow("2022/03/02 14:00:00", "t1400", "show-t1400");

countDow("2022/03/03 08:30:00", "3t0830", "show-3t0830");
countDow("2022/03/03 09:30:00", "3t0930", "show-3t0930");
countDow("2022/03/03 10:30:00", "3t1030", "show-3t1030");
countDow("2022/03/03 11:30:00", "3t1130", "show-3t1130");
countDow("2022/03/03 13:00:00", "3t1300", "show-3t1300");
countDow("2022/03/03 13:30:00", "3t1330", "show-3t1330");
countDow("2022/03/03 14:00:00", "3t1400", "show-3t1400");


function countDow(params, time, show) {


    // Set the date we're counting down to
    var countDownDate = new Date(params).getTime();

    // Update the count down every 1 second
    var x = setInterval(function() {

        // Get today's date and time
        var now = new Date().getTime();

        // Find the distance between now and the count down date
        var distance = countDownDate - now;

        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Display the result in the element with id="demo"
        var xxx = document.getElementsByClassName(time);
        var i;
        for (i = 0; i < xxx.length; i++) {
            document.getElementsByClassName(time)[i].innerHTML = "จะเปิดในอีก<br>" + days + "d " + hours + "h " +
                minutes + "m " + seconds + "s ";
        }


        // If the count down is finished, write some text
        if (distance < 0) {
            clearInterval(x);

            var xx = document.getElementsByClassName(time);
            var i;
            for (i = 0; i < xx.length; i++) {
                document.getElementsByClassName(time)[i].style.display = 'none';
                document.getElementsByClassName(show)[i].style.display = "block";
            }
        }

    }, 1000);

}