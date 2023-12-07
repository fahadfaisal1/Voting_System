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
    $id = $_GET['id'];
?>


    <div class="container">
        <div class="row d-flex justify-content-center my-5">
            <div class="col-7">
<!-- 
                This form contains a password field for the user to enter a new password.
                The form also includes a script to validate the password
                The form also includes a submit button to update the password. -->
                <form method="post" class="form shadow ">
                    <div class="row ">
                        <div class="col-12 ">
                        <h3 class="text-center bg-primary text-light p-4">Answer the security question</h3>
                        </div>
                    </div>
                    
                    <div class="row px-3 mt-4">
                        <div class="col-12">
                            <label for="ans">Set New Password:</label><br>
                            <input type="password" name="pass" id="pass" class="w-75" required>
                        </div>
                    </div>
                    <!-- // This script adds an event listener to the "pass" input field.
                    // The listener checks the value in the field to verify that it meets the criteria of containing at least 8 characters, one uppercase letter, one lowercase letter and one number.
                    // If it meets the criteria, the setCustomValidity function is set to blank.
                    // If it does not meet the criteria, the setCustomValidity function is set to an error message. -->
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
                    <div class="row mt-5">
                        <div class="col-12 ">
                            <div class="bg-primary p-4 ">
                            <input type="submit" name="submit" class="text-center btn btn-light w-50 " style="margin-left: 25%;" value="Update">
                            </div>
                        </div>
                    </div>
                </form>

                <!-- // The below code is used to update the user's password in the database by taking the submitted password from the form -->
                <!-- and applying md5, sha1, and password_hash functions to it for further security before storing it into the database. -->
                <?php
                if(isset($_POST['submit'])){
                    $pass = $_POST['pass'];
                    $enc_pass = md5($pass);
                    $enc_pass1 = sha1($enc_pass);
                    $enc_pass2 = password_hash($enc_pass1, PASSWORD_DEFAULT);
                    $sql2 = mysqli_query($con,"UPDATE `register` SET `password`='$enc_pass2' WHERE `sid`='$id'");
                    header('location:../');
                }
                    
                ?>

            </div>
        </div>

    </div>
</body>

</html>