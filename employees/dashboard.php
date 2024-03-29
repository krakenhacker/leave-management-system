<?php
include ('../includes/dbconn.php');
session_start();
?>
<html>
<head>
<title>Dashboard</title>
    <link rel="stylesheet" href="../css/dashboard.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/3cbcc35af1.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<?php
if(isset($_SESSION["empname"])) {
?>
    <p class="userinfo"> Welcome <?php echo $_SESSION["empname"]; ?>.<br>
        <a class="btn btn-secondary" href="logout.php" tite="Logout">Logout </a></p><br>

    <?php
    $sql = "SELECT submissions.*,stsubmission.status FROM employees, submissions, stsubmission WHERE stsubmission.id=submissions.statusid and employees.id = submissions.employeeid and employeeid = '" . $_SESSION['empid'] . "' ORDER BY submissions.date_submitted DESC";
    $result = $conn->query($sql);

    echo "<p class='tabletitle'>Past submissions<br><a class='btn btn-primary' style='text-decoration: none;color: white;' href='submit.php' tite='Submit request'>Submit request</a></p>";
    if ($result->num_rows > 0) {

//        echo "<div class='col-md-2'></div>";
        echo "<div class='container col-md-8'><table class='table table-striped table-hover'><tr><th>Date submitted</th><th>Vacation Start</th><th>Vacation End</th><th>Days requested</th><th>Status</th></tr>";
        while($row = $result->fetch_assoc()) {
            if($row["statusid"] == 2){
                $icon="<i class='far fa-calendar-check' style='color: limegreen'></i>";
                $color="limegreen";
            }elseif ($row["statusid"] == 3){
                $icon="<i class='far fa-calendar-times' style='color: red'></i>";
                $color="red";
            }else{
                $icon="<i class='fas fa-spinner fa-pulse'></i>";
                $color="black";
            }
            echo "<tr><td>".$row["date_submitted"]."</td><td>".$row["vacstart"]."</td><td>".$row["vacend"]."</td><td>".$row["totaldays"]."</td><td style='color: ".$color.";'>". $icon."  ".$row["status"]."</td></tr>";
        }
        echo "</table></div></div>";
//        echo "<div class='col-md-2'></div>";

        }
     else {
         echo "<p style='text-align: center'>no past submissions found</p>";
    }

    $conn->close();
    ?>



<?php
}else echo "<h1 style='text-align: center'>Please login first</h1><br><p id='loginpage'><button type='button' class='btn btn-primary'><a href='../index.php' style='text-decoration: none;color: white;'>Login Page </a></button></p>";
?>
</body>
</html>
