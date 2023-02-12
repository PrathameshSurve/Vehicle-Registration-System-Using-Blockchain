<?php

$conn= new mysqli("localhost", 'root', 'password', 'user_data');
if($conn->connect_errno){
    echo json_encode(['status' => $conn->connect_error]);
    exit();
}