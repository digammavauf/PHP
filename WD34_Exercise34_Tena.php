<?php
    $config = array(
        'host'=>'localhost',
        'username'=>'root',
        'password'=>'',
        'dbname'=>'kodego_db'
    );

    $initStmt = array(
        'createKodeGoDb'=>'CREATE DATABASE IF NOT EXISTS `kodego_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;',
        'createTeacherTbl'=> 'CREATE TABLE IF NOT EXISTS `kodego_db`.`teacher_tbl` (`teacher_id` INT NOT NULL AUTO_INCREMENT, `teacher_firstname` VARCHAR(50) NOT NULL, `teacher_lastname` VARCHAR(50) NOT NULL, `teacher_position` VARCHAR(50) NOT NULL, `teacher_batch` INT NOT NULL DEFAULT 0, PRIMARY KEY (`teacher_id`));',
        'createStudentTbl'=> 'CREATE TABLE IF NOT EXISTS `kodego_db`.`student_tbl` (`student_id` INT NOT NULL AUTO_INCREMENT, `student_firstname` VARCHAR(50) NOT NULL, `student_lastname` VARCHAR(50) NOT NULL, `student_batch` INT NOT NULL DEFAULT 0, PRIMARY KEY (`student_id`));',
        'createBatchTbl'=> 'CREATE TABLE IF NOT EXISTS `kodego_db`.`batch_tbl` (`batch_id` INT NOT NULL AUTO_INCREMENT, `batch_name` VARCHAR(50) NOT NULL, `batch_size` INT NOT NULL, `batch_teacher` INT NOT NULL DEFAULT 0, PRIMARY KEY (`batch_id`));'
    );

    $conn = @mysqli_connect($config['host'], $config['username'], $config['password'], $config['dbname']);

    switch(mysqli_connect_errno()) {
        case 1045:
            header("refresh: 5; url=WD34_Exercise35_Tena.php");
            die('Cannot connect to host. Retrying...You will be redirected back to <a href="WD34_Exercise35_Tena.php">WD34_Exercise35_Tena</a> after 5 seconds...');
            break;
        case 1049:
            $conn = @mysqli_connect($config['host'], $config['username'], $config['password']);
            $rslt = mysqli_query($conn, $initStmt['createKodeGoDb']);
            header("refresh: 5; url=WD34_Exercise35_Tena.php");
            die('Cannot find database. Creating...You will be redirected back to <a href="WD34_Exercise35_Tena.php">WD34_Exercise35_Tena</a> after 5 seconds...');
            break;
        default:
            mysqli_select_db($conn, $config['dbname']);
            mysqli_query($conn, $initStmt['createTeacherTbl']);
            mysqli_query($conn, $initStmt['createStudentTbl']);
            mysqli_query($conn, $initStmt['createBatchTbl']);
    }
?>