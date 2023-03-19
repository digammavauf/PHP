<?php
include 'WD34_Exercise34_Tena.php';

$student_firstname = isset($_POST['student_firstname'])?$_POST['student_firstname']:"";
$student_lastname = isset($_POST['student_lastname'])?$_POST['student_lastname']:"";
$student_batch = isset($_POST['student_batch'])?$_POST['student_batch']:0;

$sqlCmd = "INSERT INTO student_tbl(`student_firstname`, `student_lastname`, `student_batch`) VALUES('$student_firstname', '$student_lastname', '$student_batch')";
mysqli_query($conn, $sqlCmd);
echo mysqli_affected_rows($conn) . ' record(s) added. You will be redirected back to <a href="WD34_Exercise35_Tena.php">WD34_Exercise35_Tena</a> after 5 seconds...';
header("refresh: 5; url=WD34_Exercise35_Tena.php");
?>