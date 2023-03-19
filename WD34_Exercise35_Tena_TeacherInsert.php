<?php
include 'WD34_Exercise34_Tena.php';

$teacher_firstname = isset($_POST['teacher_firstname'])?$_POST['teacher_firstname']:"";
$teacher_lastname = isset($_POST['teacher_lastname'])?$_POST['teacher_lastname']:"";
$teacher_position = isset($_POST['teacher_position'])?$_POST['teacher_position']:"";
$teacher_batch = isset($_POST['teacher_batch'])?$_POST['teacher_batch']:0;

$sqlCmd = "INSERT INTO teacher_tbl(`teacher_firstname`, `teacher_lastname`, `teacher_position`, `teacher_batch`) VALUES('$teacher_firstname', '$teacher_lastname', '$teacher_position', '$teacher_batch')";
mysqli_query($conn, $sqlCmd);
echo mysqli_affected_rows($conn) . ' record(s) added. You will be redirected back to <a href="WD34_Exercise35_Tena.php">WD34_Exercise35_Tena</a> after 5 seconds...';
header("refresh: 5; url=WD34_Exercise35_Tena.php");
?>