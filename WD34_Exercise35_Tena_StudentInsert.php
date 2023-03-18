<?php
include 'WD34_Exercise34_Tena.php';

$student_firstname = $_POST['student_firstname'];
$student_lastname = $_POST['student_lastname'];
$student_batch = $_POST['student_batch'];

$sqlCmd = "INSERT INTO student_tbl(`student_firstname`, `student_lastname`, `student_batch`) VALUES('$student_firstname', '$student_lastname', '$student_batch')";
mysqli_query($conn, $sqlCmd);
echo mysqli_affected_rows($conn) . ' record(s) added. You will be redirected back to <a href="WD34_Exercise35_Tena.php">WD34_Exercise35_Tena</a> after 5 seconds...';
//header('location: WD34_Exercise35_Tena.php');
echo '<meta http-equiv="refresh" content="5;url=WD34_Exercise35_Tena.php" />';
?>