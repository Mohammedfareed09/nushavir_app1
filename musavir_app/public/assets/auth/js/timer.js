function startCountdown(duration, display) {
    var timer = duration, minutes, seconds;
    var countdownInterval = setInterval(function () {
        minutes = parseInt(timer / 60, 10);
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.textContent = minutes + ":" + seconds;

        if (--timer < 0) {
            clearInterval(countdownInterval);
            display.style.display = 'none';
            document.querySelector('.resend-btn').style.display = 'block'; // Show the resend button
        }
    }, 1000);
}

function resendOtp() {
    // Logic to resend OTP (could be an AJAX call or form submission)
    alert('OTP has been resent.');
    location.reload(); // Reload the page to restart the timer
}

window.onload = function () {
    var countdownElement = document.getElementById("countdown");
    var twoMinutes = 60 * 2; // 2 minutes in seconds
    startCountdown(twoMinutes, countdownElement);
};
