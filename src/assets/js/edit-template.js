$(function () {
    $(".layout-container").sortable({
        update: function (ev, ui) {
            var content = $(ui.item).children('.popover-content.widget-desc');
            if (content.length === 1) {
                content.removeClass('widget-desc');
                $(ui.item).children('h4').append('<i class="icon-chevron-up pull-right panel-collapse"></i>');
                content.html('<form autocomplete="off"><fieldset>' + forms[content.data('widget')] + '</fieldset></form>');
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
        data = {
            'widget': {
                'id' : $(this).data('id'),
                'name': $(this).parents('.popover-content').data('widget'),
                'container': $(this).parents('.layout-container').data('template-container'),
                'settings': $(this).serializeObject()
            }
        };
        data[token.name] = token.value;
        var that = $(this);
        $.post(widgetUrl + '/saveWidget/' + templateId, data, function (data) {
            console.log(data);
            if (data.success) {
                that.parents('.popover-content').removeClass('widget-unsaved');
                if (!that.data('id')) {
                    that.data('id', data.id);
                }
            }

        }, 'json')
    });

    $('body').on('click', '.remove-widget', function(e) {
        e.preventDefault();
        parent = $($(this).parents('.popover-content')[0]);
        data = {
            id : parent.data('id')
        }
        data[token.name] = token.value;
        that = $(this);
        $.post(widgetUrl + '/removeWidget', data, function() {
            parent.parent('.panel').remove();
        });
    });

    $('body').on('change', '.layout-container form', function(e) {
        $(this).parent('.popover-content').addClass('widget-unsaved');
    });

    $('#changeNameBtn').on('click', function(e) {
        e.preventDefault();
        $('#templateName').addClass('hide');
        $('#changeTemplateName').removeClass('hide');
    });

    $('#changeNameSaveBtn').on('click', function(e) {
        e.preventDefault();
        var name = $('#templateNameInput').val();
        var data = {'name' : name};
        data[token.name] = token.value;

        $.post(widgetUrl + '/changeName/' + templateId, data, function(resp) {
            $('#templateName > span').text(name);
            $('#changeTemplateName').addClass('hide');
            $('#templateName').removeClass('hide');
        })

    });


});