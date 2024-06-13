<?php

session_start();
require 'connect.php';
// echo 'processing';
// print_r($_POST);

if (isset($_POST['submit'])) {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email = '$email'";
    $dbconn = $connection->query($query);

    if ($dbconn) {
        if ($dbconn->num_rows > 0) {
            $_SESSION['message'] = 'Email already taken. Please use another email address';
            header('location:signup.php');
        } else {
            // print_r($dbconn);

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            // echo $hashedPassword;

            $query = "INSERT INTO users (`fullname`, `email`, `password`) VALUES ('$fullname', '$email', '$hashedPassword')";

            $dbconnection = $connection->query($query);

            if ($dbconnection) {
                // echo dbconnection;
                echo 'Data Inserted:' . $dbconnection;
                $_SESSION['successMessage'] = 'Registeration Successful';
                header('location:signin.php');
            } else {
                echo 'Data not Inserted:' . $dbconnection;
                $_SESSION['errorMessage'] = 'Registeration Unsuccessful';
                header('location:signin.php');
            }
        }
    } else {
        // echo 'Not Selected';
        $_SESSION['message'] = 'Failed to Execute!. Please try again later';
        header('location:signup.php');
    }
} else {
    header('location:signup.php');
}
