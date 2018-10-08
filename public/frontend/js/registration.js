$(document).ready(function() {
    $('#registration_submit').click(function() {

        // var memberEmail = $('#member_email').val();
        $('.member').children().val('');
        // alert('asdasd');
        var teamName = $("#team_name").val();
        var title = $("#title").val();
        // var description = $("#description").text();
        var description =  CKEDITOR.instances['description'].getData();
        // alert(description);
        var leaderEmail = $('input:radio[name=member_id]:checked').val();
        var mobile = $("input:radio[name=member_id]:checked").attr("data-mobile");
        var event_id = $('#event_id').val();
        var allmembers = $('#allmembers').val();
        var contactPerson =  $("input:radio[name=member_id]:checked").attr("data-contactperson");
        var teamname_validate = teamNameValidate(teamName);
        var title_validate = titleValidate(title);
        var description_validate = descriptionValidate(description);
        var availabilty_validate = memberAvailabilty();
        var contact_person_details = contcatPersonDetails(contactPerson,mobile,leaderEmail);

        // var members = jQuery.parseJSON(allmembers);
        // alert(members.length);
        //
        // $("#team_name").blur(function () {
        //     teamNameValidate();
        // });

        function contcatPersonDetails(contactPerson,mobile,leaderEmail){
            if(contactPerson && mobile && leaderEmail){
                return true;
            }else{
                $("#contact_person_error").html("Please make one of the member as contact person");
                $("#contact_person_error").addClass("alert alert-danger");
                return false;
            }
        }

        function memberAvailabilty(){

            if(allmembers){
                var members = jQuery.parseJSON(allmembers);
                if(members.length){
                    return true;
                    // alert(members.length);
                }else{
                    $("#error").html("Please add team members");
                    $("#error").addClass("alert alert-danger");
                    return false;
                }
            }
            else{
                $("#error").html("Please add team members");
                $("#error").addClass("alert alert-danger");
                return false;
            }
        }
        // function contactPersonAvailabilty(){
        //     var contact_person_email = $('#email').val();
        //     // alert(contact_person_email);
        //     if(allmembers){
        //         var members = jQuery.parseJSON(allmembers);
        //         // alert(members.length);
        //         for (var i=0 ; i < members.length ; i++)
        //         {
        //             // alert(members[i].member_email);
        //             if (members[i].member_email == contact_person_email) {
        //                 var check = true;
        //             }else {
        //                 var check = false;
        //                continue;
        //             }
        //         }
        //         if(check == true){
        //             // alert('available');
        //             $("#error").html("");
        //             $("#error").removeClass("alert alert-danger");
        //             return true;
        //         }else{
        //             // alert('not available');
        //             $("#error").html("Contact person not added as member.");
        //             $("#error").addClass("alert alert-danger");
        //             return false;
        //         }
        //     }else{
        //         // alert('PLease add');
        //         $("#error").html("Please add team members");
        //         $("#error").addClass("alert alert-danger");
        //         return false;
        //
        //     }
        // }

        if(teamname_validate && title_validate && description_validate &&contact_person_details && availabilty_validate) {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: register,
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
                        // alert(response.message);
                        $('.form-group').children().val('');
                        $('.form-control').children().val('');
                        $("#error").html("");
                        $("#error").removeClass("alert alert-danger");
                        $('#success_message').show();
                        $('#success_message').fadeIn();
                        $('#success_message').html(response.message);
                        $('#success_message').fadeOut(6000);
                        window.location = "/";

                    }else{
                        $('#failed_message').show();
                        $('#failed_message').fadeIn();
                        $('#failed_message').html(response.message);
                        $('#failed_message').fadeOut(6000);
                        // alert(response.message);
                    }

                }
            });

        }
        else{
            // alert('false');
            return false;
        }

    });

    $("#team_name").blur(function () {
        var teamName = $("#team_name").val();
        teamNameValidate(teamName);
    });

    function teamNameValidate(teamName)
    {
        var name = /^[A-Za-z0-9 ]+$/;

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

    $("#title").blur(function () {
        var title = $("#title").val();
        titleValidate(title);
    });

    function titleValidate(title) {
        var name = /^[A-Za-z0-9 ]+$/;

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

    $("#description").blur(function () {
        var description =  CKEDITOR.instances['description'].getData();
        descriptionValidate(description);
    });
    function  descriptionValidate(description)
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


});
