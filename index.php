<?php
session_start();
include ('includes/dbconn.php');
if(isset($_POST['signin'])) {


    $email = $_POST['email'];
    $password = ($_POST['password']);
    $password = md5($password);
    $sql = "SELECT * FROM employees WHERE email='$email' and password LIKE '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        while($row = $result->fetch_assoc()) {
            $_SESSION["empid"]=$row["id"];
            $_SESSION["empname"]=$row["firstname"];
            header('Location: employees/dashboard.php');
        }
    } else {
        $php_errormsg="wrong email or password ".$password."";
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Leave Portal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

<div class="container col-lg-6">
    <h2>Login form</h2>
    <form method="post" name="signin">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required>
        </div>
        <div class="form-group">
            <label for="pwd">Password:</label>
            <input type="password" class="form-control" id="password" placeholder="Enter password" name="password" required>
        </div>
        <?php
        if(isset($php_errormsg)){
            echo $php_errormsg;
            echo "<br>";
        }
        ?>
        <button type="submit" name="signin" class="btn btn-primary">Sign in</button>
    </form>
</div>





</body>
</html>