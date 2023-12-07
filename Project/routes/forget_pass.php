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

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <title>E-voting - Forget Password</title>
    <link rel="stylesheet" href="../resources/Bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../resources/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../resources/css/stylesheet.css">
    <script src="../resources/Jquery/jquery-3.5.1.js"></script>
    <script src="../resources/Bootstrap/js/bootstrap.min.js"></script>
    <script src="../resources/js/sweetalert.min.js"></script>
</head>

<!-- This code is used to a change password page and verify the user's email and security question.
The page is built using HTML, CSS, BOOTSTRAP, JQUERY and AJAX, and the functionality is built using PHP.
The script shown in the code is used to validate the password with certain rules and to send AJAX requests to verify the code, email and set the password.
The modal is also used to get the security question.-->
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
                            <div class="form-row py-1" id="passArea">
                                <div class="form-group col-md-6">
                                    <input id="vcode" type="text" class="form-control" placeholder="Enter verification code">
                                </div>
                                <div class="form-group col-md-6">
                                    <input id="newpass" type="password" class="form-control" placeholder="New Password">
                                </div>
                            </div>
                            <script>
                                var input = document.getElementById("newpass");
                                var pattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,}$/;
                                var errorMessage = "Password must contain at least 8 characters, including at least one uppercase letter, one lowercase letter, and one number.";
                                input.addEventListener("input", function() {
                                    var value = input.value;
                                    if (pattern.test(value)) {
                                        input.setCustomValidity("");
                                    } else {
                                        input.setCustomValidity(errorMessage);
                                    }
                                });
                            </script>

                            <div class="form-row py-1">
                                <div class="form-group col-md-12 px-4">
                                    <input type="button" id="changePass" class="form-control btn btn-success" value="Change">
                                </div>
                            </div>
                            <div class="text-center my-3">
                                <h3>OR</h3>
                            </div>
                            <div class="mb-3">
                                <h5>Answer the security question</h5>
                            </div>
                            <div class="form-row py-1">
                                <div class="form-group col-md-12 ">
                                    <button type="button" name="g_ques" id="verifyBtnn" class="form-control btn btn-success w-50" data-toggle="modal" data-target="#staticBackdrop">Get Question</button>
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
            <div class="row py-1" id="pArea">
            </div>

        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Verification</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="security.php" method="get">
                        <div class="container">
                            <div class="row">
                                <div class="col-9">
                                    <input type="text" name="sid" id="" class="form-control" placeholder="Enter Your Student ID" Required>
                                </div>
                                <div class="col-3">
                                    <input type="submit" value="Proceed" class="btn btn-info">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <script>
        // This code is used to reset the password of a user.
        // It contains JavaScript code to hide certain elements and show certain elements when the page is loaded.
        // It uses jQuery Ajax to send requests to the 'verify.php' page and receive data.
        // The code also contains a 'changePass' function which is used to send the new password to the server.
        // The code also contains alerts and SweetAlerts to inform the user in case of any errors.
        $(document).ready(function() {

            $("#passArea").hide();

            $(document).ajaxStart(function() {
                $("#loadingIcon").show();
                $("#getCode").hide();
                $("#verifyBtn").hide();


            });
            $(document).ajaxComplete(function() {
                $("#loadingIcon").hide();

            });

            $("#verifyBtn").click(function() {
                var email = $("#email").val();

                if (email == '') {
                    alert('Email cannot be blank!');
                } else {
                    $.ajax({
                        url: '../api/verify.php',
                        type: 'POST',
                        dataType: 'json',
                        contentType: 'application/json',
                        data: JSON.stringify({
                            call: 3,
                            email: email
                        }),
                        success: function(data) {
                            if (data == 1) {
                                $("#getCode").html('<center><p style="color:green">Verification code is sent to email!</p></center>');
                                $("#getCode").show();
                                $("#passArea").show();
                            } else if (data == 2) {
                                swal({
                                    title: "Invalid email!",
                                    text: "Email id is not found in database!",
                                    icon: "info",
                                    button: "OK!",
                                });
                                $("#getCode").show();
                                $("#verifyBtn").show();
                                $("#email").val('');

                            } else {
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

            $("#changePass").click(function() {
                var vcode = $("#vcode").val();
                var newpass = $("#newpass").val();

                if (vcode == '' || newpass == '') {
                    alert("Fields cannot be left blank!");
                } else {
                    $.ajax({
                        url: '../api/verify.php',
                        type: 'POST',
                        dataType: 'json',
                        contentType: 'application/json',
                        data: JSON.stringify({
                            call: 4,
                            vcode: vcode,
                            newpass: newpass,
                        }),
                        success: function(data) {
                            if (data == 0) {
                                swal({
                                    title: "Invalid code!",
                                    text: "Invalid verification code",
                                    icon: "error",
                                    button: "OK!",
                                });
                            } else {
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