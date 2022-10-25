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
