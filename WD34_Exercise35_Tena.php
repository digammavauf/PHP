<?php
    include 'WD34_Exercise34_Tena.php';
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>KodeGo Database</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-4 mb-4">
                    <h1 class="text-info">Selection of Teachers</h1>
                    <form action="WD34_Exercise35_Tena_TeacherModify.php" method="POST">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <label class="input-group-text rounded-end-0 h-100" for="teacher">Teacher</label>
                            </div>
                            <select class="custom-select w-75" size="6" name="teacher">
                                <?php
                                    $sqlCmd = "SELECT * FROM teacher_tbl";
                                    $resource = mysqli_query($conn, $sqlCmd);
                                    while($result = mysqli_fetch_assoc($resource)) {
                                        echo '<option value="' . $result['teacher_id'] . '">' . $result['teacher_firstname'] . ' ' . $result['teacher_lastname'] . ' (' . $result['teacher_position'] . '; Batch ' . $result['teacher_batch'] . ')</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <input class="btn btn-danger" type="submit" name="mode" value="delete" />
                        <input class="btn btn-warning" type="submit" name="mode" value="edit" />
                    </form>
                </div>
                <div class="col-4 mb-4">
                    <h1 class="text-warning">List of Students</h1>
                    <ul class="list-group">
                        <?php
                            $sqlCmd = "SELECT * FROM student_tbl";
                            $resource = mysqli_query($conn, $sqlCmd);
                            while($result = mysqli_fetch_assoc($resource)) {
                                echo '<li class="list-group-item list-group-item-action list-group-item-warning">'
                                    . '<form class="d-flex justify-content-between" action="WD34_Exercise35_Tena_StudentModify.php" method="POST">'
                                    . '<span>' . $result['student_firstname'] . ' ' . $result['student_lastname'] . ' (Batch ' . $result['student_batch'] . ')</span>'
                                    . '<div>'
                                    . '<input type="hidden" name="student" value="' . $result['student_id'] . '" />'
                                    . '<input class="btn btn-sm btn-danger me-1" type="submit" name="mode" value="delete" />'
                                    . '<input class="btn btn-sm btn-warning" type="submit" name="mode" value="edit" />'
                                    . '</div>'
                                    . '</form>'
                                    . '</li>';
                            }
                        ?>
                    </ul>
                </div>
                <div class="col-4 mb-4">
                    <h1 class="text-success">Table of Batches</h1>
                    <table class="table table-sm table-striped table-bordered table-hover table-success">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Size</th>
                                <th scope="col">Teacher</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $sqlCmd = "SELECT * FROM batch_tbl";
                            $resource = mysqli_query($conn, $sqlCmd);
                            while($result = mysqli_fetch_assoc($resource)) {
                                echo '<tr>'
                                    . '<form action="WD34_Exercise35_Tena_BatchModify.php" method="POST">'
                                    . '<td scope="row">' . $result['batch_name'] . '</td>'
                                    . '<td>' .$result['batch_size'] . '</td>'
                                    . '<td>' .$result['batch_teacher'] . '</td>'
                                    . '<td class="text-center">'
                                    . '<input type="hidden" name="batch" value="' . $result['batch_id'] . '" />'
                                    . '<input class="btn btn-sm btn-danger me-1" type="submit" name="mode" value="delete" />'
                                    . '<input class="btn btn-sm btn-warning" type="submit" name="mode" value="edit" />'
                                    . '</td>'
                                    . '</form>'
                                    . '</tr>';
                            }
                        ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-4 mb-4">
                    <h1 class="text-info">Add Teacher</h1>
                    <form action="WD34_Exercise35_Tena_TeacherInsert.php" method="post">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <label class="input-group-text rounded-end-0" for="teacher_firstname">First Name</label>
                            </div>
                            <input type="text" name="teacher_firstname"/>
                        </div>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <label class="input-group-text rounded-end-0" for="teacher_lastname">Last Name</label>
                            </div>
                            <input type="text" name="teacher_lastname"/>
                        </div>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <label class="input-group-text rounded-end-0" for="teacher_position">Position</label>
                            </div>
                            <select name="teacher_position">
                                <option>Part-Time</option>
                                <option>Full-Time</option>
                            </select>
                        </div>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <label class="input-group-text rounded-end-0" for="teacher_batch">Batch</label>
                            </div>
                            <select name="teacher_batch">
                                <?php
                                    $sqlCmd = "SELECT batch_id, batch_name FROM batch_tbl";
                                    $resource = mysqli_query($conn, $sqlCmd);
                                    while($result = mysqli_fetch_assoc($resource)) {
                                        echo '<option value="' . $result['batch_id'] . '">' . $result['batch_name'] . '</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="input-group mb-2">
                            <button class="btn btn-success" type="submit">add</button>
                        </div>
                    </form>
                </div>
                <div class="col-4 mb-4">
                    <h1 class="text-warning">Add Student</h1>
                    <form action="WD34_Exercise35_Tena_StudentInsert.php" method="post">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <label class="input-group-text rounded-end-0" for="student_firstname">First Name</label>
                            </div>
                            <input type="text" name="student_firstname"/>
                        </div>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <label class="input-group-text rounded-end-0" for="student_lastname">Last Name</label>
                            </div>
                            <input type="text" name="student_lastname"/>
                        </div>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <label class="input-group-text rounded-end-0" for="student_batch">Batch</label>
                            </div>
                            <select name="student_batch">
                                <?php
                                    $sqlCmd = "SELECT batch_id, batch_name FROM batch_tbl";
                                    $resource = mysqli_query($conn, $sqlCmd);
                                    while($result = mysqli_fetch_assoc($resource)) {
                                        echo '<option value="' . $result['batch_id'] . '">' . $result['batch_name'] . '</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="input-group mb-2">
                            <button class="btn btn-success" type="submit">add</button>
                        </div>
                    </form>
                </div>
                <div class="col-4 mb-4">
                    <h1 class="text-success">Add Batch</h1>
                    <form action="WD34_Exercise35_Tena_BatchInsert.php" method="post">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <label class="input-group-text rounded-end-0" for="batch_name">Name</label>
                            </div>
                            <input type="text" name="batch_name"/>
                        </div>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <label class="input-group-text rounded-end-0" for="batch_size">Size</label>
                            </div>
                            <input type="text" name="batch_size"/>
                        </div>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <label class="input-group-text rounded-end-0" for="batch_teacher">Teacher</label>
                            </div>
                            <select name="batch_teacher">
                                <?php
                                    $sqlCmd = "SELECT teacher_id, CONCAT(teacher_firstname, ' ', teacher_lastname) AS teacher_name FROM teacher_tbl";
                                    $resource = mysqli_query($conn, $sqlCmd);
                                    while($result = mysqli_fetch_assoc($resource)) {
                                        echo '<option value="' . $result['teacher_id'] . '">' . $result['teacher_name'] . '</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="input-group mb-2">
                            <button class="btn btn-success" type="submit">add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</html>