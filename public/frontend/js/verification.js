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
        var password = $('#password').val();
        $('#error').html('');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url:uploadOtpSenderUrl,
            data : {email :email,event_p_id :event_p_id,event_id :event_id,resend_flag:resend_flag,password: password},
            dataType: 'json',
            success: function (response) {
                if(response.success == false && response.message){
                    $('#success').html('');
                    $('#error').fadeIn();
                    $('#error').html('<div class="alert alert-danger">'+response.message+'</div>');
                    $('#error').fadeOut(5000);

                }else if (response.success == false && response.wrong_otp){
                    $('#success').html('');
                    $('#error').fadeIn();
                    $('#error').html('<div class="alert alert-danger">'+response.wrong_otp+'</div>');
                    $('#error').fadeOut(5000);
                }
                else{
                    $('#success').html('');
                    $('#success').fadeIn();
                    $('#success').append('<div class="alert alert-success">'+response.message+'</div>');
                    $('#success').fadeOut(5000);
                    $('#otp-form').show();
                    $('#contact-form').hide();
                }

            },
            error: function (xhr) {
                $('#error').html('');
                $.each(xhr.responseJSON.errors, function(key,value) {
                    $('#error').fadeIn();
                    $('#error').append('<div class="alert alert-danger">'+value+'</div>');
                    $('#error').fadeOut(5000);
                    exit;
                });
            }
        });
    });

    $('#otp_submit').click(function() {
        alert(uploadform);
        $('#error').val('');
        var otp = $('#otp').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url:otpverficationUrl,
            data : {otp:otp,event_id :event_id},
            dataType: 'json',
            success: function (response) {

                console.log(response);
                if(response.success == true){
                    $('#otp,#email').val('');
                    $('#success').html('');
                    $('#error').html('');
                    $('#otp-form').hide();
                    $('#contact-form').show();
                    location.href = uploadform+"/"+event_id+"/"+response.event_p_id;
                }else{
                    $('#success').html('');
                    $('#error').fadeIn();
                    $('#error').html('<div class="alert alert-danger">'+response.wrong_otp+'</div>');
                    $('#error').fadeOut(5000);
                }
            },
            error:
                function (xhr) {
                    $.each(xhr.responseJSON.errors, function(key,value) {
                        $('#error').fadeIn();
                        $('#error').append('<div class="alert alert-danger">'+value+'</div>');
                        $('#error').fadeOut(5000);
                    });

                }

        });
    });
    $('#otp_resend').click(function() {

        var resend_flag = 1;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: uploadOtpSenderUrl,
            data: {resend_flag: resend_flag, event_p_id: event_p_id, event_id: event_id},
            dataType: 'json',
            success: function (response) {
                $('#otp').val('');
                if(response.success == true && response.message){
                    $('#success').html('');
                    $('#success').fadeIn();
                    $('#success').html('<div class="alert alert-success">'+response.message+'</div>');
                    $('#success').fadeOut(5000);

                }
                $('#error').html('');
                $('#otp-form').show();
                $('#contact-form').hide();
                $('#otp_resend').hide();
                if(response.success == false && response.message){
                    $('#success').html('');
                    $('#error').fadeIn();
                    $('#error').html('<div class="alert alert-danger">'+response.message+'</div>');
                    $('#error').fadeOut(5000);
                }

            },
            error: function (xhr) {
                $.each(xhr.responseJSON.errors, function(key,value) {
                    $('#error').fadeIn();
                    $('#error').html('<div class="alert alert-danger">'+value+'</div>');
                    $('#error').fadeOut(5000);
                });

            }

        });
    });
});

