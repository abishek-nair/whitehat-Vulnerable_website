// Developed By : Abishek | Nair
// Copyright    : White | Hat tm
baseUrl = 'localhost/decryption/';
$(document).ready(function() {
	$('#form1').on('submit', 
		function(event) {
			loadPage();
			event.preventDefault();
			return false;
		});
});

function loadPage() {
	inpPass = document.getElementById('pass');
	try {
		document.location.href=inpPass.value + '.php';
	}
	catch(e) {
	}
}
