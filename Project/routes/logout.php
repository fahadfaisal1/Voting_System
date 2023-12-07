<!--  Log out from the  current session and redirect to the index page. -->
<?php
    session_start();
    session_destroy();
    header('location:../index.php');
?>