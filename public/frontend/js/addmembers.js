$(document).ready(function() {
    $('#add_members').hide();
    $('#member-list').hide();

    jsonObj = [];
    //Add Memebrs
    $('#add_members').click(function() {
        var allmembers = $('#allmembers').val();

        var memberName = $('#member_name').val();
        var memberEmail = $('#member_email').val();
        var memberMobile = $('#member_mobile').val();
        var eventId = $('#event_id').val();

        memberNameValidate();
        memberEmailValidate();
        memberMobileValidate();

        function memberNameValidate()
        {
            var name = /^[A-Za-z ]+$/;
            if (memberName == "" ){
                $("#member_name_error").html("Please Enter Member Name.");
                $("#member_name_error").addClass("alert alert-danger");
                return false;
            }
            else if ( !memberName.match(name) ){
                $("#member_name_error").html("Name should have characters.");
                $("#member_name_error").addClass("alert alert-danger");
                return false;
            }
            else{
                $("#member_name_error").html("");
                $("#member_name_error").removeClass("alert alert-danger");
                return true;
            }
        }

        function memberEmailValidate() {

            var email = /^([a-zA-Z\d\-\.]+)@([a-zA-Z]{2,11})\.([a-zA-Z]{2,4})$/;
                if(allmembers){
                    var members = jQuery.parseJSON(allmembers);
                    for (var i=0 ; i < members.length ; i++)
                    {
                        if (members[i].member_email == memberEmail) {
                            var available = true;
                        }
                    }
                }else{
                    var available = false;
                }

            if (memberEmail == "" ){
                $("#member_email_error").html("Please Enter Email id.");
                $("#member_email_error").addClass("alert alert-danger");
                return false;
            }
            else if (!memberEmail.match(email)){
                $("#member_email_error").html("Please Enter valid email id.");
                $("#member_email_error").addClass("alert alert-danger");
                return false;
            }else if (available == true){
                $("#member_email_error").html("Email already exist.");
                $("#member_email_error").addClass("alert alert-danger");
                return false;
            }
            else{
                $("#member_email_error").html("");
                $("#member_email_error").removeClass("alert alert-danger");
                return true;
            }
        }

        function  memberMobileValidate() {
            var number = /^[7-9]{1}[0-9]{9}$/;

            if (memberMobile == "" ){
                $("#member_mobile_error").html("Please Enter Phone number.");
                $("#member_mobile_error").addClass("alert alert-danger");
                return false;
            }
            else if (!memberMobile.match(number)){
                $("#member_mobile_error").html("Please Enter 10 digits number.");
                $("#member_mobile_error").addClass("alert alert-danger");
                return false;
            }
            else{
                $("#member_mobile_error").html("");
                $("#member_mobile_error").removeClass("alert alert-danger");
                return true;
            }
        }


        var member_name_validate = memberNameValidate();
        var member_email_validate = memberEmailValidate();
        var member_mobile_vaidate = memberMobileValidate();

        if(member_name_validate && member_email_validate && member_mobile_vaidate){
            //controller call to validate email existence

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: '/register/checkemail',
                data: {memberEmail: memberEmail,eventId: eventId},
                dataType: 'json',
                success: function (response) {
                    if(response.success == true){
                        createJSON();
                        $('.member').children().val('');
                        $('.member').val('');
                        $("#error").html("");
                        $('#success').val('');
                        $('#success').fadeIn();
                        $('#success').html('<div class="alert alert-success">'+response.message+'</div>');
                        $('#success').fadeOut(6000);

                        if(jsonObj.length != 0){
                            $('#member-list').show();
                        }
                        $('#member-data').append('<tr class="inner-box text-center">' +
                            '<td>'+memberName+'</td>' +
                            '<td>'+memberEmail+'</td>' +
                            '<td>'+memberMobile+'</td>' +
                            '<td class="btnX"><input id="'+memberEmail+'" class="removebtn" type="button" name="x" value="x"></td>'+
                            '</tr>');
                        addmemberstoinput();

                    }
                    else{
                        $('#success').html('');
                        $('#member_email_error').html(response.message);
                        $("#member_email_error").addClass("alert alert-danger");

                    }
                }

            });
        }

        function createJSON() {
            item = {}
            item ["member_name"] = memberName;
            item ["member_email"] = memberEmail;
            item ["member_mobile"] = memberMobile;
            jsonObj.push(item);
        }
    });

    //Remove Members
    $('#member-data').on('click','.btnX',function () {
        var email = $(this).children().attr('id');
        for (var i=0 ; i < jsonObj.length ; i++)
        {
            if (jsonObj[i].member_email == email) {
                jsonObj.splice(i,1);
            }
        }

        $(this).closest("tr").remove();
        addmemberstoinput();
        if(jsonObj.length === 0){
            $('#member-list').hide();
        }
    });

    function addmemberstoinput(){
        $('#allmembers').val(JSON.stringify(jsonObj));
    }

    $('.member').click(function() {
        $('#add_members').show();
    });
});

