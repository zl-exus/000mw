// Avoid `console` errors in browsers that lack a console.
(function () {
    var method;
    var noop = function () {};
    var methods = [
        'assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error',
        'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log',
        'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd',
        'timeline', 'timelineEnd', 'timeStamp', 'trace', 'warn'
    ];
    var length = methods.length;
    var console = (window.console = window.console || {});

    while (length--) {
        method = methods[length];

        // Only stub undefined methods.
        if (!console[method]) {
            console[method] = noop;
        }
    }
}());

$('#message').submit(function () {
    var user_id = $('#urid').html()
    var hid_input_id = $('#user-id');
    hid_input_id.attr('value', user_id);
});

$('#comment').submit(function () {
    var parent_mess_id = $('#comment').closest('.post').attr('data-id')
    var hid_input_id = $('#parent-mes-id');
    hid_input_id.attr('value', parent_mess_id);
});

$(document).ready(function () {
    setTimeout(function () {
        $('.info-block').fadeOut(1000);
    }, 10000);
});

$(document).ready(function () {
    var $form = $('#comment');
    $form.hide();
    var flag = true;
    $('.comment a, .answ-block a').click(function (e) {
        e.preventDefault();
        $form.hide();
        $('.comment a, .answ-block a').text('Комментировать');
        if (!$(this).hasClass('active')) {
            $(this).text('Отменить').addClass('active');
            var $comment = $(this).parent();
            $comment.append($('#comment').fadeIn("fast"));
//            $form.find('#hidden').val($comment.attr('id')); 
//            $comment.append($('#comment').show("slow"));
        } else {
            $('.comment a, .answ-block a').removeClass('active');
        }
    });
});
