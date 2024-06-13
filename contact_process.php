<?php

session_start();
require 'connect.php';

if (isset($_POST['submit'])) {
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        echo 'User ID: ' . $user_id;

        $query = "SELECT * FROM users WHERE user_id = $user_id";
        $result = $connection->query($query);

        if ($result->num_rows > 0) {
            $userid = $_POST['user_id'];
            $firstname = $_POST['first_name'];
            $lastname = $_POST['last_name'];
            $email = $_POST['email'];
            $phonenumber = $_POST['phone_number'];
            $address = $_POST['address'];

            $query = "INSERT INTO contacts (`user_id`, `firstname`, `lastname`, `email`, `phonenumber`, `address`) VALUES ('$user_id', '$firstname', '$lastname', '$email', '$phonenumber', '$address')";
            $contacts = $connection->query($query);

            if ($contacts) {
                header('location: viewcontacts.php');
                exit();
            } else {
                echo 'Failed to save contact. Please try again!';
            }
        } else {
            echo 'User does not exist.';
            exit();
        }
    } else {
        echo 'User ID not found in session.';
        exit();
    }
}
