<?php
    include('connection.php');
    $json = json_decode(file_get_contents("php://input"),true);


    // Add candidate
        $image = $_FILES['logoImg']['name'];
        $tmp_name = $_FILES['logoImg']['tmp_name'];

        $query = mysqli_query($con, "update info set logo='$image'");
        $upload = move_uploaded_file($tmp_name,"../uploads/$image");

        if($query and $upload){
            echo json_encode($response['success']=1);
        }
        else{
            echo json_encode($response['success']=0);
        }
        

?>