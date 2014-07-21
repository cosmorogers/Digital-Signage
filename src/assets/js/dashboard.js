$(function() {
	$('.dashboard-screen').each(function() {
		var url = $(this).data('url');
		var ele = $(this);
		$.get(url, function(data) {
			var text = ele.find('.screen-status'),
			img = ele.find('img'),
			base = img.data('base');

			if (data.alive) {
				text.removeClass('muted').addClass('text-success');
				text.text('Online');
				img.prop('src', base + '/online.jpg');
			} else {
				text.removeClass('muted').addClass('text-error');
				text.text('Offline');
				img.prop('src', base + '/offline.jpg');
			}
		},'json');
	});

	$('.boot-btn').click(function() {
		$.get($(this).data('url'), function(data) {
			var mess = $('<div>');
			mess.addClass('alert');
			if (data.boot) {
				mess.html('Magic Packet sent, if the computer has WOL enabled it should now be booting').addClass('alert-success');
			} else {
				mess.html('Magic Packet failed to send, perhaps the screen has an invalid MAC address, or your server can\'t send magic packets').addClass('alert-error');
			}
			mess.appendTo($('#dashboardMessages')).delay(2000).fadeOut();
		}, 'json');
	});
});
