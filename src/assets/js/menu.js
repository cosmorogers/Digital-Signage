$(document).ready(function(){

	$('.datepicker').datepicker({
		'dateFormat' : 'yy-mm-dd'
	});

	$('form.table-filter select').change(function() {
		$(this).parents('form').submit();
	});

	$('.tooltip-me').tooltip();
	
	$('.submenu > a').click(function(e) {
		e.preventDefault();
		var submenu = $(this).siblings('ul');
		var li = $(this).parents('li');
		var submenus = $('#sidebar li.submenu ul');
		var submenus_parents = $('#sidebar li.submenu');
		if(li.hasClass('open')) 		{
			submenu.slideUp();
			li.removeClass('open');
		} else {
			submenus.slideUp();			
			submenu.slideDown();
			submenus_parents.removeClass('open');		
			li.addClass('open');	
		}
	});

});