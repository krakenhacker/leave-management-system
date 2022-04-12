<?php
include ('../includes/dbconn.php');
session_start();
if(isset($_POST['submit'])) {
$flag=TRUE;
$sqlquerycheck = array("SELECT","UPDATE","DELETE");

    $datestart = $_POST['datestart'];
    $datestartd = new DateTime($datestart);
    $dateend = $_POST['dateend'];
    $dateendd = new DateTime($dateend);

    $datestart = date_format($datestartd,"Y-m-d");
    $dateend = date_format($dateendd,"Y-m-d");

    $reason = $_POST['reason'];
    foreach ($sqlquerycheck as $value) {
        $upper_reason = strtoupper($reason);
        if (strpos($upper_reason, $value) !== FALSE) {
            $flag = FALSE;
            $php_errormsg = "sql key words found";
            break;
        }
    }

    $currentdate = date("Y-m-d");
    $currentdated = new DateTime($currentdate);
    $currentdate = date_format($currentdated,"Y-m-d");
    $currentdatediff = date_diff($currentdated,$datestartd);
    $checkstartdate = $currentdatediff->format("%R");


    $datediff = date_diff($datestartd,$dateendd);
    $totaldays = $datediff->format("%a");
    $totaldayscheck = $datediff->format("%R");

    $sqlcheck = "SELECT * FROM employees WHERE roleid=2";
    $result = $conn2->query($sqlcheck);
    $conn2->close();
    $subject = "Leave request";
    $headers .= "From:". $_SESSION["empemail"] . "\r\n" . $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    $submitkey = random_strings(20);
    foreach ($sqlquerycheck as $value) {
        $upper_submitkey = strtoupper($submitkey);
        if (strpos($upper_submitkey, $value) !== FALSE) {
            $flag = FALSE;
            $php_errormsg = "sql key words found";
            break;
        }
    }
    $sql = "INSERT INTO submissions (vacstart, vacend, totaldays, statusid, employeeid, reason, submitkey)VALUES ('$datestart', '$dateend', $totaldays, 1,'" . $_SESSION['empid'] . "', '$reason', '$submitkey')";

    if ($totaldayscheck == "+" && $checkstartdate == "+" && $totaldays > 0 and $flag==TRUE) {
        if ($conn->query($sql) === TRUE) {
//            echo "New record created successfully";
            while($row = $result->fetch_assoc()) {
                $body = "<html><head><title>Leave request email</title></head><body>
                    <p>Dear supervisor,<br> employee ".$_SESSION['empname']." with id ".$_SESSION['empid']." requested for some time off, starting on
                    ".$datestart." and ending on ".$dateend.", stating the reason:
                    ".$reason." <br> <br>
                    Click on one of the below links to approve or reject the application:<br>
                    <a href='http://localhost/admin/updatesubmission.php?id=".$_SESSION['empid']."&submitkey=".$submitkey."&status=approved'>Approve</a> or <a href='http://localhost/admin/updatesubmission.php?id=".$_SESSION['empid']."&submitkey=".$submitkey."&status=rejected'>Reject</a>
                    </p>
                    </body></html>
        ";
                mail($row['email'],$subject,$body,$headers);
            }
            header("Location:dashboard.php");
        }
        $conn->close();
    }else{
        if($flag == TRUE) {
            $php_errormsgdate = "your dates are incompatible";
        }
    }
}
?>
<html>
<head>
    <title>Submit leaving</title>
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
    <a class='btn btn-secondary' href='dashboard.php' style='text-decoration: none;color: white;margin: 1rem;'><- Back to dashboard </a>

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
            if(isset($php_errormsg)){
                echo $php_errormsg;
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

<?php
function random_strings($length_of_string)
{
    $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    return substr(str_shuffle($str_result),
        0, $length_of_string);
}
?>