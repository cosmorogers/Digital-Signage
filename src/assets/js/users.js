$(function() {
	$('#inputLdap').change(function() {
		if ($('#inputLdap').is(':checked') ) {
			$('.password-control-group').hide();
		} else {
			$('.password-control-group').show();
		}
	});
});