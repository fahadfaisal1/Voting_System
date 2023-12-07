<?php
session_start();

/* This check is to ensure that only logged in users can access the page. */
/*If the user is not logged in, they will be redirected to the homepage. */
if (!isset($_SESSION['user_id'])) {
    header('location:../');
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <title>E-voting - Voting Panel</title>
    <link rel="stylesheet" href="../resources/Bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../resources/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../resources/css/stylesheet.css">
    <script src="../resources/Jquery/jquery-3.5.1.js"></script>
    <script src="../resources/Bootstrap/js/bootstrap.min.js"></script>
    <script src="../resources/js/sweetalert.min.js"></script>
</head>

<body>

    <div id="headerSection" class="sticky-top">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8 text-center pt-3">
                    <p id="brand">E Voting System</p>
                </div>
                <div class="col-md-2 text-center ">
                <h5><a style="color:white; text-decoration:none" href="results.php"><i class="fa fa-circle"></i> Results</a></h5>
                </div>
                <div class="col-md-2 text-center ">
                    <h5><a style="color:white; text-decoration:none" href="logout.php">Logout <i class="fa fa-user-circle"></i></a></h5>
                </div>
            </div>
        </div>
    </div>

    <div id="bodySection">
        <div class="container">
            <div class="row py-4">
                <div class="col-md-4 py-1">
                    <div id="infoSection" style="padding: 5px;border: 1px solid blue;background-color: white; border-radius: 10px;">
                        <div id="getLogo" class="text-center pt-2"></div>
                        <div id="info"></div>
                    </div>
                </div>
                <div class="col-md-8 py-1">
                    <div id="groupArea" style="padding: 5px;border: 1px solid blue;background-color: white; border-radius: 10px;">
                        <div id="groupSection">
                            <div id="group" style="display:none" class="p-1"></div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {

            $(document).ajaxStart(function() {
                $("#loadingIcon").show();
                $("#getCodeBtn").hide();

            });
            $(document).ajaxComplete(function() {
                $("#loadingIcon").hide();
                $("#getCodeBtn").show();
            });

            getData();
            getLogo();

            $("#getCode").click(function() {
                $.ajax({
                    url: '../api/verify.php',
                    type: 'POST',
                    dataType: 'json',
                    contentType: 'application/json',
                    data: JSON.stringify({
                        call: 1,
                        id: <?php echo $_SESSION['user_id'] ?>,
                    }),
                    success: function(data) {
                        if (data == 1) {
                            getData();
                            $("#getCodeBtn").html('<center><p style="color:blue">Verification code is sent to email!</p>')
                        } else {
                            swal({
                                title: "Error!",
                                text: "Some error occured!",
                                icon: "error",
                                button: "OK!",
                            });
                        }
                    }
                });
            });

            $("#submitVote").click(function() {

                if ($("#verifyCode").val() == '') {
                    swal({
                        title: "Enter Verification code!",
                        text: "Verification code cannot be blank!",
                        icon: "error",
                        button: "OK!",
                    });
                } else {
                    $.ajax({
                        url: '../api/verify.php',
                        type: 'POST',
                        dataType: 'json',
                        contentType: 'application/json',
                        data: JSON.stringify({
                            call: 2,
                            code: $("#verifyCode").val(),
                            id: <?php echo $_SESSION['user_id'] ?>,
                        }),
                        success: function(data) {
                            if (data == 1) {
                                getData();
                                $("#verifyCode").val('');
                                swal({
                                    title: "You are verified for voting!",
                                    text: "Now you can vote for your best ones!",
                                    icon: "success",
                                    button: "OK!",
                                });
                            } else {
                                swal({
                                    title: "Invalid verification code!",
                                    text: "Enter proper code!",
                                    icon: "error",
                                    button: "OK!",
                                });
                            }
                        }
                    });
                }

            });

        });


        // This function is used to confirm the user vote. It displays a message box with the option to either cancel or confirm the vote.
        // If the user confirms the vote, the voteDone() function is called to register the vote.
        function yesVote(v_id, c_id) {
            var v_id = v_id;
            var c_id = c_id;

            swal({
                    title: 'Are you sure?',
                    text: "Once you voted you won't be able to vote again!",
                    icon: "warning",
                    buttons: ['Cancel', 'Confirm'],
                    dangerMode: true,
                })
                .then((vote) => {
                    if (vote) {
                        voteDone(v_id, c_id);
                    } else {
                        swal("Think again and vote for best one!");
                    }
                });
        }


        // This function sends a POST request to the API to vote for a specific candidate in an election by their voter ID and candidate ID.
        // The rank of the given vote is taken from a form on the page.
        // The response from the API is used to alert the user if their vote was successful or if an error occurred.
        function voteDone(v_id, c_id) {
            var rank = $("#rank").val();

            $.ajax({
                url: '../api/vote.php',
                type: 'POST',
                dataType: 'json',
                contentType: 'application/json',
                data: JSON.stringify({
                    call: 1,
                    rank: rank,
                    c_id: c_id,
                    v_id: v_id,
                }),
                success: function(data) {
                    if (data == 1) {
                        swal({
                            title: "Thank You!",
                            text: 'Your vote is successful',
                            icon: "success",
                            button: "OK!",
                        });
                        getData();

                    } else if (data == 0) {
                        swal({
                            title: "Rank already given!",
                            text: "You cannot give same rank to different candidates!\n Use another one.",
                            icon: "info",
                            button: "OK!",
                        });
                    } else if (data == 2) {
                        swal({
                            title: "Select Rank",
                            text: "You have not chosen a rank for this candidate!",
                            icon: "info",
                            button: "OK!",
                        });
                        getData();
                    } else {
                        swal({
                            title: "Error!",
                            text: "There's some error!",
                            icon: "error",
                            button: "OK!",
                        });
                    }
                }
            });
        }


        //This function will get data from the api using an AJAX call.
        // The data will contain details on the voter, the groups running, and the rank array.
        // The data will be processed and displayed in respective sections.
        // The status, rank, and voting button is created depending on the data.
        function getData() {
            var id = <?php echo $_SESSION['user_id'] ?>;
            $.ajax({
                url: '../api/api.php',
                type: 'POST',
                dataType: 'json',
                contentType: 'application/json',
                data: JSON.stringify({
                    call: 2,
                    id: id,
                }),
                success: function(data) {
                    console.log(data);
                    var voter = data[0];
                    var groupsArray = data[1];
                    var rankArray = data[2];
                    var groupsInfo = '';
                    var status = (voter.status == 1) ? '<b style="color:blue">Voted</b>' : '<b style="color:red">Not Voted</b>';
                    var rank = '';
                    var yesBtn = '';
                    var options = `<option value="0">Select</option>` + groupsArray.map((value ,index) => {
                        return `<option value=${index+1}>${index+1}</option>`;
                    });

                    if (groupsArray.length == 0) {
                        $("#groupArea").html('<br><div class="text-center"><h5>No data available</h5><br><p>List will be soon available here!</p><img height="150" width="150" src="../uploads/smile.png"></div><br>');
                        $("#groupArea").show();
                    } else {
                        $.each(groupsArray, function(i, d) {
                            if (rankArray.length == 0) {
                                yesBtn = '<button type="button" class="btn btn-primary btn-sm" onclick="yesVote(\'' + voter.id + '\',\'' + d.id + '\')" disabled>Vote</button>';

                                rank = '<select class="form-control" id="rank">' +
                                    options +
                                    '</select>';
                            } else {
                                $.each(rankArray, function(j, e) {
                                    console.log(d.id);
                                    if (e.v_id == voter.id && e.c_id == d.id) {
                                        yesBtn = '<span class="p-2 badge badge-primary badge-pill">Voted</span>';
                                        rank = '<span> You ranked <b>' + e.rank + '</b></span>';
                                        return false;
                                    } else {
                                        yesBtn = '<button type="button" class="btn btn-primary btn-sm" onclick="yesVote(\'' + voter.id + '\',\'' + d.id + '\')" disabled>Vote</button>';
                                        rank = '<select class="form-control" id="rank">' +
                                            options +
                                            '</select>';
                                    }
                                    j++;
                                });
                            }

                            i++;
                            groupsInfo += '<div class="text-center" style="border:1px solid black;background-color: #f1f2f6; margin-bottom:10px; padding:10px; border-radius:10px">' +
                                '<form>' +
                                '<div class="form-row align-items-center">' +
                                '<div class="form-group col-sm-1"><b>' + i + '</b></div>' +
                                '<div class="form-group col-sm-4"><b>' + d.name + '</b><br><b>( ' + d.category + ' )</b></div>' +
                                '<div class="form-group col-sm-3"><img src="../uploads/' + d.image + '" height="60" width="60"></div>' +
                                '<div class="form-group col-sm-2">' +
                                rank +
                                '</div>' +
                                '<div class="form-group col-sm-2">' + yesBtn + '</div>' +
                                '</div>' +
                                '</form>' +
                                '</div>';

                        });
                        $("#group").html(groupsInfo);
                        $("#group").show();
                    }


                    var voterInfo = '<center><h5 style="color:blue" class="py-3">' + voter.name + '</h5></center>' +
                        '<form>' +
                        '<div class="form-row px-3">' +
                        '<div class="form-group col-3"><b>Faculty</b></div>' +
                        '<div class="form-group col-1">:</div>' +
                        '<div class="form-group col-8">' +
                        voter.faculty +
                        '</div>' +
                        '</div>' +
                        '<div class="form-row px-3">' +
                        '<div class="form-group col-3"><b>Dept.</b></div>' +
                        '<div class="form-group col-1">:</div>' +
                        '<div class="form-group col-8">' +
                        voter.department +
                        '</div>' +
                        '</div>' +
                        '<div class="form-row px-3">' +
                        '<div class="form-group col-3"><b>Email</b></div>' +
                        '<div class="form-group col-1">:</div>' +
                        '<div class="form-group col-8">' +
                        voter.email +
                        '</div>' +
                        '</div>' +
                        '<div class="form-row px-3">' +
                        '<div class="form-group col-3"><b>ID</b></div>' +
                        '<div class="form-group col-1">:</div>' +
                        '<div class="form-group col-8">' +
                        voter.sid +
                        '</div>' +
                        '</div>' +
                        '<div class="form-row px-3">' +
                        '<div class="form-group col-3"><b>Status</b></div>' +
                        '<div class="form-group col-1">:</div>' +
                        '<div class="form-group col-8">' +
                        status +
                        '</div>' +
                        '</div>' +
                        '</form>';



                    $("#info").html(voterInfo);

                    $("#rank").one('change', function() {
                        $(".btn-sm").prop('disabled', false);
                    });

                }

            });
        }


        // This function is used to get the logo of the site using the API call.
        // It makes a POST request to the API and then the logo retrieved is displayed in the page.
        function getLogo() {
            $.ajax({
                url: '../api/api.php',
                type: 'POST',
                dataType: 'json',
                contentType: 'application/json',
                data: JSON.stringify({
                    call: 14
                }),
                success: function(data) {
                    $("#getLogo").html('<img height="70" width="70" src="../uploads/' + data.logo + '">');
                }

            });
        }
    </script>

</body>

</html>