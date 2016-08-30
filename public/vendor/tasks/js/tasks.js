$(function() {

    var modules = {
        /**
         * Ajax Request
         *
         * @param The current element
         * @param Callback
         * @param dataType
         * @param data
         **/
        'queryAjax' : function($elem, callback,dataType, data) {
            $.ajax({
                type: $elem.data('method') ? $elem.data('method') : $elem.attr('method'),
                url: $elem.data('action') ? $elem.data('action') : $elem.attr('action'),
                data: data ? data : $elem.serialize(),
                dataType: dataType ? dataType : 'html',
                success: function(data) {
                    if(typeof callback === 'function') {
                        callback(data);
                    } else {
                        location.reload();
                    }
                }
            });
        }
    };

    $(document).on('click', '.task-start', function(e) {
        e.preventDefault();

        modules.queryAjax($(this), function (data) {
            $('.task-start').addClass('hide');
            $('.task-pause').removeClass('hide');
        });
    });

    $(document).on('click', '.task-pause', function(e) {
        e.preventDefault();

        modules.queryAjax($(this), function (data) {
            $('.task-pause').addClass('hide');
            $('.task-start').removeClass('hide');
        });
    });

    $(document).on('click', '.task-end', function(e) {
        e.preventDefault();

        modules.queryAjax($(this), function (data) {
            console.log(data)
        });
    });


});