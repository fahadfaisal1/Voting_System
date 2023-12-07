<?php
session_start();
include('connection.php');
        
// if(isset($_POST['getFile'])){

//     $output = '';
//     $candidates = mysqli_query($con, "select * from candidates");
//     $winner = mysqli_query($con, "select name, votes from candidates where votes=(select max(votes) from candidates)");
//     $winner_detail = mysqli_fetch_array($winner);
//     $total = mysqli_query($con, "select * from voting");
//     $totalVotes = mysqli_num_rows($total);

//         if(mysqli_num_rows($voting)>0){
//             $same = $winner_detail['votes'];
//             $check_same_votes = mysqli_query($con, "select name, votes from candidates where votes='$same'");

//             if(mysqli_num_rows($check_same_votes)>1){
//                 $output.=   '<table class="table" bordered="1">
//                             <tr>
//                                 <th>Name</th>
//                                 <th>Category</th>
//                                 <th>Rank 1s</th>
//                                 <th>Rank 2s</th>
//                                 <th>Rank 3s</th>
//                                 <th>Rank 4s</th>
//                                 <th>Rank 5s</th>
//                             </tr>';
    
//             while($row = mysqli_fetch_array($voting)){
//                 $output.=
//                         '<tr>
//                             <td>'.$row['name'].'</td>
//                             <td>'.$row['position'].'</td>
//                             <td>'.$row['votes'].'</td>
//                         </tr>';
//             }
//             $output.=   '<tr>
//                             <th colspan="2">Total</th>
//                             <td>'. $totalVotes.'</td>
//                         </tr>
//                         <tr>
//                             <th colspan="2">Election tied on</th>
//                             <td>'.$winner_detail['votes'].'</td>
//                         </tr>
                    
//                         </table>';
//             header("Content-Type: application/xls");
//             header("Content-Disposition: attachment; filename=results.xls");
//             echo $output;
//             }
            

//             else{
//             $output.=   '<table class="table" bordered="1">
//                             <tr>
//                                 <th>Name</th>
//                                 <th>Position</th>
//                                 <th>Votes</th>
//                             </tr>';
    
//             while($row = mysqli_fetch_array($voting)){

//                 $output.=
//                         '<tr>
//                             <td>'.$row['name'].'</td>
//                             <td>'.$row['position'].'</td>
//                             <td>'.$row['votes'].'</td>
//                         </tr>';
//             }
//             $output.=   '<tr>
//                             <th colspan="2">Total</th>
//                             <td>'. $totalVotes.'</td>
//                         </tr>
//                         <tr>
//                             <th colspan="2">Winner is '.$winner_detail['name'].'</th>
//                             <td>'.$winner_detail['votes'].'</td>
//                         </tr>
                    
//                         </table>';
//             header("Content-Type: application/xls");
//             header("Content-Disposition: attachment; filename=results.xls");
//             echo $output;


//         }
//     }
// }

if(isset($_POST['getFile'])){

    $output = '';
    $candidates = mysqli_query($con, "select * from candidates");
    $fetch_candidates = mysqli_fetch_all($candidates, MYSQLI_ASSOC);

    $output.='<table class="table" bordered="1">
                <tr>
                    <th>Name</th>
                    <th>Category</th>
                </tr>';

    for($i=0; $i<mysqli_num_rows($candidates); $i++){

        $candidate_id = $fetch_candidates[$i]['id'];
        $output.= '<tr>
                        <td>'.$fetch_candidates[$i]['name'].'</td>
                        <td>'.$fetch_candidates[$i]['category'].'</td>';

        $records = mysqli_query($con, "select c_id, v_id, rank from voting where c_id ='$candidate_id' ");
        $fetch_records = mysqli_fetch_all($records, MYSQLI_ASSOC);

        for($j=0; $j<mysqli_num_rows($records); $j++){
            $output.='<td>'.$fetch_records[$j]['rank'].'</td>';
        }

        $output.='</tr>';
        
        // print_r($fetch_records);

        // $repeated_value = mysqli_query($con, "
        // SELECT rank FROM voting WHERE c_id = '$candidate_id' GROUP BY rank ORDER BY count(*) desc limit 1");

        // $fetch_repeated_values = mysqli_fetch_array($repeated_value, MYSQLI_ASSOC);
        // print_r ($fetch_repeated_values);
    }

    $output.='</table>';

    header("Content-Type: application/xls");
    header("Content-Disposition: attachment; filename=results.xls");
    echo $output;
        
}


    
?>