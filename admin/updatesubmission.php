<?php
include ('../includes/dbconn.php');
$employeeid = $_GET['id'];
$submitkey = $_GET['submitkey'];
$status = $_GET['status'];
if(isset($_GET['id']) && isset($_GET['submitkey']) && isset($_GET['status'])) {

    if ($status == "approved") {
        $sqlupdate = "UPDATE submissions SET statusid = 2 WHERE submissions.employeeid = $employeeid and submitkey = '$submitkey'";
    } else {
        $sqlupdate = "UPDATE submissions SET statusid = 3 WHERE submissions.employeeid = $employeeid and submitkey = '$submitkey'";
    }


    $sqlcheck = "SELECT statusid FROM submissions WHERE employeeid = $employeeid and submitkey = '$submitkey'";
    $result = $conn3->query($sqlcheck);
    $row = $result->fetch_assoc();
    if ($row['statusid'] == 2 or $row['statusid'] == 3) {
        $boolean = true;
    } else {
        $boolean = false;
    }
    $conn3->close();


    if ($conn->query($sqlupdate) === TRUE && $boolean === FALSE) {

        $sql = "SELECT employees.email, submissions.date_submitted FROM submissions, employees WHERE submissions.employeeid = $employeeid and submissions.submitkey = '$submitkey' and employees.id = submissions.employeeid";
        $result = $conn2->query($sql);
        $row = $result->fetch_assoc();
        $subject = "Leave request " . $status . "";
        $headers .= "From: leaveportaltest@gmail.com \r\n" . $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $body = "<html><head><title>Leave request email</title></head><body>
                    <p>Dear employee, your supervisor has " . $status . " your application submitted on " . $row['date_submitted'] . "</p>
                    </body></html>
        ";
        mail($row['email'], $subject, $body, $headers);
        echo "<h1 style='text-align: center'>Submission updated successfully!</h1>";
        $conn->close();
        $conn2->close();
    } else {
        echo "<h1 style='text-align: center'>Submission action expired!</h1>";
    }

}else{
    header('Location: ../index.php');
}
?>
