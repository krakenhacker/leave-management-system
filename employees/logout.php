<?php
session_start();
unset($_SESSION["empid"]);
unset($_SESSION["empname"]);
header("Location:../index.php");
?>