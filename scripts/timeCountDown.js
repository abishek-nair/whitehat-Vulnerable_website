// Developed By : Abishek | Nair
// Copyright    : White | Hat tm
$(document).ready(function() {
	timeVal = $("#timeVal");
	regTimeServ();
	countdownTimer = setInterval('secondPassed()', 1000);
	timer = setInterval('regTimeServ()', 2000);
});
seconds = 0;
function secondPassed() {
	seconds++;
	try {
    	minutes = Math.round((seconds - 30)/60);
    }
    catch(e) {
    }
    remainingSeconds = seconds % 60;
    if (remainingSeconds < 10) {
        remainingSeconds = "0" + remainingSeconds;  
    }
    timeVal.html(minutes + " : " + remainingSeconds + "&nbsp;");
}

function regTimeServ() {

	$.get('scripts/timer.php', 
			function(data) {
				timeSec = $.parseJSON(data);
				seconds = timeSec.SECOND;
			}
		);

}
