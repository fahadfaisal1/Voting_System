// Logging out the admin from the system by setting the status 0 and destroying the session.
<?php
include('../api/connection.php');
    session_start();
    $id = $_SESSION['admin_id'];
    $s_res = mysqli_query($con,"UPDATE admin SET status = 0 WHERE aid = $id");
    session_destroy();
    header('location:../admin.php');
?>