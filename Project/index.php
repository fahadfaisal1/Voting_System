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
  <title>E-Voting - Home</title>
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
        <div class="row py-4 align-items-center">
            <div class="col-md-7 text-center pb-3">
            <h3 >Welcome to Online Voting</h3><br>
            <div id="getData">
            </div>
            </div>
            <div class="col-md-5 text-center">
                <div id="loginSection" class="text-center">
                    <h4><i class="fa fa-user-circle fa-3x" style="color:#27ae60"></i></h4>
                    <form>
                        <div class="form-row py-1 mx-4">
                            <div class="form-group col-md-12">
                            <input type="text" id="sid" class="form-control" placeholder="Student ID">
                            </div>
                        </div>
                        <div class="form-row pt-1 mx-4">
                            <div class="form-group col-md-12">
                            <input id="pass" type="password" class="form-control" placeholder="Password">
                            </div>
                        </div>
                      
                           
                    
                        <div class="form-row py-1 mx-4">
                            <div class="form-group col-md-12">
                                <input type="button" onclick="loginFun()" id="loginbtn" class="form-control btn btn-success" value="Login">
                                Forgot password? <a href="routes/forget_pass.php">Click here</a>
                            </div>

                        </div>
                        <div class="form-row py-1">
                            <div class="form-group col-md-12">
                                <h5>New student? <a href="routes/register.php">Register here</a></h5>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <hr>
        <div class="row py-1" id="pArea">
        </div>
    </div>
</div>

<!-- This code snippet uses Ajax and jQuery to execute a POST request to a PHP script called 'api.php'.
The request sends data in JSON format, which includes a call parameter with a value of 14.
The response from the server is processed and a logo and text are appended to the element with id "getData". -->
<script>

    // This code will call the getData() function once the document has loaded.
    $(document).ready(function(){
        getData();
    });

    // This function is used to retrieve data from the API using a POST request.
    // It then updates the HTML code with the data to update the information shown on the page.
    function getData(){
        $.ajax({
            url : 'api/api.php',
            type : 'POST',
            dataType : 'json',
            contentType : 'application/json',
            data : JSON.stringify({
                call : 14
            }),
            success : function(data){
                $("#getData").html('<img src="uploads/'+data.logo+'" style="border-radius:10px" height="270" width="300"><br><br><h5 id="titleText">'+data.text+'</h5>');
                
            }
            
        });
    }

    //This function is responsible for logging in the user.
    // It takes the Student ID and Password from the user, converts them into JSON format and sends to the server.
    // If the credentials are valid, the user is redirected to the main page, else an invalid credential alert is displayed.
    function loginFun(){
        var sid = $("#sid").val();
        var pass = $("#pass").val();

        $.ajax({
            url : 'api/api.php',
            type : 'POST',
            dataType : 'json',
            contentType : 'application/json',
            data : JSON.stringify({
                call : 1,
                sid : sid,
                pass : pass,
            }),
            success : function(data){
                if(data==0){
                    swal({
                            title: "Invalid Credentials!",
                            text: "Student ID or Password is invalid!",
                            icon: "error",
                            button: "OK!",
                    });
                }
                else{
                   window.location = 'routes/main.php';
                }
            }
            
        });
    }

 
</script>

</body>

</html>