$(document).ready(function() {

    $('#registration_submit').click(function() {

        $('.member').children().val('');
        // alert('asdasd');
        var teamName = $("#team_name").val();
        var title = $("#title").val();
        var description = $("#description").val();
        var contactPerson = $("#contact_person").val();
        var leaderEmail = $("#email").val();
        var mobile = $("#mobile").val();
        var event_id = $('#event_id').val();
        var allmembers = $('#allmembers').val();

        var teamname_validate = teamNameValidate();
        var title_validate = titleValidate();
        var description_validate = descriptionValidate();
        var contactperson_validate = contactPersonValidate();
        var mobile_validate = mobileValidate();
        var email_validate = emailValidate();


        // var members = jQuery.parseJSON(allmembers);
        // alert(members.length);
        //
        // $("#team_name").blur(function () {
        //     teamNameValidate();
        // });

        function teamNameValidate()
        {
            var name = /^[A-Za-z0-1 ]+$/;

            if (teamName == "" ){
                $("#team_name_error").html("Please Enter Team Name.");
                $("#team_name_error").addClass("alert alert-danger");
                return false;
            }
            else if ( !teamName.match(name) ){
                $("#team_name_error").html("Team name should not have special characters.");
                $("#team_name_error").addClass("alert alert-danger");
                return false;
            }
            else{
                $("#team_name_error").html("");
                $("#team_name_error").removeClass("alert alert-danger");
                return true;
            }
        }

        function titleValidate() {
            var name = /^[A-Za-z]+$/;

            if (title == "" ){
                $("#title_error").html("Please Enter title.");
                $("#title_error").addClass("alert alert-danger");
                return false;
            }
            else if ( !title.match(name) ){
                $("#title_error").html("Title should have characters.");
                $("#title_error").addClass("alert alert-danger");
                return false;
            }
            else{
                $("#title_error").html("");
                $("#title_error").removeClass("alert alert-danger");

                return true;
            }
        }

        function  descriptionValidate()
        {
            if (description == "" ){
                $("#description_error").html("Please Enter Description.");
                $("#description_error").addClass("alert alert-danger");
                return false;
            }
            else{
                $("#description_error").html("");
                $("#description_error").removeClass("alert alert-danger");
                return true;
            }
        }

        function contactPersonValidate()
        {
            var name = /^[A-Za-z ]+$/;

            if (contactPerson == "" ){
                $("#contact_person_name_error").html("Please enter contact person name.");
                $("#contact_person_name_error").addClass("alert alert-danger");
                return false;
            }
            else if ( !contactPerson.match(name) ){
                $("#contact_person_name_error").html("Contact person name should have characters.");
                $("#contact_person_name_error").addClass("alert alert-danger");
                return false;
            }
            else{
                $("#contact_person_name_error").html("");
                $("#contact_person_name_error").removeClass("alert alert-danger");

                return true;
            }
        }


        function emailValidate() {
            if(allmembers){
                var members = jQuery.parseJSON(allmembers);
                for (var i=0 ; i < members.length ; i++)
                {
                    if (members[i].member_email == leaderEmail) {
                        var available = true;
                    }
                }
            }else{
                        var available = false;
            }

            var email = /^([a-zA-Z\d\-\.]+)@([a-zA-Z]{2,11})\.([a-zA-Z]{2,4})$/;

            if (leaderEmail == "" ){
                $("#leader_email_error").html("Please Enter Email id.");
                $("#leader_email_error").addClass("alert alert-danger");
                return false;
            }
            else if (!leaderEmail.match(email)){
                $("#leader_email_error").html("Please Enter valid email id.");
                $("#leader_email_error").addClass("alert alert-danger");
                return false;
            }
            else if (available == true){
                $("#leader_email_error").html("Email already entered as member email.");
                $("#leader_email_error").addClass("alert alert-danger");
                return false;
            }
            else{
                $("#leader_email_error").html("");
                $("#leader_email_error").removeClass("alert alert-danger");
                return true;
            }
        }

        function  mobileValidate() {

            var number = /^[7-9]{1}[0-9]{9}$/;

            if (mobile == "" ){
                $("#mobile_error").html("Please Enter Phone number.");
                $("#mobile_error").addClass("alert alert-danger");
                return false;
            }
            else if (!mobile.match(number)){
                $("#mobile_error").html("Please Enter 10 digits number.");
                $("#mobile_error").addClass("alert alert-danger");
                return false;
            }
            else{
                $("#mobile_error").html("");
                $("#mobile_error").removeClass("alert alert-danger");
                return true;
            }
        }


        if(teamname_validate && title_validate && description_validate &&
            contactperson_validate && mobile_validate && email_validate ) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: '/register',
                data: {
                    team_name: teamName,
                    title: title,
                    description:description,
                    contact_person:contactPerson,
                    email:leaderEmail,
                    mobile:mobile,
                    event_id:event_id,
                    allmembers: allmembers
                },
                dataType: 'json',
                success: function (response) {
                    if(response.success == true){
                        alert(response.message);
                        $('.form-group').children().val('');
                        $('.form-control').children().val('');
                        $('.form-control').children().val('');
                        $('#success_message').show();
                        $('#success_message').fadeIn();
                        $('#success_message').html(response.message);
                        $('#success_message').fadeOut(6000);
                        // window.location = "/";





                        // setTimeout(function() {
                        //     $('#success_message').fadeOut('fast');
                        // }, 30000);
                        // $('#team_name_error').val('');

                        // $('#team_name_error').val('');
                        // $('#title_error').val('');
                        // $('#contact_person_name_error').val('');
                        // $('#leader_email_error').val('');
                        // $('#mobile_error').val('');
                        // $('#description_error').val('');

                    }else{
                        $('#failed_message').show();
                        $('#failed_message').fadeIn();
                        $('#failed_message').html(response.message);
                        $('#failed_message').fadeOut(6000);
                        alert(response.message);
                    }

                }
            });

        }
        else{
            //alert('false');
            return false;
        }

    });

});
