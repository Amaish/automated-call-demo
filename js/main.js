function countDownTimer() {
    // Set the date we're counting down from
    var dateDue = JSON.parse(document.getElementById("dateDue").value);
    var counterId = JSON.parse(document.getElementById("counterId").value);
    counterId.forEach(counterFunc);
    function counterFunc(counter) {
        var nameID ="name" + counter;
        var phoneID ="phone" + counter;
        var balanceID ="balance" + counter;
        var name = document.getElementById(nameID).value;
        var phone = document.getElementById(phoneID).value;
        var balance = document.getElementById(balanceID).value;
        //alert("Name is " + name + " phone number is "+ phone + " your balance " + balance);
        var countDownDate = new Date(dateDue[counter]).getTime();
        // Update the count down every 1 second
        var x = setInterval(function() {
        // Get today's date and time
        var now = new Date().getTime();
        // Find the time between now and the count down date
        var Time = now - countDownDate;            
        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(Time / (1000 * 60 * 60 * 24));
        var hours = Math.floor((Time % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((Time % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((Time % (1000 * 60)) / 1000);            
        // Output the result in an element with id="counter"
        document.getElementById(counter).innerHTML = days + "d " + hours + "h "
        + minutes + "m " + seconds + "s ";           
        // If the count down is over, write some text
        if (days >= 2) {
            clearInterval(x);
            var msg = "Overdue by " + days + "d " + hours + "h "
            + minutes + "m " + seconds + "s";
            var result = msg.fontcolor("red");
            var calluser = "Hi " + name + " your number is " + phone + " your balance is " + balance;
            var colouredcalluser = calluser.fontcolor("red");
            document.getElementById(counter).innerHTML = result;
            var list = document.createElement("li");
            list.innerHTML = colouredcalluser;
            document.getElementById("makeCall").appendChild(list);
        }
        }, 1000);
    }
}