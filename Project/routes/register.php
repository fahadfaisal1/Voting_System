<?php
    session_start();
    include('../api/connection.php');
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
  <title>E-voting - Registration</title>
  <link rel="stylesheet" href="../resources/Bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../resources/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../resources/css/stylesheet.css">
    <link rel="stylesheet" href="../resources/Jquery/jquery-ui.css">
    <script src="../resources/Jquery/jquery-3.5.1.js"></script>
    <script src="../resources/Jquery/jquery-ui.js"></script>
    <script src="../resources/Bootstrap/js/bootstrap.min.js"></script>
    <script src="../resources/js/sweetalert.min.js"></script>
</head>

<body>

<?php
    include('header.php');
?>

<div id="bodySection">
    <div class="container">
        <div class="row align-items-center pt-3 text-center">
            <div class="col-md-1"><div id="getData"></div></div>
            <div class="col-md-11"><h4>Student Registration</h4></div>
        </div>
        <div class="row py-4">
            <div class="col-md-12">
                <div id="regSection" class="text-center">
                    <form id="regForm" enctype="multipart/form-data" >
                        <div class="form-row py-1">
                            <div class="form-group col-md-4">
                                <input name="name" type="text" class="form-control" placeholder="Name" required>
                            </div>
                            <div class="form-group col-md-4">
                                <input name="faculty" type="text" class="form-control" placeholder="Faculty" required>
                            </div>
                            <div class="form-group col-md-4">
                                <input name="department" type="text" class="form-control" placeholder="Department" required>
                            </div>
                        </div>
                        <div class="form-row py-1">
                            <div class="form-group col-md-4">
                            <input name="email" type="email" class="form-control" placeholder="Student email" required>
                            </div>
                            <div class="form-group col-md-4">
                                <input name="sid" type="text" class="form-control" placeholder="Student ID" required>
                            </div>
                            <div class="form-group col-md-4">
                                <input name="pass" id="pass" type="password" class="form-control" placeholder="Password" required>
                            </div>
                        </div>

                        <!-- // This script adds an event listener to an input with the id "pass" to validate -->
                        <!-- // that the input contains at least 8 characters, including at least one uppercase letter, one lowercase letter, and one number. -->
                        <!-- // If the input does not meet these criteria, the event listener sets a custom error message for the input. -->
                        <script>
                            var input = document.getElementById("pass");
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
                           <div class="form-group col-md-6">
                                <select name="ques" id="sec_q" class="w-100" class="input-group-text" required>
                                    <option value="" disabled selected>Choose Your Question</option>
                                    <?php
                                        $query = mysqli_query($con,"SELECT * FROM sec_q");
                                        while($q_res = mysqli_fetch_array($query)){
                                    ?>
                                    <option value="<?=$q_res['Id']?>"><?=$q_res['question']?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                           </div>
                           <div class="form-group col-md-6">
                                <input name="ans" type="text" class="form-control" placeholder="Security Answer" required>
                           </div>
                        </div>
                        
                        <div class="form-row py-1">
                            <div class="form-group col-md-3"></div>
                            <div class="form-group col-md-6">
                            <input type="submit" class="form-control btn btn-success" id="btnn" name="regbtn" value="Register">
                            </div>
                            <div class="form-group col-md-3"></div>
                        </div>
                    </form>
                    <a href="../"><button type="button" class="btn btn-primary">Back</button></a>

                </div>
            </div>
        </div>
        <div class="row py-1" id="pArea">
        </div>
    </div>
</div>

<!-- // This script file contains jQuery code for the registration page. This script is called when the document is ready. -->
<script>

    //This code is used to register a new user on the Online Voting Panel.
    // It sends the form data to the register.php file which processes the data and stores the data in the database.
    // The user is given feedback based on the result of the registration process.
    $(document).ready(function(){

        getData();

        $("#regForm").on('submit', function(e){
            e.preventDefault();
            $.ajax({
                url : '../api/register.php',
                type : 'POST',
                data : new FormData(this),
                contentType : false,
                cache : false,
                processData : false,
                success : function(data){
                    if(data == 1){
                        swal({
                            title: "Registration successfull!",
                            text: "You are registered on Online voting panel!",
                            icon: "success",
                            button: "OK!",
                    }).then((value)=>{
                        window.location = '../';
                    });
                    }
                    else if(data==0){
                        swal({
                            title: "User already exists!",
                            text: "This Student ID is already taken. Try another!",
                            icon: "error",
                            button: "OK!",
                    });
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
        });
    });

    //This function sends an AJAX POST request to an API and appends the logo retrieved through the response in an HTML element with the id 'getData'.
    function getData(){
        // This AJAX call is used to retrieve an image from the database.
        // The call is sent to the '../api/api.php' URL using the POST method and the data is returned in JSON format.
        // The call includes the parameter 'call' with the value '14'.
        // If the call is successful, the returned image is then inserted into the HTML element with the ID 'getData'.
        $.ajax({
            url : '../api/api.php',
            type : 'POST',
            dataType : 'json',
            contentType : 'application/json',
            data : JSON.stringify({
                call : 14
            }),
            success : function(data){
                $("#getData").html('<img height="50" width="50" src="../uploads/'+data.logo+'">');
            }
            
        });
    }

</script>

</body>

</html>