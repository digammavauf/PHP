<?php

$config = array(
    'host'=>'localhost',
    'username'=>'root',
    'password'=>'',
    'dbname'=>'kodego_db',
);

$conn = mysqli_connect($config['host'], $config['username'], $config['password'], $config['dbname']);
if(mysqli_connect_errno()) {
    echo("Failed to connect: " . mysqli_connect_error());
    exit();
}

?>