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
    <title>E-voting - Admin</title>
    <link rel="stylesheet" href="resources/Bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="resources/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="resources/css/stylesheet.css">
    <script src="resources/Jquery/jquery-3.5.1.js"></script>
    <script src="resources/Bootstrap/js/bootstrap.min.js"></script>
    <script src="resources/js/sweetalert.min.js"></script>
</head>

<body>

    <?php
    include('routes/header.php');
    ?>

    <div id="bodySection">
        <div class="container">
            <div class="row py-4">
                <!-- <div class="col-md-7 text-center">
                <h3 id="groups">Groups</h3><br>
                <div id="groupsList"></div>
            </div> -->
                <div class="col-md-2"></div>
                <div class="col-md-8 text-center">
                    <h3 id="groups">Admin Login</h3><br>
                    <div id="loginSection" class="text-center p-5">
                        <form>
                            <div class="form-row py-1">
                                <div class="form-group col-md-12 px-4">
                                    <input type="text" id="id" class="form-control" placeholder="Admin ID">
                                </div>
                            </div>
                            <div class="form-row py-1">
                                <div class="form-group col-md-12 px-4">
                                    <input id="pass" type="password" class="form-control" placeholder="Password">
                                </div>
                            </div>
                            <form method="post">
                                <div class="form-row py-1">
                                    <div class="form-group col-md-12 px-4">
                                        <input type="button" onclick="loginFun()" id="loginbtn" name="log" class="form-control btn btn-success" value="Login">
                                    </div>
                                </div>
                            </form>
                            <div class="form-row py-1">
                                <div class="form-group col-md-12 px-5">
                                    <a href="index.php" class="form-control btn btn-primary">Back</a>
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

    <!-- This script is used to log in to the admin page. It takes in the id and password from the user,
    sends them to the api/admin.php page and evaluates whether or not the credentials are valid.
    If the credentials are valid, it redirects to the dashboard page, otherwise, an error message is displayed. -->
    <script>
        //This function is used to login the user with the credentials provided.
        //It makes an AJAX call to the server for the login purpose and verifies the credentials.
        // If the credentials are valid, the user will be redirected to the dashboard page, otherwise an error message will be displayed.
        function loginFun() {
            var id = $("#id").val();
            var pass = $("#pass").val();

            $.ajax({
                url: 'api/admin.php',
                type: 'POST',
                dataType: 'json',
                contentType: 'application/json',
                data: JSON.stringify({
                    call: 10,
                    id: id,
                    pass: pass,
                }),
                success: function(data) {
                    if (data == 0) {
                        swal({
                            title: "Invalid Credentials!",
                            text: "Mobile or Password is invalid!",
                            icon: "error",
                            button: "OK!",
                        });
                    } else {
                        window.location = 'routes/dashboard.php';
                    }
                }

            });
        }
    </script>

</body>

</html>