<?php

session_start();
require 'connect.php';
echo 'working';

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    $query = "SELECT * FROM contacts WHERE user_id = $user_id";
    $result = $connection->query($query);

    $display = $result->fetch_assoc();
    
    echo $display['first_name'];
    echo $display['last_name'];
    echo $display['phone'];
    echo $display['email'];
    echo $display['address'];

} else {
    header('Location: login.php');
    exit();
}
