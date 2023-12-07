<?php
 session_start();
 include('../api/connection.php');
 if(!isset($_SESSION['admin_id'])){
    header('location:../admin.php');
}
$sql = mysqli_query($con,"SELECT * FROM `admin` WHERE status = 1");
$i = 0;
$id = $_SESSION['admin_id'];
while($res = mysqli_fetch_array($sql)){
    $i++;
}
if($i > 2){
    $s_sql = mysqli_query($con,"UPDATE admin SET status = 0 WHERE aid = $id");
    header('location:warn.html');
}



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
  <title>E-voting - Admin</title>
  <link rel="stylesheet" href="../resources/Bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../resources/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../resources/css/stylesheet.css">
    <script src="../resources/Jquery/jquery-3.5.1.js"></script>
    <script src="../resources/Bootstrap/js/bootstrap.min.js"></script>
    <script src="../resources/js/sweetalert.min.js"></script>
</head>

<body>

<div id="headerSection" class="sticky-top">
    <div class="container" >
        <div class="row align-items-center">
            <div class="col-sm-10 text-center pt-3">
                <p id="brand">Online Voting System</p>
            </div>
            <div class="col-sm-2 text-center pt-3">
                <h5><a style="color:white; text-decoration:none" href="ad_logout.php">Logout <i class="fa fa-user-circle"></i></a></h5>
            </div>
        </div>
    </div>
</div>

<div id="bodySection">
    <div class="container">

        <div class="row pt-4 align-items-center">
            <div class="col-md-1 text-center">
                <div id="logoArea"></div>
            </div>
            <div class="col-md-3 text-center">
                <h2 id="headtext">Dashboard</h2>
            </div>
            <div class="col-md-2 text-center pb-2">
                <!-- Button trigger modal -->
                <button style="display:none" type="button" id="startBtn" class="btn btn-success" data-toggle="modal" data-target="#startModal">
                Start Voting
                </button>
                <button style="display:none" id="stopBtn" type="button"  class="btn btn-danger" data-toggle="modal" data-target="#stopModal">
                Stop Voting
                </button>

                <!-- Voting Start Modal -->
                <div class="modal fade" id="startModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Enter verification code</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-row text-center">
                                    <div class="col-md-10 pb-1">
                                    <input id="verifyAdmin" class="form-control py-1" type="password"></input>
                                    </div>
                                    <div class="col-md-2">
                                    <button class="btn btn-primary" id="startVoting" type="button">Verify</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        </div>
                    </div>
                </div>

                 <!-- Voting Stop Modal -->
                 <div class="modal fade" id="stopModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Enter verification code</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-row text-center">
                                    <div class="col-md-10 pb-1">
                                    <input id="verifyAdmin2" class="form-control py-1" type="password"></input>
                                    </div>
                                    <div class="col-md-2">
                                    <button class="btn btn-primary" id="stopVoting" type="button">Verify</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2 text-center pb-2">
                <button type="button" id="resetBtn" class="btn btn-warning">
                    Reset
                    </button>
            </div>
           

            <div class="col-md-2 text-center pb-2">
                <!-- Button trigger modal -->
                <button type="button" id="editText" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                Edit title
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Edit Homepage Text</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <textarea id="getText" class="form-control" cols="30" rows="10"></textarea>
                        </form>
                    </div>
                    <div class="modal-footer">

                        <button type="button" id="updateText" class="btn btn-primary">Save changes</button>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="col-md-2 text-center pb-2">
              <!-- Button trigger modal -->
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
            Change Logo
            </button>

            <!-- Change Logo Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Change Logo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form enctype="multipart/form-data" id="logoForm">
                            <div class="input-group mb-3" id="imageBox">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" name="logoImg" id="inputGroupFile01" required>
                                                        <label class="custom-file-label" for="inputGroupFile01">Upload Logo</label>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-success">Change</button>
                    </form>
                </div>
                
                </div>
            </div>
            </div>
            </div>
        </div>
        <hr>

        <div class="row py-1">
            <div class="col-md-12 text-center pb-3">
                <div id="loginSection" class="text-center p-3">
                    <h3 id="groups">Voting Status</h3><br>
                    <div id="votingStatus" style="display:none">
                    </div>
                    
                </div>
            </div>

        </div>
        <div class="row py-3">
                <div class="col-md-12 text-center">
                    <div id="loginSection" class="p-4">
                    <h3 id="groups">Candidates</h3><br>
                    <div id="candidates">
                        <form id="candidateForm" enctype="multipart/form-data">
                            <div class="form-row py-1">
                                <div class="form-group col-md-3">
                                    <input name="name" type="text" id="cname" class="form-control" placeholder="Name" required>
                                </div>
                                <div class="form-group col-md-3">
                                <select class="form-control" name="category">
                                    <option value="S.U.G President">S.U.G President</option>
                                    <option value="S.U.G V. President ">S.U.G V. President </option>
                                    <option value="Class Representatives">Class Representatives</option>
                                    <option value="College Ambassadors">College Ambassadors</option>
                                </select>
                                </div>
                                <div class="form-group col-md-4 text-left">
                                    <div class="input-group mb-3" id="imageBox">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="image" id="inputGroupFile02" required>
                                            <label class="custom-file-label" for="inputGroupFile02">Upload Image</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-2">
                                    <input type="submit" class="form-control btn btn-success" id="btnn" name="regbtn" value="Add+">
                                    </div>
                                </div>
                            </div>
                        
                        </form>
                        <div id="candidatesList"></div>
                    </div>
                    </div>
                </div>
            </div>
    </div>
