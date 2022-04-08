<?php
include ('../includes/dbconn.php');
session_start();
if(isset($_POST['submit'])) {


    $datestart = $_POST['datestart'];
    $datestartd = new DateTime($datestart);
    $dateend = $_POST['dateend'];
    $dateendd = new DateTime($dateend);

    $datestart = date_format($datestartd,"Y-m-d");
    $dateend = date_format($dateendd,"Y-m-d");

    $reason = $_POST['reason'];

    $currentdate = date("Y-m-d");
    $currentdated = new DateTime($currentdate);
    $currentdate = date_format($currentdated,"Y-m-d");
    $currentdatediff = date_diff($currentdated,$datestartd);
    $checkstartdate = $currentdatediff->format("%R");


    $datediff = date_diff($datestartd,$dateendd);
    $totaldays = $datediff->format("%a");
    $totaldayscheck = $datediff->format("%R");

    $sql = "INSERT INTO submissions (vacstart, vacend, totaldays, statusid, employeeid, reason)VALUES ('$datestart', '$dateend', $totaldays, 1,'" . $_SESSION['empid'] . "', '$reason')";

    if ($totaldayscheck == "+" && $checkstartdate == "+" && $totaldays > 0) {
        if ($conn->query($sql) === TRUE) {
//            echo "New record created successfully";
        } else {
            $php_errormsg = "wrong email or password";
        }
        $conn->close();
    }else{
        $php_errormsgdate = "your dates are incompatible";
    }
}
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
    <button type='button' class='btn btn-secondary' style="margin: 1rem;"><a href='dashboard.php' style='text-decoration: none;color: white;'><- Back to dashboard </a></button>

    <div class="container col-lg-4">
        <h2>Sumbission request form</h2><br>
        <form method="post" name="submit">
            <div class="form-group">
                <label for="datestart"> Date From: </label>
                <input type="date" class="form-control" id="datestart" name="datestart" min="<?php echo date("Y-m-d"); ?>" required>
            </div>
            <div class="form-group">
                <label for="dateend"> Date To: </label>
                <input type="date" class="form-control" id="dateend" name="dateend" min="<?php echo date("Y-m-d"); ?>" required>
            </div>
            <div class="form-group">
                <label for="reason">Reason:</label>
                <textarea class="form-control" rows="5" maxlength="500" id="reason" placeholder="Write the reason here (optional)." name="reason"></textarea>
                <p>Max. 500 characters.</p>
            </div>
            <?php
            if(isset($php_errormsgdate)){
                echo $php_errormsgdate;
                echo "<br><br>";
            }
            ?>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>




<?php
}else echo "<h1 style='text-align: center'>Please login first</h1><br><p id='loginpage'><button type='button' class='btn btn-primary'><a href='../index.php' style='text-decoration: none;color: white;'>Login Page </a></button></p>";
?>
</body>
</html>
