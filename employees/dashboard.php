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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<?php
if(isset($_SESSION["empname"])) {
?>
    <p class="userinfo"> Welcome <?php echo $_SESSION["empname"]; ?>.<br>
        <button id="logout" type="button" class="btn btn-secondary"><a href="logout.php" tite="Logout">Logout </a></button></p><br>

    <?php
    $sql = "SELECT submissions.*,stsubmission.status FROM employees, submissions, stsubmission WHERE stsubmission.id=submissions.statusid and employees.id = submissions.employeeid and employeeid = '" . $_SESSION['empid'] . "' ORDER BY submissions.date_submitted DESC";
    $result = $conn->query($sql);

    echo "<p class='tabletitle'>Past submissions<br><button id='newsubmit' type='button' class='btn btn-primary'><a style='text-decoration: none;color: white;' href='submit.php' tite='Submit request'>Submit request</a></button></p>";
    if ($result->num_rows > 0) {

//        echo "<div class='col-md-2'></div>";
        echo "<div class='container col-md-8'><table class='table table-striped table-hover'><tr><th>Date submitted</th><th>Vacation Start</th><th>Vacation End</th><th>Days requested</th><th>Status</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>".$row["date_submitted"]."</td><td>".$row["vacstart"]."</td><td>".$row["vacend"]."</td><td>".$row["totaldays"]."</td><td>".$row["status"]."</td></tr>";
        }
        echo "</table></div></div>";
//        echo "<div class='col-md-2'></div>";

        }
     else {
         echo "no past submissions found";
    }

    $conn->close();
    ?>



<?php
}else echo "<h1 style='text-align: center'>Please login first</h1><br><p id='loginpage'><button type='button' class='btn btn-primary'><a href='../index.php' style='text-decoration: none;color: white;'>Login Page </a></button></p>";
?>
</body>
</html>
