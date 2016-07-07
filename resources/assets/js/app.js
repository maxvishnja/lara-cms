/**
 * Restfulize any hiperlink that contains a data-method attribute by
 * creating a mini form with the specified method and adding a trigger
 * within the link.
 * Requires jQuery!
 *
 * Ex:
 * <a href="post/1" data-method="delete">destroy</a>
 * // Will trigger the route Route::delete('post/(:id)')
 *
 *
 * Update:
 *  - This method will now ignore elements that have a '.disabled' class
 *  - Adding the '.action_confirm' class will trigger an optional confirm dialog.
 *  - Adding the Session::token to 'data-token' will add a hidden input for needed for CSRF.
 *
 */
function restfulize() {
    $('[data-method]').not(".disabled").append(function () {
            var methodForm = "\n"
            methodForm += "<form action='" + $(this).attr('href') + "' method='POST' style='display:none'>\n"
            methodForm += " <input type='hidden' name='_method' value='" + $(this).attr('data-method') + "'>\n"
            if ($(this).attr('data-token')) {
                methodForm += "<input type='hidden' name='_token' value='" + $(this).attr('data-token') + "'>\n"
            }
            methodForm += "</form>\n"
            return methodForm
        })
        .removeAttr('href')
        .find("form").submit()


}


$(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    // Template scripts

    function initToolbarBootstrapBindings() {
        var fonts = ['Serif', 'Sans', 'Arial', 'Arial Black', 'Courier',
                'Courier New', 'Comic Sans MS', 'Helvetica', 'Impact', 'Lucida Grande', 'Lucida Sans', 'Tahoma', 'Times',
                'Times New Roman', 'Verdana'
            ],
            fontTarget = $('[title=Font]').siblings('.dropdown-menu');
        $.each(fonts, function (idx, fontName) {
            fontTarget.append($('<li><a data-edit="fontName ' + fontName + '" style="font-family:\'' + fontName + '\'">' + fontName + '</a></li>'));
        });
        $('a[title]').tooltip({
            container: 'body'
        });
        $('.dropdown-menu input').click(function () {
                return false;
            })
            .change(function () {
                $(this).parent('.dropdown-menu').siblings('.dropdown-toggle').dropdown('toggle');
            })
            .keydown('esc', function () {
                this.value = '';
                $(this).change();
            });

        $('[data-role=magic-overlay]').each(function () {
            var overlay = $(this),
                target = $(overlay.data('target'));
            overlay.css('opacity', 0).css('position', 'absolute').offset(target.offset()).width(target.outerWidth()).height(target.outerHeight());
        });

        if ("onwebkitspeechchange" in document.createElement("input")) {
            var editorOffset = $('#editor').offset();

            $('.voiceBtn').css('position', 'absolute').offset({
                top: editorOffset.top,
                left: editorOffset.left + $('#editor').innerWidth() - 35
            });
        } else {
            $('.voiceBtn').hide();
        }
    }

    function showErrorAlert(reason, detail) {
        var msg = '';
        if (reason === 'unsupported-file-type') {
            msg = "Unsupported format " + detail;
        } else {
            console.log("error uploading file", reason, detail);
        }
        $('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>' +
            '<strong>File upload error</strong> ' + msg + ' </div>').prependTo('#alerts');
    }

    initToolbarBootstrapBindings();

    $('#editor').wysiwyg({
        fileUploadError: showErrorAlert
    });

    prettyPrint();

    $('#compose, .compose-close').click(function () {
        $('.compose').slideToggle();
    });

    // Menu slide

    $SIDEBAR_MENU.find('a[href="' + CURRENT_URL + '"]').parent('li').addClass('current-page');
    $SIDEBAR_MENU.find('a').filter(function () {

        var currentLink = this.href;
        var current = CURRENT_URL.indexOf(currentLink);

        if (currentLink !== '' && current === 0) {
            return this.href;
        }

    }).parent('li').addClass('current-page').parents('ul').slideDown().parent().addClass('active');

    // Checkbox iCheck

    if ($(".checkbox input")[0]) {
        $('.checkbox input').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass: 'iradio_flat-green'
        });
    }

    // Datepicker

    $('.datepicker').daterangepicker({
        singleDatePicker: true,
        calender_style: "picker_4",
        showDropdowns: true,
        locale: {
            format: "YYYY-MM-DD",
            separator: " - ",
            applyLabel: "Apply",
            cancelLabel: "Cancel",
            fromLabel: "From",
            toLabel: "To",
            customRangeLabel: "Custom",
            daysOfWeek: ["Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"],
            monthNames: [
                "Январь",
                "Февраль",
                "Март",
                "Апрель",
                "Май",
                "Июнь",
                "Июль",
                "Август",
                "Сентябрь",
                "Октябрь",
                "Ноябрь",
                "Декабрь"
            ],
            firstDay: 1
        }
    });




});