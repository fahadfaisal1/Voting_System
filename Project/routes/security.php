<?php
global $con;
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
    $id = $_GET['sid'];
    $sql = mysqli_query($con,"SELECT s.question FROM register as r JOIN sec_q as s ON r.sec_q_id = s.Id WHERE sid = $id");
    $res = mysqli_fetch_array($sql);
?>


    <div class="container">
        <div class="row d-flex justify-content-center my-5">
            <div class="col-7">
                <form method="post" class="form shadow ">
                    <div class="row ">
                        <div class="col-12 ">
                        <h3 class="text-center bg-primary text-light p-4">Answer the security question</h3>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center mt-4 px-3">
                        <div class="col-12">
                            <h5>Q. <?=$res['question']?></h5>
                        </div>
                    </div>
                    <div class="row px-3 mt-4">
                        <div class="col-12">
                            <label for="ans">Your Answer:</label><br>
                            <input type="text" name="ans" id="" class="w-75">
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-12 ">
                            <div class="bg-primary p-4 ">
                            <input type="submit" name="submit" class="text-center btn btn-light w-50 " style="margin-left: 25%;" value="Verify">
                            </div>
                        </div>
                    </div>
                </form>

                <?php
                // This code is used to verify the answer given by the user to a security question.
                // If the answer given is correct the user is sent to the newpass page else an alert is generated.
                if(isset($_POST['submit'])){
                    $ans = $_POST['ans'];
                    $sql2 = mysqli_query($con,"SELECT sec_ans FROM register WHERE sid = $id");
                    $res2 = mysqli_fetch_array($sql2);
                    if($ans == $res2['sec_ans']){
                        header("location:newpass.php?id=$id");
                    }
                    else{
                        echo("<script>alert('Incorrect Password');</script>");
                        header("Refresh:0");
                    }
                }
                    
                ?>

            </div>
        </div>
    </div>
</body>

</html>