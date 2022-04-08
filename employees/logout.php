<?php
session_start();
unset($_SESSION["empid"]);
unset($_SESSION["empname"]);
unset($_SESSION["adid"]);
unset($_SESSION["adname"]);
header("Location:../index.php");
?>