$(function () {
    $(".layout-container").sortable({
        update: function (ev, ui) {
            var content = $(ui.item).children('.popover-content.widget-desc');
            if (content.length === 1) {
                content.removeClass('widget-desc');
                $(ui.item).children('h4').append('<i class="icon-chevron-up pull-right panel-collapse"></i>');
                content.html(forms[content.data('widget')]);
                content.find('fieldset').append('<div><button class="btn btn-primary" type="submit">Save</button><button class="btn btn-danger pull-right" type="submit"><i class="icon-trash icon-white"></i></button></div>');
                content.addClass('widget-unsaved');
            }
        },
        containment: "parent"
    });
    $("#availableWidgets .panel").draggable({
        connectToSortable: ".layout-container",
        helper: "clone",
        revert: "invalid",
        start: function (e, ui) {
            $(ui.helper).width($('#availableWidgets .panel').width() + 'px');
            $(ui.helper).children('.popover-content').remove();
        },
        zIndex: 10000,
        appendTo: "body",
        handle: "h4"
    });

    $("ul, li").disableSelection();

    $('body').on('click', '.panel-collapse', function () {
        $(this).parent().parent().children('.popover-content').slideUp();
        $(this).removeClass('panel-collapse').addClass('panel-expand');
        $(this).removeClass('icon-chevron-up').addClass('icon-chevron-down');
    });

    $('body').on('click', '.panel-expand', function () {
        $(this).parents('.panel').children('.popover-content').slideDown();
        $(this).removeClass('panel-expand').addClass('panel-collapse');
        $(this).removeClass('icon-chevron-down').addClass('icon-chevron-up');
    });

    $('body').on('submit', '.layout-container form', function(e) {
        e.preventDefault();
        $.post()
    });


});