</div>

<script>

    //This code is used to create a vote that is initiated by an admin. When the admin enters the verification code and clicks on start voting, an AJAX request is made to the vote.php API
    // and if the code is valid, a confirmation message is displayed and displayed candidates are fetched from the API
    $(document).ready(function(){
        getCandidates();
        getInfo();

        // The code handles the click event of the start voting button on the webpage.
        // It sends an AJAX POST request to the server, with parameters from the user input, such as the code, and vote status.
        // After the server process the request, it returns data in json format. The code then checks the data and displays a corresponding alert to the user, then calls a couple of functions and clears the user input text.
        $("#startVoting").click(function(){

            var code = $("#verifyAdmin").val();
            var vote = 'on';

            if(code==''){
                alert('Code cannot be blank!');
            }
            else{
                $.ajax({
                    url : '../api/vote.php',
                    type : 'POST',
                    dataType : 'json',
                    contentType : 'application/json',
                    data : JSON.stringify({
                        call : 2,
                        code : code,
                        vote : vote
                    }),
                    success : function(data){
                        if(data==1){
                            swal({
                                    title: "Voting Started!",
                                    text: "Voting process is initiated from now!",
                                    icon: "success",
                                    button: "OK!",
                            });
                            getInfo();
                            getCandidates();  
                            $("#startModal").modal('hide');
                            $("#verifyAdmin").val('');

                               
                        }
                        else if(data==2){
                            swal({
                                    title: "Invalid code!",
                                    text: "Enter proper verification code!",
                                    icon: "error",
                                    button: "OK!",
                            });
                        }
                        else{
                            swal({
                                    title: "Error!",
                                    text: "There is some error!",
                                    icon: "error",
                                    button: "OK!",
                            });
                        }
                    }
                });
            }

           
        });

        //This code is used to create a prompt on the user's screen when the "resetBtn" button is clicked. It creates a sweet alert with a confirmation message, asking the user to confirm if they want to reset their settings.
        // If the user clicks 'Confirm', the resetData() function is executed.
        $("#resetBtn").click(function(){

            swal({
                title: 'Do you want to reset?',
                text: "Confirm if you want to reset settings!",
                icon: "warning",
                buttons: ['Cancel', 'Confirm'],
                dangerMode: true,
                })
                .then((vote) => {
                if (vote) {
                    resetData();
                } 
            });
        });

        //This function is triggered when the user clicks on the "Stop Voting" button. It retrieves the code entered by the user and sends it to the server. If the code is valid, a request is made to stop the voting process.
        // A success/error message is then provided to the user to indicate the status of the vote.
        $("#stopVoting").click(function(){

            var code = $("#verifyAdmin2").val();
            var vote = 'off';

            if(code==''){
                alert('Code cannot be blank!');
            }
            else{
                $.ajax({
                    url : '../api/vote.php',
                    type : 'POST',
                    dataType : 'json',
                    contentType : 'application/json',
                    data : JSON.stringify({
                        call : 2,
                        code : code,
                        vote : vote
                    }),
                    success : function(data){
                        if(data==1){
                            swal({
                                    title: "Voting Stoped!",
                                    text: "Voting process is stop!",
                                    icon: "success",
                                    button: "OK!",
                            });
                            getInfo();
                            getCandidates();  
                            $("#stopModal").modal('hide');
                            $("#verifyAdmin2").val('');
                    
                        }
                        else if(data==2){
                            swal({
                                    title: "Invalid code!",
                                    text: "Enter proper verification code!",
                                    icon: "error",
                                    button: "OK!",
                            });
                        }
                        else{
                            swal({
                                    title: "Error!",
                                    text: "There is some error!",
                                    icon: "error",
                                    button: "OK!",
                            });
                        }
                    }
                });
            }

        });


        // This code is used to update the homepage text. It triggers when the #updateText button is clicked. When clicked,
        // the code makes an AJAX call to the api.php file with a call value of 13 and the text input from the #getText field.
        // If the call is successful, a success alert is displayed to the user.
        $("#updateText").click(function(){
            $("#exampleModalCenter").modal('hide');
            var newText = $("#getText").val();
            $.ajax({
                url : '../api/api.php',
                type : 'POST',
                dataType : 'json',
                contentType : 'application/json',
                data : JSON.stringify({
                    call : 13,
                    text : newText
                }),
                success : function(data){
                    if(data==1){
                        swal({
                            title: "Text updated successfully!",
                            text: "Homepage text is updated successfully!",
                            icon: "success",
                            button: "OK!",
                        }).then((value)=>{
                            getInfo();
                        });
                    }
                  
                }
            });
        })

        
    });

    //This code is for resetting the data for the voting process. It makes an AJAX call to the "vote.php" API with the call parameter 4.
    // If the call is successful, it displays a success alert and renews the vote information and candidates information.
    function resetData(){
        $.ajax({
                    url : '../api/vote.php',
                    type : 'POST',
                    dataType : 'json',
                    contentType : 'application/json',
                    data : JSON.stringify({
                        call : 4,
                    }),
                    success : function(data){
                        if(data==1){
                            swal({
                                    title: "Setting reset successfull!",
                                    text: "Voting process is initiated from now!",
                                    icon: "success",
                                    button: "OK!",
                            });    
                            getInfo();
                            getCandidates();                        
                            
                        }
                        else{
                            alert('error');
                        }
                    }
                });
    }

    //This function makes an AJAX call to the API and retrieves voting information from the API.
    // It checks the different conditions like if no data is available, or voting process is started or stopped and renders the voting status accordingly.
    // It also renders the voting text and logo from the API.
    function getInfo(){
        $.ajax({
            url : '../api/api.php',
            type : 'POST',
            dataType : 'json',
            contentType : 'application/json',
            data : JSON.stringify({
                call : 12
            }),
            success : function(data){
                var info = data[0];
                var done = data[1];
                var remain = data[2];
                var total = data[3];
                var canStatus = data[4];
                var canStatusStart = data[5];
                var canStatusStop = data[6];
                var remainingList = '';
                var n = 1;

                if(canStatus.length==0 && canStatusStart.length==0 && canStatusStop.length==0 ){
                    $("#startBtn").show();
                    $("#stopBtn").hide();
                    $("#votingStatus").html('<p class="text-center">No status available.<br>Soon data will be available when election process is started.</p><h5>Click on <span style="color:green">Start Voting</span> button to start election process.<br>Click <span style="color:red">Stop Voting</span> button to stop election process.</h5>');
                    $("#votingStatus").show();
                }
                else if(canStatus.length>0){
                    $("#startBtn").show();
                    $("#stopBtn").hide();
                    $("#votingStatus").html('<p class="text-center">No status available.<br>Soon data will be available when election process is started.</p><h5>Click on <span style="color:green">Start Voting</span> button to start election process.<br>Click <span style="color:red">Stop Voting</span> button to stop election process.</h5>');
                    $("#votingStatus").show();
                }
                else if(canStatusStart.length>0){
                    $("#startBtn").hide();
                    $("#stopBtn").show();
                    var count = (done.length + ' / ' + total.length);

                    if(done.length==total.length){
                        $("#votingStatus").html('<h1>'+count+'</h1><h3><span style="color:green">100% voting is done!</span></h3><h5><span style="color:green">Now get the results and stop the process.</span></h5><div class="py-2"><form method="POST" action="../api/attach.php"><input type="submit" name="getFile" class="btn btn-success" value="Get Results"></form></div>');
                        $("#votingStatus").show();
                    }
                    else{
                        $("#votingStatus").html('<h1>'+count+'</h1>'+
                                                '<h5>Votes done</h5>');
                        $("#votingStatus").show();

                        }
                }
                        
                else if(canStatusStop.length>0){
                    $("#startBtn").show();
                    $("#stopBtn").hide();
                    // $("#votingStatus").html('<h5 class="text-center">Voting process has been over!</h5><h4 style="color:green">Now you can get results from below button</h4><br><form method="POST" action="../api/attach.php"><input type="submit" name="getFile" class="btn btn-success" value="Get Results"></form><br>');
                    $("#votingStatus").html('<h5 class="text-center">Voting process has been over!</h5><h4 style="color:green">Now you can get results from below button</h4><br><form method="POST" action="../api/attach.php"><a href="result-admin.php" class="btn btn-success"> Get Results </a> <br>');
                    $("#votingStatus").show();
                }
                
                
                $("#getText").val(info[0].text);
                $("#logoArea").html('<img src="../uploads/'+info[0].logo+'" height="50" width="50">');
            }
        });
    }

    //This function is used to get the list of candidates from the database using AJAX call and display them on the page.
    // It checks if there are no candidates in the database, it will display a message, and if there are candidates present, it will display the details in a table.
    // If there is an error in retrieving the data, it will also display a message accordingly.
    function getCandidates(){
        $.ajax({
            url : '../api/api.php',
            type : 'POST',
            dataType : 'json',
            contentType : 'application/json',
            data : JSON.stringify({
                call : 11
            }),
            success : function(data){
                $("#cname").val('');
                $("#cpost").val('');
                $("#inputGroupFile01").val('');
                var sr = 1;
                var getCandidates = '';
                if(data==0){
                    $("#candidates").show();
                   $("#candidatesList").html('<p>No candidates are available right now.</p>');
                }
                else if(data==2){
                    $("#candidates").hide();
                    $("#candidatesList").html('<p style="color:red">You cannot access candidates right now!</p>');
                }
                else{
                    $("#candidates").show();
                    $.each(data, function(i, d){
                        getCandidates+=   
                            '<tr>'+
                                '<th scope="row">'+sr+'</th>'+
                                '<td colspan="2">'+d.name+'</td>'+
                                '<td scope="col">'+d.category+'</td>'+
                                '<td scope="col"><button class="btn btn-danger" onclick="deleteCandidate('+d.id+')">Remove</button></td>'+
                            '</tr>';
                            sr++;
                    });

                    $("#candidatesList").html(  
                       '<div class="table-responsive-md">'+
                       '<table class="table">'+
                            '<thead>'+
                                '<tr>'+
                                '<th scope="col">Sr.no.</th>'+
                                '<th colspan="2">Name</th>'+
                                '<th scope="col">Category</th>'+
                                '<th scope="col">Action</th>'+
                                '</tr>'+
                            '</thead>'+
                            '<tbody>'+
                                getCandidates+
                            '</tbody>'+
                        '</table></div>'
                        );
                }
            }
            
        });
    }

    //This function is used to call the 'candidateForm' submit event and send the data to the 'candidate.php' page using Ajax, which is then used to update the candidate database.
    // On success, it calls the 'getCandidates' function.
    $("#candidateForm").on('submit', function(e){
            e.preventDefault();
            $.ajax({
                url : '../api/candidate.php',
                type : 'POST',
                data : new FormData(this),
                contentType : false,
                cache : false,
                processData : false,
                success : function(data){
                    getCandidates();
                }
            });
        });

    // This script is used to handle the submission of the logo form. It prevents the default submission of the form and instead, makes an AJAX request to the info.php file.
    // The data stored in the form is sent via the AJAX request and upon a successful response, the getInfo() function is called.
        $("#logoForm").on('submit', function(e){
            e.preventDefault();
            $("#exampleModal").modal('hide');
            $.ajax({
                url : '../api/info.php',
                type : 'POST',
                data : new FormData(this),
                contentType : false,
                cache : false,
                processData : false,
                success : function(data){
                   
                    getInfo();
                }
            });
        });

    
    
    // This AJAX request is used to generate a code which can be used for some secure authentication process.
    // The code is then used to send to the API specified in the url '../api/admin.php' to create a JSON object which contains call value set to 11.
    // The success function then updates the HTML element with ID 'vcode' with the response from the API.
    function generateCode(){
        $.ajax({
            url : '../api/admin.php',
            type : 'POST',
            dataType : 'json',
            contentType : 'application/json',
            data : JSON.stringify({
                call : 11,
            }),
            success : function(data){
                $("#vcode").html('<br><h3 style="color:#1B1464">'+data+'</h3>');
            }
            
        });
    }

    //This function displays a sweet alert popup to the user when they attempt to delete a candidate.
    // The user can choose to confirm or cancel the action of deleting the candidate.
    // If they confirm, the delCan function is called by passing in the id of the candidate. If they choose to cancel, a message is displayed with a suggestion to vote for the best one.
    function deleteCandidate(id){

        var id = id;

        swal({
            title: 'Are you sure?',
            text: "Confirm first if you want to delete any candidate!",
            icon: "warning",
            buttons: ['Cancel', 'Confirm'],
            dangerMode: true,
            })
            .then((vote) => {
            if (vote) {
                delCan(id);
            } else {
                swal("Think again and vote for best one!");
            }
        });
    }

    // This function allows us to delete a particular candidate from the database by providing the id parameter.
    // It makes an AJAX call to the API and if it is successful then the candidate data is retrieved from the database and the candidates are removed from the list.
    function delCan(id){
        $.ajax({
            url : '../api/api.php',
            type : 'POST',
            dataType : 'json',
            contentType : 'application/json',
            data : JSON.stringify({
                call : 0,
                id : id
            }),
            success : function(data){
                if(data==1){
                    getCandidates();
                }
            }
            
        });
    }

 
</script>

</body>

</html>