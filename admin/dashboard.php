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
if(isset($_SESSION["adname"])) {
    ?>
    <p class="userinfo"> Welcome <?php echo $_SESSION["adname"]; ?>.<br>
        <a class="btn btn-secondary" href="../employees/logout.php" tite="Logout">Logout </a></p><br>

    <?php
    $sql = "SELECT employees.*, emp_role.role FROM employees, emp_role WHERE employees.id=emp_role.employeeid";
    $result = $conn->query($sql);

    echo "<p class='tabletitle'>List of existing users<br><a class='btn btn-primary' style='text-decoration: none;color: white;' href='createuser.php' tite='Create User'>Create User</a></p>";
    if ($result->num_rows > 0) {

//        echo "<div class='col-md-2'></div>";
        echo "<div class='container col-md-8'><table class='table table-striped table-hover'><tr><th>First name</th><th>Last name</th><th>Email</th><th>User type</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>".$row["firstname"]."</td><td>".$row["lastname"]."</td><td>".$row["email"]."</td><td>".$row["role"]."</td></tr>";
        }
        echo "</table></div></div>";
//        echo "<div class='col-md-2'></div>";

    }
    else {
        echo "<p style='text-align: center'>no existing users found</p>";
    }

    $conn->close();
    ?>



    <?php
}else echo "<h1 style='text-align: center'>Please login first</h1><br><p id='loginpage'><a class='btn btn-primary' href='../index.php' style='text-decoration: none;color: white;'>Login Page </a></p>";
?>
</body>
</html>
