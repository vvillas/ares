function closeObj(obj)
{
	$(obj).fadeOut('fast');
}

function showErrorMsg(errorMsg)
{
	$('#overBox').fadeIn('fast');
	$('#messageHolder').append(errorMsg);
	$('#bt_close_modal').focus();
}

function clearErrorMsg(){
	$('#overBox').fadeOut('fast', function(){
		$('#messageHolder').empty();
	});
}

$(document).ready(function () {
	if($('#errorMsg').html())
	{
		$('#errorMsg').hide();
		$('#overBox').fadeIn('fast');
		$('#messageHolder').append($('#errorMsg').html());
	}
});