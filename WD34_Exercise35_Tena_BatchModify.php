<?php
    include 'WD34_Exercise34_Tena.php';
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Batch Management</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    </head>
    <body>
        <div class="container-fluid">
            <?php
                if(!isset($_POST['batch'])) {
                    echo 'No batch is selected. You will be redirected back to <a href="WD34_Exercise35_Tena.php">WD34_Exercise35_Tena</a> after 5 seconds to try again.';
                    //header('location: WD34_Exercise35_Tena.php');
                    echo '<meta http-equiv="refresh" content="5;url=WD34_Exercise35_Tena.php" />';
                } else {
                    $batch = $_POST['batch'];
                    $mode = $_POST['mode'];
                    if($mode == 'update') {
                        $batch_name = $_POST['batch_name'];
                        $batch_size = $_POST['batch_size'];
                        $batch_teacher = $_POST['batch_teacher'];
                        $sqlCmd = "UPDATE batch_tbl SET `batch_name` = '$batch_name', `batch_size` = '$batch_size', `batch_teacher` = '$batch_teacher'  WHERE `batch_id` = '$batch'";
                        mysqli_query($conn, $sqlCmd);
                        echo mysqli_affected_rows($conn) . ' record(s) updated. You will be redirected back to <a href="WD34_Exercise35_Tena.php">WD34_Exercise35_Tena</a> after 5 seconds...';        
                        //header('location: WD34_Exercise35_Tena.php');
                        echo '<meta http-equiv="refresh" content="5;url=WD34_Exercise35_Tena.php" />';
                    } if($mode == 'delete') {
                        $sqlCmd = "DELETE FROM batch_tbl WHERE `batch_id` = '$batch'";
                        mysqli_query($conn, $sqlCmd);
                        echo mysqli_affected_rows($conn) . ' record(s) removed. You will be redirected back to <a href="WD34_Exercise35_Tena.php">WD34_Exercise35_Tena</a> after 5 seconds...';        
                        //header('location: WD34_Exercise35_Tena.php');
                        echo '<meta http-equiv="refresh" content="5;url=WD34_Exercise35_Tena.php" />';
                    } elseif($mode == 'edit') {
                        ?>
                            <div class="col-4 mb-4">
                                <form method="post">
                                <?php
                                    $sqlCmd = "SELECT * FROM batch_tbl WHERE `batch_id` = '$batch'";
                                    $resource = mysqli_query($conn, $sqlCmd);
                                    if($result = mysqli_fetch_assoc($resource)) {
                                        ?>
                                            <h1 class="text-info">Edit Batch</h1>
                                            <input type="hidden" name="batch" value="<?php echo $result['batch_id']; ?>"/>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <label class="input-group-text rounded-end-0" for="batch_name">First Name</label>
                                                </div>
                                                <input type="text" name="batch_name" value="<?php echo $result['batch_name']; ?>"/>
                                            </div>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <label class="input-group-text rounded-end-0" for="batch_size">Last Name</label>
                                                </div>
                                                <input type="text" name="batch_size" value="<?php echo $result['batch_size']; ?>"/>
                                            </div>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <label class="input-group-text rounded-end-0" for="batch_teacher">Batch</label>
                                                </div>
                                                <select name="batch_teacher">
                                                <?php
                                                    $sqlCmd2 = "SELECT teacher_id, CONCAT(teacher_firstname, ' ', teacher_lastname) AS teacher_name FROM teacher_tbl";
                                                    $resource2 = mysqli_query($conn, $sqlCmd2);
                                                    while($result2 = mysqli_fetch_assoc($resource2)) {
                                                        $selected = "";
                                                        if($result2['teacher_id'] == $result['batch_teacher']) {
                                                            $selected = " selected";
                                                        }
                                                        echo '<option value="' . $result2['teacher_id'] . '"' . $selected . '>' . $result2['teacher_name'] . '</option>';
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