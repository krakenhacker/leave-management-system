<?php
include ('../includes/dbconn.php');
session_start();
if(isset($_POST['update'])) {
    $flag = TRUE;
    $employeeid = $_POST['id'];
    $password = ($_POST['password']);
    if (!mb_eregi("^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$", $password)) {
        $php_errormsg = "The password you have entered is invalid, please try again.(at least one upper letter,one number, lengh:8-40)";
        $flag = FALSE;
    }
    $confirmpassowrd = ($_POST['confirmpassword']);
    $password = md5($password);
    $confirmpassowrd = md5($confirmpassowrd);

    if ($password == $confirmpassowrd and $flag==TRUE) {
        $sqlupdate = "UPDATE employees SET password = '$password' WHERE employees.id=$employeeid;";
        if ($conn->query($sqlupdate) === TRUE) {
            header("Location:dashboard.php");
        }
        $conn->close();
    }else {
        if($flag == TRUE) {
            $php_errormsg = "password doesn't match";
        }
    }
}
?>
<html>
<head>
    <title>User Details</title>
    <link rel="stylesheet" href="../css/dashboard.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<?php
if(isset($_SESSION["adname"])) {
    $employeeid = $_GET['id'];
    $sql = "SELECT employees.*, emp_role.role FROM employees, emp_role WHERE employees.roleid = emp_role.id and employees.id='$employeeid'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $conn->close();

    ?>
    <a class='btn btn-secondary' href='dashboard.php' style='text-decoration: none;color: white;margin: 1rem;'><- Back to dashboard </a>
    <?php if ($result->num_rows > 0) { ?>
    <div class="container col-lg-4">
        <h2>User <?php echo "".$row['firstname']." with id = ".$row['id']?></h2><br>
        <form method="post" name="submit">
            <div class="form-group">
                <label for="firstname"> First name: </label>
                <input type="text" class="form-control" id="firstname" name="firstname" placeholder="<?php echo $row["firstname"]?>" disabled>
                <input type="number" id="id" name="id" value="<?php echo $row["id"]?>" hidden>
            </div>
            <div class="form-group">
                <label for="Laste name"> Last name: </label>
                <input type="text" class="form-control" id="lastname" name="lastname" placeholder="<?php echo $row["lastname"]?>" disabled>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" placeholder="<?php echo $row["email"]?>" name="email" disabled>
            </div>
            <div class="form-group">
                <label for="pwd">Password:</label>
                <input type="password" class="form-control" id="password" placeholder="Enter password" name="password" required>
            </div>
            <div class="form-group">
                <label for="confirmpwd">Confirm Password:</label>
                <input type="password" class="form-control" id="confirmpassword" placeholder="Enter password" name="confirmpassword" required>
            </div>
            <div class="form-group">
                <label for="usertype">User Type:</label>
                <select class="form-control" id="usertype" name="usertype" disabled>
                    <option value="" selected disabled hidden><?php echo $row["role"]?></option>
                    <option value="1">Employee</option>
                    <option value="2">Admin</option>
                </select>
            </div>
            <?php


            if(isset($php_errormsg)){
                echo $php_errormsg;
                echo "<br><br>";
            }

            ?>
            <button type="submit" name="update" class="btn btn-primary">Update</button>
        </form>
    </div>




    <?php
    }else{
        echo "<h2 style='text-align: center'>There is no existing user with this id</h2>";
    }
}else echo "<h1 style='text-align: center'>Please login first</h1><br><p id='loginpage'><button type='button' class='btn btn-primary'><a href='../index.php' style='text-decoration: none;color: white;'>Login Page </a></button></p>";
?>
</body>
</html>
