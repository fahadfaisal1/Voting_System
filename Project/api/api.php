
<?php
    session_start();
    include('connection.php');
    $json = json_decode(file_get_contents("php://input"),true);
    

    // Check login
    if($json['call'] == 1){
        
        $sid = $json['sid'];
        $pass = $json['pass'];

        $enc_pass = md5($pass);
        $enc_pass1 = sha1($enc_pass);
        $enc_pass2 = password_verify($enc_pass1, PASSWORD_DEFAULT);

        $query = mysqli_query($con, "select * from register where sid='$sid'");
        if(mysqli_num_rows($query)>0){
            while($data = mysqli_fetch_array($query)){
                $check_pass = $data['password'];
                if(password_verify($enc_pass1,$check_pass)){
                    $id = $data['id'];
                    $_SESSION['user_id'] = $id;
                    echo json_encode($response['success'] = 1);
                }
                else{
                    echo json_encode($response['success'] = 0);
                }
            }
                    }
        else{
            echo json_encode($response['success'] = 0);
        }

    }


      // Get user and groups data
      if($json['call'] == 2){
        
        $id = $json['id'];
        $query = mysqli_query($con, 
        "select id, name, faculty, department, email, sid, status from register where id='$id'");
        
        $query2 = mysqli_query($con,
        "select id, name, image, category, status
        from candidates 
        where status=1");

        $query3 = mysqli_query($con,
        "select id, v_id, c_id, rank
        from voting");

        $userQuery = mysqli_num_rows($query);
        $canQuery = mysqli_num_rows($query2);
        $rankQuery = mysqli_num_rows($query3);

        if($userQuery>0){
            $voter = mysqli_fetch_array($query, MYSQLI_ASSOC);
            $empty = mysqli_free_result($query);
            $groupArray = mysqli_fetch_all($query2, MYSQLI_ASSOC);
            $empty1 = mysqli_free_result($query2);
            $rankArray = mysqli_fetch_all($query3, MYSQLI_ASSOC);
            $empty2 = mysqli_free_result($query3);
            echo json_encode([$voter, $groupArray, $rankArray]);
        }
    }


       // Get candidates
       if($json['call'] == 11){
        
        $getCandidates = mysqli_query($con, "select * from candidates where status=0");
        $getCandidates1 = mysqli_query($con, "select * from candidates where status=1");
        $getCandidates2 = mysqli_query($con, "select * from candidates where status=2");

        if(mysqli_num_rows($getCandidates)>0){
            $candidates = mysqli_fetch_all($getCandidates, MYSQLI_ASSOC);
            $empty = mysqli_free_result($getCandidates);
            echo json_encode($candidates);
        }
        else if(mysqli_num_rows($getCandidates1)>0){
            echo json_encode($response['success'] = 2);
        }
        else if(mysqli_num_rows($getCandidates2)>0){
            echo json_encode($response['success'] = 2);
        }
        else{
            echo json_encode($response['success'] = 0);
        }

    }

    if($json['call'] == 12){
        
        $getInfo = mysqli_query($con, "select * from info");
        $getStatus = mysqli_query($con, "select * from register where status=1");
        $getRemain = mysqli_query($con, "select * from register where status=0");
        $getTotal = mysqli_query($con, "select * from register");
        $getCanStatus = mysqli_query($con, "select * from candidates where status=0");
        $getCanStart = mysqli_query($con, "select * from candidates where status=1");
        $getCanStop = mysqli_query($con, "select * from candidates where status=2");

        $getInfo1 = mysqli_fetch_all($getInfo, MYSQLI_ASSOC);
        $empty1 = mysqli_free_result($getInfo);

        $getStatus1 = mysqli_fetch_all($getStatus, MYSQLI_ASSOC);
        $empty2 = mysqli_free_result($getStatus);

        $getRemain1 = mysqli_fetch_all($getRemain, MYSQLI_ASSOC);
        $empty3 = mysqli_free_result($getRemain);

        $getTotal1 = mysqli_fetch_all($getTotal, MYSQLI_ASSOC);
        $empty4 = mysqli_free_result($getTotal);

        $getCanStatus1 = mysqli_fetch_all($getCanStatus, MYSQLI_ASSOC);
        $empty5 = mysqli_free_result($getCanStatus);

        $getCanStatus2 = mysqli_fetch_all($getCanStop, MYSQLI_ASSOC);
        $empty6 = mysqli_free_result($getCanStop);

        $getCanStart1 = mysqli_fetch_all($getCanStart, MYSQLI_ASSOC);
        $empty7 = mysqli_free_result($getCanStart);

        echo json_encode([$getInfo1, $getStatus1, $getRemain1 ,$getTotal1, $getCanStatus1,$getCanStart1, $getCanStatus2]);
            

    }

    if($json['call'] == 13){
        
        $text = $json['text'];
        $setText = mysqli_query($con, "update info set text='$text'");
        if($setText){
            echo json_encode($response['success']=1);
        }

    }

    
    if($json['call'] == 14){
        $getInfo = mysqli_query($con, "select * from info");
        $get = mysqli_fetch_array($getInfo, MYSQLI_ASSOC);
        $empty = mysqli_free_result($getInfo);
        echo json_encode($get);
    }

    if($json['call']==0){
        $id = $json['id'];
        $delCandidate = mysqli_query($con,"delete from candidates where id='$id'");
        if($delCandidate){
            echo json_encode($response['success']=1);
        }
    }


  

    // Voting
    if($json['call'] == 3){
        
        $id = $json['id'];
        $votes = $json['votes'];
        $uid = $_SESSION['login'];
        $query = mysqli_query($con, "update register set votes='$votes' where id='$id'");
        $query1 = mysqli_query($con, "update register set status=1 where id='$uid'");
        if($query and $query1){
            echo json_encode($response['success']=1);
        }
        else{
            echo json_encode($response['success']=0);
        }
    }

    
    if($json['call'] == 4){
        
        $query = mysqli_query($con, "select name, image, votes from register where role=2");

        if(mysqli_num_rows($query)>0){
            $groupArray = mysqli_fetch_all($query, MYSQLI_ASSOC);
            $empty1 = mysqli_free_result($query);
            echo json_encode($groupArray);
        }
        else{
            echo json_encode($response['success']=0);
        }
       
       

    }
?>