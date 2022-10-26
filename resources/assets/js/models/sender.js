$('#code_form').submit(function(e) {//Change
    e.preventDefault();
    var th = $(this);
    $.ajax({
        type: "POST",
        url: "/check-code", //Change
        data: th.serialize(),
        success: function(data) {
            let response = $.parseJSON(data);
            if(response.res == 'ok') {
                $.cookie('guard', response.val, { expires: 1, path: '/' });
                location.reload();
            } else {
                $('.code_guard_error').remove();
                $("input[name='code']").after('<p class="code_guard_error" style="color: red">Не верный код, убедитесь что верно вводите</p>');
            }

            setTimeout(function() {
                // Done Functions
                th.trigger("reset");
            }, 1000);
        }
    })

    return false;
});


$(document).ready(function() {


    $(".gallery_click").on('click', function (e) {
        e.preventDefault();

        let getfile = $(this).attr('data-getfile');
        let token = $('meta[name="csrf-token"]').attr('content');


        $.ajax({
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': token
            },
            url: '/get-gallery',
            data: {
                "_token": token,  //pass the CSRF_TOKEN()
                "getFile": getfile
            },
            dataType: 'json',
            success: function (data) {

                    $.fancybox.open(data,  {
                        buttons: [
                            "fullScreen",
                            "thumbs",
                            "close"
                        ],
                        arrows: true,
                        infobar: true,
                        smallBtn: "auto",
                        toolbar: "auto",
                        loop: true
                    });


            },

        });
    });


    $(".click_map").on('click', function (e) {
        e.preventDefault();

        $('.click_map').removeClass('active');
        $(this).addClass('active');

        var getfile = $(this).attr('data-map');
        var token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': token
            },
            url: '/get-map',
            data: {
                "_token": token,
                "getMap": getfile
            },
            dataType: 'json',
            success: function (res) {
                $('#sirskiy').html(res);
            },
        });
    });



})
