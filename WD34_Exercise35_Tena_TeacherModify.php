<?php
    include 'WD34_Exercise34_Tena.php';
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Teacher Management</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    </head>
    <body>
        <div class="container-fluid">
            <?php
                if(!isset($_POST['teacher'])) {
                    echo 'No teacher is selected. You will be redirected back to <a href="WD34_Exercise35_Tena.php">WD34_Exercise35_Tena</a> after 5 seconds to try again.';
                    //header('location: WD34_Exercise35_Tena.php');
                    echo '<meta http-equiv="refresh" content="5;url=WD34_Exercise35_Tena.php" />';
                } else {
                    $teacher = $_POST['teacher'];
                    $mode = $_POST['mode'];
                    if($mode == 'update') {
                        $teacher_firstname = $_POST['teacher_firstname'];
                        $teacher_lastname = $_POST['teacher_lastname'];
                        $teacher_position = $_POST['teacher_position'];
                        $teacher_batch = $_POST['teacher_batch'];
                        $sqlCmd = "UPDATE teacher_tbl SET `teacher_firstname` = '$teacher_firstname', `teacher_lastname` = '$teacher_lastname', `teacher_position` = '$teacher_position', `teacher_batch` = '$teacher_batch'  WHERE `teacher_id` = '$teacher'";
                        mysqli_query($conn, $sqlCmd);
                        echo mysqli_affected_rows($conn) . ' record(s) updated. You will be redirected back to <a href="WD34_Exercise35_Tena.php">WD34_Exercise35_Tena</a> after 5 seconds...';        
                        //header('location: WD34_Exercise35_Tena.php');
                        echo '<meta http-equiv="refresh" content="5;url=WD34_Exercise35_Tena.php" />';
                    } if($mode == 'delete') {
                        $sqlCmd = "DELETE FROM teacher_tbl WHERE `teacher_id` = '$teacher'";
                        mysqli_query($conn, $sqlCmd);
                        echo mysqli_affected_rows($conn) . ' record(s) removed. You will be redirected back to <a href="WD34_Exercise35_Tena.php">WD34_Exercise35_Tena</a> after 5 seconds...';        
                        //header('location: WD34_Exercise35_Tena.php');
                        echo '<meta http-equiv="refresh" content="5;url=WD34_Exercise35_Tena.php" />';
                    } elseif($mode == 'edit') {
                        ?>
                            <div class="col-4 mb-4">
                                <form method="post">
                                <?php
                                    $sqlCmd = "SELECT * FROM teacher_tbl WHERE `teacher_id` = '$teacher'";
                                    $resource = mysqli_query($conn, $sqlCmd);
                                    if($result = mysqli_fetch_assoc($resource)) {
                                        ?>
                                            <h1 class="text-info">Edit Teacher</h1>
                                            <input type="hidden" name="teacher" value="<?php echo $result['teacher_id']; ?>"/>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <label class="input-group-text rounded-end-0" for="teacher_firstname">First Name</label>
                                                </div>
                                                <input type="text" name="teacher_firstname" value="<?php echo $result['teacher_firstname']; ?>"/>
                                            </div>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <label class="input-group-text rounded-end-0" for="teacher_lastname">Last Name</label>
                                                </div>
                                                <input type="text" name="teacher_lastname" value="<?php echo $result['teacher_lastname']; ?>"/>
                                            </div>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <label class="input-group-text rounded-end-0" for="teacher_position">Position</label>
                                                </div>
                                                <select name="teacher_position">
                                                <?php 
                                                    if($result['teacher_position'] == "Part-Time") {
                                                        echo '<option selected>Part-Time</option>';
                                                        echo '<option>Full-Time</option>';
                                                    } elseif($result['teacher_position'] == "Full-Time") {
                                                        echo '<option>Part-Time</option>';
                                                        echo '<option selected>Full-Time</option>';
                                                    } 
                                                ?>
                                                </select>
                                            </div>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <label class="input-group-text rounded-end-0" for="teacher_batch">Batch</label>
                                                </div>
                                                <select name="teacher_batch">
                                                <?php
                                                    $sqlCmd2 = "SELECT batch_id, batch_name FROM batch_tbl";
                                                    $resource2 = mysqli_query($conn, $sqlCmd2);
                                                    while($result2 = mysqli_fetch_assoc($resource2)) {
                                                        $selected = "";
                                                        if($result2['batch_id'] == $result['teacher_batch']) {
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