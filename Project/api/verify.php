<?php

session_start();
include('connection.php');
$json = json_decode(file_get_contents("php://input"),true);


// Send verification code 
if($json['call'] == 1){

    $random = mt_rand(100000,999999);
    $id = $json['id'];

    $getmail = mysqli_query($con,"select email from register where id='$id'");
    $fetch = mysqli_fetch_array($getmail);
    $email = $fetch['email'];

    $to = $email;
    $subject = "Online voting - verificaton!";
    $body = "Verification code is $random";
    $sender_email = "From: onlinevotingsystem2@gmail.com";
        
    $query = mysqli_query($con, "INSERT INTO `verify`(`code`) VALUES ('$random')");
    $sendMail = mail($to,$subject,$body,$sender_email);

    if($sendMail){
        $_SESSION['email'] = $email;
        echo json_encode($response['success'] = 1);
    }
    else{
        echo json_encode($response['success'] = 0);
    }

}


// Check verification code
if($json['call'] == 2){

    $code = $json['code'];
    $id = $json['id'];
    $query = mysqli_query($con, "select * from verify where code='$code'");
    if(mysqli_num_rows($query)>0){
        $update = mysqli_query($con,"update register set is_verified=1 where id='$id'");
        if($update){
            $delCode = mysqli_query($con, "delete from verify where code='$code'");
            echo json_encode($response['success'] = 1);
        }
    }
    else{
        echo json_encode($response['success'] = 0);
    }

}

// Send verification code 
if($json['call'] == 3){

    $random = mt_rand(100000,999999);
    $email = $json['email'] ;
    $check = mysqli_query($con, "SELECT email from register WHERE email ='$email'");

    if(mysqli_num_rows($check)>0){
                
        $to = $email;
        $subject = "Online voting - password reset!";
        $body = "Verification code is $random";
        $sender_email = "From: onlinevotingsystem2@gmail.com";
        
        $query = mysqli_query($con, "insert into verify (code) values('$random')");
        $sendMail = mail($to,$subject,$body,$sender_email);

        if($sendMail){
            $_SESSION['email'] = $email;
            echo json_encode($response['success'] = 1);
        }
        else{
            echo json_encode($response['success'] = 0);
        }
    }
    else{
        echo json_encode($response['success'] = 2);
    }
    
}

if($json['call'] == 4){

    $vcode = $json['vcode'];
    $newpass = $json['newpass'];
    $email_id = $_SESSION['email'];

    $query = mysqli_query($con, "select * from verify where code='$vcode'");
    if(mysqli_num_rows($query)>0){
        $enc_pass = md5($newpass);
        $enc_pass1 = sha1($enc_pass);
        $enc_pass2 = password_hash($enc_pass1, PASSWORD_DEFAULT);
        $update = mysqli_query($con, "update register set password = '$enc_pass2' where email='$email_id' ");
        
        if($update){
            $delCode = mysqli_query($con, "delete from verify where code='$vcode'");
            echo json_encode($response['success'] = 1);
        }
    }
    else{
        echo json_encode($response['success'] = 0);
    }
}

?>