<?php
include ('../includes/dbconn.php');
session_start();
if(isset($_POST['create'])) {
    $flag=TRUE;
    $sqlquerycheck = array("SELECT","UPDATE","DELETE");

    $firstname = $_POST['firstname'];
    if(empty($firstname)){
        $flag=FALSE;
        $php_errormsg = "firstname is empty";
    }
    $lastname = $_POST['lastname'];
    if(empty($lastname)){
        $flag=FALSE;
        $php_errormsg = "lastname is empty";
    }
    $email = $_POST['email'];
    if (!mb_eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email)) {
        // Return Error - Invalid Email
        $php_errormsg = "The email you have entered is invalid, please try again.";
        $flag = FALSE;
    }
    $password = ($_POST['password']);
    if (!mb_eregi("^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$", $password)) {
        $php_errormsg = "The password you have entered is invalid, please try again.(at least one upper letter,one number, lengh:8-40)";
        $flag = FALSE;
    }
    $confirmpassowrd = ($_POST['confirmpassword']);
    $password = md5($password);
    $confirmpassowrd = md5($confirmpassowrd);
    $usertype = $_POST['usertype'];
    if(empty($usertype)){
        $flag=FALSE;
        $php_errormsg = "usertype is empty";
    }

    $sql = "INSERT INTO employees (firstname, lastname, email, password, roleid)VALUES ('$firstname', '$lastname', '$email', '$password', $usertype)";


    if ($password == $confirmpassowrd and $flag == TRUE) {
        if ($conn->query($sql) === TRUE) {
//            echo "New record created successfully";
            header("Location:dashboard.php");
        }else{
            $php_errormsg = "email already exist";
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
    <title>Create User</title>
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
    ?>
    <a class='btn btn-secondary' href='dashboard.php' style='text-decoration: none;color: white;margin: 1rem;'><- Back to dashboard </a>

    <div class="container col-lg-4">
        <h2>Create new user</h2><br>
        <form method="post" name="submit">
            <div class="form-group">
                <label for="firstname"> First name: </label>
                <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Enter First name" required>
            </div>
            <div class="form-group">
                <label for="Laste name"> Last name: </label>
                <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Enter Last name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required>
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
                <select class="form-control" id="usertype" name="usertype" required>
                    <option value="" selected disabled hidden>Choose user's permisions</option>
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
            <button type="submit" name="create" class="btn btn-primary">Create</button>
        </form>
    </div>




    <?php
}else echo "<h1 style='text-align: center'>Please login first</h1><br><p id='loginpage'><button type='button' class='btn btn-primary'><a href='../index.php' style='text-decoration: none;color: white;'>Login Page </a></button></p>";
?>
</body>
</html>
