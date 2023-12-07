<?php
 session_start();
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/"
    crossorigin="anonymous">
  <title>E-voting - Forget Password</title>
  <link rel="stylesheet" href="../resources/Bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../resources/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../resources/css/stylesheet.css">
    <script src="../resources/Jquery/jquery-3.5.1.js"></script>
    <script src="../resources/Bootstrap/js/bootstrap.min.js"></script>
    <script src="../resources/js/sweetalert.min.js"></script>
</head>

<body>

<?php
    include('../routes/header.php');
?>

<div id="bodySection">
    <div class="container">
        <div class="row py-4">
            <div class="col-md-2"></div>
            <div class="col-md-8 text-center">
                <h3 id="groups">Forget Password</h3><br>
                <div id="loginSection" class="text-center p-5">
                    <form>
                        <div class="form-row py-1">
                            <div class="form-group col-md-9">
                                <div id="loadingIcon" style="display:none" class="py-3">
                                    <center>
                                        <div id="loadSpinner" class="spinner-border text-success" role="status">
                                        <span class="sr-only">Loading...</span>
                                        </div>
                                    </center>
                                </div>
                                <div id="getCode">
                                    <input type="text" id="email" class="form-control" placeholder="Enter email">
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                            <button type="button" id="verifyBtn" class="form-control btn btn-success">Verify</button>
                            </div>
                        </div>
                        <div class="form-row py-1" id="passArea" style="display:none">
                            <div class="form-group col-md-6">
                            <input id="vcode" type="text" class="form-control" placeholder="Enter verification code">
                            </div>
                            <div class="form-group col-md-6">
                            <input id="newpass" type="password" class="form-control" placeholder="New Password">
                            </div>
                        </div>
              
                        <div class="form-row py-1">
                            <div class="form-group col-md-12 px-4">
                            <input type="button" id="changePass" class="form-control btn btn-success" value="Change">
                            </div>
                        </div>
                        <div class="form-row py-1">
                            <div class="form-group col-md-12 px-5">
                            <a href="../" class="form-control btn btn-primary">Back</a>   
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
        <div class="row py-1" id="passArea">
        </div>
        <div class="row py-1" id="getcode">
        </div>
    </div>
</div>

<script>

    $(document).ready(function(){

        // Show the loading icon and hide the "Get Code" and "Verify" buttons when an AJAX request starts.
        $(document).ajaxStart(function(){
            $("#loadingIcon").show();
            $("#getCode").hide();
            $("#verifyBtn").hide();
            

        });

        // This code is used to hide the loading icon once the AJAX request is completed.
        // The .ajaxComplete() method binds an event handler to be triggered when an AJAX request completes.
        // This way, the loading icon will be hidden once the AJAX request is finished, ensuring a better user experience for the user.
        $(document).ajaxComplete(function(){
            $("#loadingIcon").hide();
        });

        // This is a jQuery AJAX function used to verify an email address when the user clicks the verify button.
        // A request is sent to the API 'verify.php', the data entered is encoded in JSON format, sent to the API and the response is evaluated.
        // If the response is 1, a verification code is sent to the email address and the code entry field and submit button are shown.
        // If the response is 2, an error is shown saying the email is invalid. Else, another type of error is shown.
        $("#verifyBtn").click(function(){
            var email = $("#email").val();

            if(email==''){
                alert('Email cannot be blank!');
            }
            else{
                $.ajax({
                url : '../api/verify.php',
                type : 'POST',
                dataType : 'json',
                contentType : 'application/json',
                data : JSON.stringify({
                    call : 3,
                    email : email
                }),
                success : function(data){
                    if(data==1){
                        $("#getCode").html('<center><p style="color:green">Verification code is sent to email!</p>')
                        $("#getCode").show();
                        $("#passArea").show();
                    }
                    else if(data==2){
                        swal({
                                title: "Invalid email!",
                                text: "Email id is not found in database!",
                                icon: "info",
                                button: "OK!",
                        });
                        $("#getCode").show();
                        $("#verifyBtn").show();
                        $("#email").val('');

                    }
                    else{
                        swal({
                                title: "Error!",
                                text: "Some error occured!",
                                icon: "error",
                                button: "OK!",
                        });
                    }
                }
                });
            }
        });

        // This function is used to change the user password using a verification code.
        // It sends a POST request to the API using AJAX to verify the code, if the code is correct it shows a success message
        // and redirects the user to homepage, if the code is wrong an error message is displayed.
        $("#changePass").click(function(){
            var vcode = $("#vcode").val();
            var newpass = $("#newpass").val();

            if(vcode=='' || newpass==''){
                alert("Fields cannot be left blank!");
            }
            else{
                $.ajax({
                url : '../api/verify.php',
                type : 'POST',
                dataType : 'json',
                contentType : 'application/json',
                data : JSON.stringify({
                    call : 4,
                    vcode : vcode,
                    newpass : newpass,
                }),
                success : function(data){
                    if(data==0){
                        swal({
                                title: "Invalid code!",
                                text: "Invalid verification code",
                                icon: "error",
                                button: "OK!",
                        });
                    }
                    else{
                        swal({
                                title: "Password changed!",
                                text: "New password is set!",
                                icon: "success",
                                button: "OK!",
                        }).then((vote) => {
                            window.location = '../';
                        });
                    }
                }
                
            });
            }

        });
    });

 
</script>

</body>

</html>