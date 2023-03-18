<?php
    include 'WD34_Exercise34_Tena.php';
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Student Management</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    </head>
    <body>
        <div class="container-fluid">
            <?php
                if(!isset($_POST['student'])) {
                    echo 'No student is selected. You will be redirected back to <a href="WD34_Exercise35_Tena.php">WD34_Exercise35_Tena</a> after 5 seconds to try again.';
                    //header('location: WD34_Exercise35_Tena.php');
                    echo '<meta http-equiv="refresh" content="5;url=WD34_Exercise35_Tena.php" />';
                } else {
                    $student = $_POST['student'];
                    $mode = $_POST['mode'];
                    if($mode == 'update') {
                        $student_firstname = $_POST['student_firstname'];
                        $student_lastname = $_POST['student_lastname'];
                        $student_batch = $_POST['student_batch'];
                        $sqlCmd = "UPDATE student_tbl SET `student_firstname` = '$student_firstname', `student_lastname` = '$student_lastname', `student_batch` = '$student_batch'  WHERE `student_id` = '$student'";
                        mysqli_query($conn, $sqlCmd);
                        echo mysqli_affected_rows($conn) . ' record(s) updated. You will be redirected back to <a href="WD34_Exercise35_Tena.php">WD34_Exercise35_Tena</a> after 5 seconds...';        
                        //header('location: WD34_Exercise35_Tena.php');
                        echo '<meta http-equiv="refresh" content="5;url=WD34_Exercise35_Tena.php" />';
                    } if($mode == 'delete') {
                        $sqlCmd = "DELETE FROM student_tbl WHERE `student_id` = '$student'";
                        mysqli_query($conn, $sqlCmd);
                        echo mysqli_affected_rows($conn) . ' record(s) removed. You will be redirected back to <a href="WD34_Exercise35_Tena.php">WD34_Exercise35_Tena</a> after 5 seconds...';        
                        //header('location: WD34_Exercise35_Tena.php');
                        echo '<meta http-equiv="refresh" content="5;url=WD34_Exercise35_Tena.php" />';
                    } elseif($mode == 'edit') {
                        ?>
                            <div class="col-4 mb-4">
                                <form method="post">
                                <?php
                                    $sqlCmd = "SELECT * FROM student_tbl WHERE `student_id` = '$student'";
                                    $resource = mysqli_query($conn, $sqlCmd);
                                    if($result = mysqli_fetch_assoc($resource)) {
                                        ?>
                                            <h1 class="text-info">Edit Student</h1>
                                            <input type="hidden" name="student" value="<?php echo $result['student_id']; ?>"/>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <label class="input-group-text rounded-end-0" for="student_firstname">First Name</label>
                                                </div>
                                                <input type="text" name="student_firstname" value="<?php echo $result['student_firstname']; ?>"/>
                                            </div>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <label class="input-group-text rounded-end-0" for="student_lastname">Last Name</label>
                                                </div>
                                                <input type="text" name="student_lastname" value="<?php echo $result['student_lastname']; ?>"/>
                                            </div>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <label class="input-group-text rounded-end-0" for="student_batch">Batch</label>
                                                </div>
                                                <select name="student_batch">
                                                <?php
                                                    $sqlCmd2 = "SELECT batch_id, batch_name FROM batch_tbl";
                                                    $resource2 = mysqli_query($conn, $sqlCmd2);
                                                    while($result2 = mysqli_fetch_assoc($resource2)) {
                                                        $selected = "";
                                                        if($result2['batch_id'] == $result['student_batch']) {
                                                            $selected = " selected";
                                                        }
                                                        echo '<option value="' . $result2['batch_id'] . '"' . $selected . '>' . $result2['batch_name'] . '</option>';
                                                    }
                                                ?>
                                                </select>
                                            </div>
                                        <?php
                                    }
                                    ?>
                                    <div class="input-group mb-2">
                                        <input class="btn btn-success" type="submit" name="mode" value="update" />
                                    </div>
                                </form>
                            </div>
                        <?php
                    }
                }
            ?>
        </div>
    </body>
</html>