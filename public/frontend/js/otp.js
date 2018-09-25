$(document).ready(function() {

    var otp_sent = $('#otp_div').val();
    if(otp_sent){
        $('#contact-form').hide();
        $('#otp-form').show();
    }
    $('#email_submit').click(function() {
        var email = $('#email').val();
        var event_p_id = $('#event_praticipants_id').val();
        var event_id = $('#event_id').val();



        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url:otpSenderUrl,
            data : {email :email,event_p_id :event_p_id,event_id :event_id},
            dataType: 'json',
            success: function (response) {
                $('#success').html('');
                $('#success').append('<div class="alert alert-success">'+response.message+'</div>');
                $('#otp-form').show();
                $('#contact-form').hide();

            },
            error: function (xhr) {
                $('#error').html('');
                $.each(xhr.responseJSON.errors, function(key,value) {
                    $('#error').append('<div class="alert alert-danger">'+value+'</div>');
                });
            },
        });
    })

        $('#otp_submit').click(function() {

            var otp = $('#otp').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url:voteUrl,
                data : {otp:otp},
                dataType: 'json',
                success: function (response) {
                    $('#success').html('');
                    $('#success').append('<div class="alert alert-success">'+response.message+'</div>');
                    $('#otp-form').hide();
                    $('#contact-form').show();

                },
                error: function (xhr,response) {
                    $('#error').html('');
                    $('#error').append('<div class="alert alert-danger">'+response.error+'</div>');
                    $('#error').html('');
                    $.each(xhr.responseJSON.errors, function(key,value) {
                        $('#error').append('<div class="alert alert-danger">'+value+'</div>');
                    });
                }
            });
        });


});