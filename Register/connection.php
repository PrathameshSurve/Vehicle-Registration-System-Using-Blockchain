<?php

$con= new mysqli("localhost", 'root', 'password', 'testing');

if(mysqli_connect_error()){
    echo "<script>alert('Cannot connect to the database');</script>";
    exit();
}
?>