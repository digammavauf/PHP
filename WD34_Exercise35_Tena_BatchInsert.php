<?php
include 'WD34_Exercise34_Tena.php';

$batch_name = isset($_POST['batch_name'])?$_POST['batch_name']:"";
$batch_size = isset($_POST['batch_size'])?$_POST['batch_size']:"";
$batch_teacher = isset($_POST['batch_teacher'])?$_POST['batch_teacher']:0;

$sqlCmd = "INSERT INTO batch_tbl(`batch_name`, `batch_size`, `batch_teacher`) VALUES('$batch_name', '$batch_size', '$batch_teacher')";
mysqli_query($conn, $sqlCmd);
echo mysqli_affected_rows($conn) . ' record(s) added. You will be redirected back to <a href="WD34_Exercise35_Tena.php">WD34_Exercise35_Tena</a> after 5 seconds...';
header("refresh: 5; url=WD34_Exercise35_Tena.php");
?>