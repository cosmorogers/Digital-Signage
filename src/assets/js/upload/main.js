/*
 * jQuery File Upload Plugin JS Example 7.1
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */

/*jslint nomen: true, unparam: true, regexp: true */
/*global $, window, document */

$(function () {
	'use strict';
	
	$('#slideshows-multiselect').multiselect();

    // Initialize the jQuery File Upload widget:
    $('#fileupload').fileupload({
        // Uncomment the following to send cross-domain cookies:
        //xhrFields: {withCredentials: true},
        url: ''
    });

    // Enable iframe cross-domain access via redirect option:
    $('#fileupload').fileupload(
        'option',
        'redirect',
        window.location.href.replace(
            /\/[^\/]*$/,
            '/cors/result.html?%s'
        )
    );

    // Load existing files:
    //$('#fileupload').addClass('fileupload-processing');
    $.ajax({
        // Uncomment the following to send cross-domain cookies:
        //xhrFields: {withCredentials: true},
        url: $('#fileupload').fileupload('option', 'url'),
        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
        dataType: 'json',
        context: $('#fileupload')[0]
    }).done(function (result) {
        $(this)
            .removeClass('fileupload-processing')
            .fileupload('option', 'done')
            .call(this, null, {result: result});
    });

});
