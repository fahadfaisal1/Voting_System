<?php
    session_start();
    include('../api/connection.php');
    $json = json_decode(file_get_contents("php://input"),true);
    
    
    // Check login
    if($json['call'] == 10){
        
        $pid = $json['id'];
        $pass = $json['pass'];

        $sql = "SELECT * FROM admin WHERE aid = $pid AND password = $pass";
        $res = mysqli_query($con,$sql);
        $row = mysqli_fetch_assoc($res);

        $id = $row['aid'];
        
        if( $row > 0){
            // Update status and login
            $s_res = mysqli_query($con,"UPDATE admin SET status = 1 WHERE aid = $id");
            $_SESSION['admin_id'] = $id;
            echo json_encode($response['success'] = 1);
        }
        else{
            echo json_encode($response['success'] = 0);
        }

    }

    if($json['call'] == 11){
        
        $random = mt_rand(100000,999999);
        $insert = mysqli_query($con, "insert into verify ('code') values('$random')");
        echo json_encode($random);
       
    }

?>