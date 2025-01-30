<?php
session_start();

if (!isset($_SESSION['student_id'])) {
    header("Location: user_LR.php");
    exit();
}

@require 'connectDB.php';

$student_exists = $_SESSION["student_id"];

$check_if_exists = "SELECT * FROM students WHERE student_id = '$student_exists'";
$get_rows = mysqli_query($connectDB, $check_if_exists);
$rows_count = mysqli_num_rows($get_rows);

if($rows_count < 1){
    header("Location: ../index.php");
}

?>