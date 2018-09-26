$(document).ready(function() {
    var event_p_id = $('#event_praticipants_id').val();
    var event_id = $('#event_id').val();
    var otp_sent = $('#otp_div').val();


    if(otp_sent){
        $('#contact-form').hide();
        $('#otp-form').show();
    }
    $('#email_submit').click(function() {
        var resend_flag = '0';
        var email = $('#email').val();

        $('#error').html('');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url:otpSenderUrl,
            data : {email :email,event_p_id :event_p_id,event_id :event_id,resend_flag:resend_flag},
            dataType: 'json',
            success: function (response) {

                if(response.success == false && response.voted){
                    $('#success').html('');
                    $('#error').fadeIn();
                    $('#error').html('<div class="alert alert-danger">'+response.voted+'</div>');
                    $('#error').fadeOut(3000);

                }
                else if(response.success == false && response.message){
                    $('#success').html('');
                    $('#error').fadeIn();
                    $('#error').html('<div class="alert alert-danger">'+response.message+'</div>');
                    $('#error').fadeOut(3000);

                }
                else{
                    $('#success').html('');
                    $('#success').fadeIn();
                    $('#success').append('<div class="alert alert-success">'+response.message+'</div>');
                    $('#success').fadeOut(3000);
                    $('#otp-form').show();
                    $('#contact-form').hide();
                }

            },
            error: function (xhr) {
                $('#error').html('');
                $.each(xhr.responseJSON.errors, function(key,value) {
                    $('#error').fadeIn();
                    $('#error').append('<div class="alert alert-danger">'+value+'</div>');
                    $('#error').fadeOut(3000);

                });
            },
        });
    })

        $('#otp_submit').click(function() {
            $('#error').val('');
            var otp = $('#otp').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url:voteUrl,
                data : {otp:otp,event_p_id :event_p_id,event_id :event_id},
                dataType: 'json',
                success: function (response) {
                    $('#otp,#email').val('');
                    $('#success').html('');
                    $('#success').fadeIn();
                    $('#success').append('<div class="alert alert-success">'+response.message+'</div>');
                    $('#success').fadeOut(3000);
                    $('#error').html('');
                    $('#otp-form').hide();
                    $('#contact-form').show();
                    location.href = "/participants/"+event_id;

                },
                error:
                    function (xhr) {
                        $.each(xhr.responseJSON.errors, function(key,value) {
                            $('#error').fadeIn();
                            $('#error').append('<div class="alert alert-danger">'+value+'</div>');
                            $('#error').fadeOut(3000);

                        });

                    }

            });
        });
    $('#otp_resend').click(function() {

        var resend_flag = 1;
        alert(resend_flag)
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: otpSenderUrl,
            data: {resend_flag: resend_flag, event_p_id: event_p_id, event_id: event_id},
            dataType: 'json',
            success: function (response) {
                $('#otp').val('');
                if(response.success == true && response.message){
                    $('#success').html('');
                    $('#success').fadeIn();
                    $('#success').html('<div class="alert alert-success">'+response.message+'</div>');
                    $('#success').fadeOut(3000);

                }
                $('#error').html('');
                $('#otp-form').show();
                $('#contact-form').hide();
                $('#otp_resend').hide();
                if(response.success == false && response.message){
                    $('#success').html('');
                    $('#error').fadeIn();
                    $('#error').html('<div class="alert alert-danger">'+response.message+'</div>');
                    $('#error').fadeOut(3000);

                }

            },
            error: function (xhr) {
                alert('resend error');
                $.each(xhr.responseJSON.errors, function(key,value) {
                    $('#error').fadeIn();
                    $('#error').append('<div class="alert alert-danger">'+value+'</div>');
                    $('#error').fadeOut(3000);

                });

            }

        });
    });
});

