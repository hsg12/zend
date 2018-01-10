$(function () {

    /* For button to up */
    $(window).scroll(function () {
        if ($(this).scrollTop() > 500) {
            $('#back-to-top').fadeIn();
        } else {
            $('#back-to-top').fadeOut();
        }
    });

    // scroll body to 0px on click
    $('#back-to-top').click(function () {
        $('body,html').animate({
            scrollTop: 0
        }, 500);
        return false;
    });

    ///   For tutorial ajax form   ////////////////////////

    if ($(document).width() < 576) {
        $('#ajax_form > div').removeClass('row');
    }

    var ajaxManage = function () {
        var ajaxForm = $('#ajax_form').serialize();

        $.ajax({
            url: '/tutorial/ajax/manage',
            type: 'post',
            dataType: 'json',
            data: ajaxForm,
            success: function (data) {
                $('#result').text(data);
            }
        });

        return false;
    }

    $('#ajax_form').on('submit', ajaxManage);
});

