<?php
    header("Access-Control-Allow-Origin: http://localhost:3000");
    const _CREATE = 1;
    const _READ = 2;
    const _UPDATE = 3;
    const _DELETE = 4;

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
            die('Cannot connect to host. Retrying...You will be redirected back to <a href="WD34_Exercise35_Tena.php">WD34_Exercise35_Tena</a> after 5 seconds...');
            break;
        case 1049:
            $conn = @mysqli_connect($config['host'], $config['username'], $config['password']);
            $rslt = mysqli_query($conn, $initStmt['createKodeGoDb']);
            die('Cannot find database. Creating...You will be redirected back to <a href="WD34_Exercise35_Tena.php">WD34_Exercise35_Tena</a> after 5 seconds...');
            break;
        default:
            mysqli_select_db($conn, $config['dbname']);
            mysqli_query($conn, $initStmt['createTeacherTbl']);
            mysqli_query($conn, $initStmt['createStudentTbl']);
            mysqli_query($conn, $initStmt['createBatchTbl']);
    }

    $method = $_SERVER['REQUEST_METHOD'];
    switch($method) {
        case 'GET':
            $sql = "SELECT * FROM student_tbl";
            break;
        case 'POST':
            $mode = $_POST['mode'];
            switch($mode) {
                case _CREATE:
                    $student_firstname = $_POST['student_firstname'];
                    $student_lastname = $_POST['student_lastname'];
                    $student_batch = $_POST['student_batch'];
                    $sql = "INSERT INTO `student_tbl`(`student_firstname`, `student_lastname`, `student_batch`) VALUES('$student_firstname', '$student_lastname', '$student_batch');";
                    break;
                case _UPDATE:
                    $student_id = $_POST['student_id'];
                    $student_firstname = $_POST['student_firstname'];
                    $student_lastname = $_POST['student_lastname'];
                    $student_batch = $_POST['student_batch'];
                    $sql = "UPDATE `student_tbl` SET `student_firstname`='$student_firstname', `student_lastname`='$student_lastname', `student_batch`='$student_batch' WHERE `student_id`='$student_id';";
                    break;
                case _DELETE:
                    $student_id = $_POST['student_id'];
                    $sql = "DELETE FROM `student_tbl` WHERE `student_id`='$student_id';";
                    break;
                default:
                    //do nothing
            }
            
            break;
        default:
            //do nothing
    }

    $rslt = mysqli_query($conn, $sql);
    if(!is_bool($rslt)) {
        echo "[";
        for($i=0; $i<mysqli_num_rows($rslt); $i++) {
            echo ($i>0?',':'').json_encode(mysqli_fetch_object($rslt));
        }
        echo "]";
    } else {
        echo mysqli_affected_rows($conn) . ' record(s) affected';
    }
?>