<?php
session_start();
include '../api/connection.php';
/* This check is to ensure that only logged in users can access the page. */
/*If the user is not logged in, they will be redirected to the homepage. */
if (!isset($_SESSION['user_id'])) {
    header('location:../');
}
$sql =mysqli_query($con,"SELECT status FROM candidates LIMIT 1");
$res = mysqli_fetch_array($sql);
if($res['status'] == 1 || $res['status'] == 0){
    header("location:main.php");
} 

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <title>E-voting - Voting Panel</title>
    <link rel="stylesheet" href="../resources/Bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../resources/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../resources/css/stylesheet.css">
    <script src="../resources/Jquery/jquery-3.5.1.js"></script>
    <script src="../resources/Bootstrap/js/bootstrap.min.js"></script>
    <script src="../resources/js/sweetalert.min.js"></script>
</head>

<body>

    <div id="headerSection" class="sticky-top">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8 text-center pt-3">
                    <p id="brand">E Voting System</p>
                </div>
                <div class="col-md-2 text-center ">
                <h5><a style="color:white; text-decoration:none" href="main.php"><i class="fa fa-s"></i> Go back</a></h5>
                </div>
                <div class="col-md-2 text-center ">
                    <h5><a style="color:white; text-decoration:none" href="logout.php">Logout <i class="fa fa-user-circle"></i></a></h5>
                </div>
                
            </div>
        </div>
    </div>
    
    <div class="container-fluid">
        <div class="row ">
            <div class="col-12 d-flex justify-content-center ">
                <div class="row">
                    <div class="col-12">
                        <h1>WINNER!!</h1>
                    </div>
                </div>
                
                <img src="../uploads/man (1).png" class="img-thumbnail" alt="">
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table class="table table-primary">
                    <thead>
                        <th>s.no</th>
                        <th>Image</th>
                        <th>Name</th>    
                        <th>Total</th>
                    </thead>
                
                </table>
            </div>
        </div>
    </div>
   


</body>
</html>