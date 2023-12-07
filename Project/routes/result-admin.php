<?php
session_start();
$con = mysqli_connect('localhost', 'root', '', 'damilare');
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
                <div class="col-sm-8 text-center pt-3">
                    <p id="brand">Online Voting System</p>
                </div>
                <div class="col-md-2 text-center ">
                    <h5><a style="color:white; text-decoration:none" href="dashboard.php"><i class="fa fa-s"></i> Go back</a></h5>
                </div>
                <div class="col-sm-2 text-center pt-3">
                    <h5><a style="color:white; text-decoration:none" href="ad_logout.php">Logout <i class="fa fa-user-circle"></i></a></h5>
                </div>
            </div>
        </div>
    </div>

    <?php
    // To get the winner based on the ranking system
    $sql = mysqli_query($con, "SELECT c.*, COUNT(*) AS rank1_count
        FROM voting AS v
        JOIN candidates AS c
        ON v.c_id = c.id
        WHERE v.rank = 1
        GROUP BY c.id
        ORDER BY rank1_count DESC, (SELECT COUNT(*) FROM voting WHERE c_id = c.id AND rank = 2) DESC
        LIMIT 1;");
            $row = mysqli_fetch_array($sql);



    // To display the winner and ranking categories
    ?>

    <div>
        <div class="container">
            <div class="row py-5 form shadow px-5 pb-3 pt-2 d-flex justify-content-center">
                <div class="col-12 text-center">
                    <h1 class="text-primary">WINNER!!</h1>
                </div>
                <div class="col-3">
                    <div class="text-center">
                        <img src="../uploads/<?= $row['image'] ?>" width="150" height="150" alt="">
                        <h2><?= $row['name'] ?></h2>
                        <h4>Rank 1: <?= $row['rank1_count'] ?> Votes</h4>
                    </div>
                </div>
            </div>
            <div class="row py-3">
                <div class="form shadow w-100 p-5 text-center">
                    <table class="table w-100">
                        <thead>
                            <th>Rank</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Category</th>
                        </thead>
                        <tbody>
                            <?php
                            $sql = mysqli_query($con, "SELECT c.*, COUNT(*) AS rank_count
                        FROM voting AS v
                        JOIN candidates AS c
                        ON v.c_id = c.id
                        WHERE v.rank > 1
                        GROUP BY c.id
                        ORDER BY rank_count DESC;");
                            $rank = 2;
                            while ($row = mysqli_fetch_array($sql)) {
                            ?>
                                <tr class="py-2">
                                    <td><b><?= $rank++ ?></b></td>
                                    <td><img src="../uploads/<?= $row['image'] ?>" alt="" width="60px" height="60px"></td>
                                    <td><?= $row['name'] ?></td>
                                    <td><?= $row['category'] ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>