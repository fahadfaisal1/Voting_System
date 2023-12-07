<?php
    include('connection.php');

    if($_SERVER['REQUEST_METHOD']=='POST'){
        $name = $_POST['name'];
        $faculty = $_POST['faculty'];
        $department = $_POST['department'];
        $email = $_POST['email'];
        $sid = $_POST['sid'];
        $pass = $_POST['pass'];
        $question = $_POST['ques'];
        $answer = $_POST['ans'];
        $date = date('d-m-Y');

        $check = mysqli_query($con, "select * from register where sid='$sid' ");

        if(mysqli_num_rows($check)>0){
            echo json_encode($response['success'] = 0);        
        }
        else
        {
            $enc_pass = md5($pass);
            $enc_pass1 = sha1($enc_pass);
            $enc_pass2 = password_hash($enc_pass1, PASSWORD_DEFAULT);
            // $query = mysqli_query($con, "insert into register (name, faculty, department, email, sid, password, sec_q_id, sec_ans, status, created_at) values('$name','$faculty','$department','$email','$sid','$enc_pass2',$question,$answer,0,'$date')");
            $query = mysqli_query($con,"INSERT INTO `register`(`name`, `faculty`, `department`, `email`, `sid`, `password`, `sec_q_id`, `sec_ans`, `status`, `created_at`) VALUES ('$name','$faculty','$department','$email','$sid','$enc_pass2','$question','$answer','0','$date')");
            if($query){
                echo json_encode($response['success']=1);
            }
            else{
                echo json_encode($response['success']=0);
            }
        }

       
    }

?>