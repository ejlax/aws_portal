$(document).ready(function() {
	var href = $('.menu_top:second').attr('href');
	$('#mainForm').load($('.menu_top:second').attr(href));
});
$('.menu_top').click(function(){
		alert('Welcome to Pearson AWS Portal');
	var href = $(this).attr('href');
	$('#mainForm') .hide().load(href) .fadeIn('normal');
	return false;
});
