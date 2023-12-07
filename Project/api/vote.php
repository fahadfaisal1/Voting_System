<?php

session_start();
include('connection.php');
$json = json_decode(file_get_contents("php://input"),true);


if($json['call'] == 1){
    
    $v_id = $json['v_id'];
    $c_id = $json['c_id'];
    $rank = $json['rank'];

    $check = mysqli_query($con, "select * from voting where v_id='$v_id' and rank='$rank'");
    if(mysqli_num_rows($check)>0){
        echo json_encode($response['success'] = 0);
    }
    else{
        $query = mysqli_query($con, "insert into voting (v_id, c_id, rank) values('$v_id', '$c_id', '$rank')");
        if($rank == 1){
            $sql = mysqli_query($con,"SELECT r1 FROM result WHERE c_id = $c_id");
            $row =mysqli_fetch_array($sql);
            $rank1 = $row['r1'];
            $rank1 ++;
            $upsql = mysqli_query($con,"UPDATE `result` SET `r1` = $rank1 WHERE c_id = $c_id");
        }
        if($rank == 2){
            $sql = mysqli_query($con,"SELECT r2 FROM result WHERE c_id = $c_id");
            $row =mysqli_fetch_array($sql);
            $rank2 = $row['r2'];
            $rank2 ++;
            $upsql = mysqli_query($con,"UPDATE `result` SET `r2` = $rank2 WHERE c_id = $c_id");
        }
        if($rank == 3){
            $sql = mysqli_query($con,"SELECT r3 FROM result WHERE c_id = $c_id");
            $row =mysqli_fetch_array($sql);
            $rank3 = $row['r3'];
            $rank3 ++;
            $upsql = mysqli_query($con,"UPDATE `result` SET `r3` = $rank3 WHERE c_id = $c_id");
        }
        if($rank == 4){
            $sql = mysqli_query($con,"SELECT r4 FROM result WHERE c_id = $c_id");
            $row =mysqli_fetch_array($sql);
            $rank4 = $row['r4'];
            $rank4 ++;
            $upsql = mysqli_query($con,"UPDATE `result` SET `r4` = $rank4 WHERE c_id = $c_id");
        }
        if($query){
            $updateStatus = mysqli_query($con, "update register set status=1 where id='$v_id'");
            echo json_encode($response['success'] = 1);
        }
        else{
            echo json_encode($response['success'] = 2);
        }
    }

}


if($json['call'] == 2){

        $code = $json['code'] ;
        $mycode = 'abcd';
        $state = $json['vote'] ;

        if($code==$mycode){

            if($state=='on'){
                $vote = mysqli_query($con, "update candidates set status = 1");
                $add1 = mysqli_query($con,"INSERT INTO `result`(`c_id`, `r1`, `r2`, `r3`, `r4`) VALUES (5,0,0,0,0)");
                $add2 = mysqli_query($con,"INSERT INTO `result`(`c_id`, `r1`, `r2`, `r3`, `r4`) VALUES (6,0,0,0,0)");
                $add3 = mysqli_query($con,"INSERT INTO `result`(`c_id`, `r1`, `r2`, `r3`, `r4`) VALUES (7,0,0,0,0)");
                $add4 = mysqli_query($con,"INSERT INTO `result`(`c_id`, `r1`, `r2`, `r3`, `r4`) VALUES (8,0,0,0,0)");
                if($vote){
                    echo json_encode($response['success'] = 1);
                }
                else{
                    echo json_encode($response['success'] = 0);
                }
            }
            else{
                $vote = mysqli_query($con, "update candidates set status = 2");
                if($vote){
                    echo json_encode($response['success'] = 1);
                }
                else{
                    echo json_encode($response['success'] = 0);
                }
            }
           
        }
        else{
            echo json_encode($response['success'] = 2);
        }
       
    }

    
if($json['call'] == 4){

        $resetMembers = mysqli_query($con, "update register set status = 0");
        $resetCandidates = mysqli_query($con, "update candidates set status = 0, votes=0");
        $resetVoting = mysqli_query($con, "TRUNCATE TABLE voting");
        $resetresult = mysqli_query($con, "TRUNCATE TABLE result");
        if($resetMembers && $resetCandidates && $resetVoting){
            echo json_encode($response['success'] = 1);
        }
        else{
            echo json_encode($response['success'] = 0);
        }
}


// Send verification code 
if($json['call'] == 5){
    
    $v_id = $json['v_id'];
    $c_id = $json['c_id'];
    $votes = $json['votes'];
    $value = $json['value'];


    $check = mysqli_query($con, "select * from voting where v_id='$v_id' and c_id='$c_id' ");

    if(mysqli_num_rows($check)>0){
        echo json_encode($response['success'] = 0);
    }
    else{
        $query = mysqli_query($con, "insert into voting (v_id, c_id, value) values('$v_id','$c_id','$value')");
        $vote = mysqli_query($con, "update candidates set no_votes='$votes' where id='$c_id'");
        if($query and $vote){
            echo json_encode($response['success'] = 1);
        }
        else{
            echo json_encode($response['success'] = 0);
        }
    }
    

}


?>