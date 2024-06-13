<?php

session_start();
require 'connect.php';

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = $connection->query($query);

    if ($result) {
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $hashedPassword = $user['password'];

            if (password_verify($password, $hashedPassword)) {
                $_SESSION['user_id'];
                header('location: dashboard.php');
            } else {
                $_SESSION['errorMessage'] = 'Invalid Credentials';
            }
        } else {
            $_SESSION['errorMessage'] = 'Invalid Credentials';
        }
    } else {
        echo 'Query Not Executed';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Log In</title>
</head>

<body class="flex flex-col items-center h-screen justify-center">
    <div class="mb-1">
        <?php
        if (isset($_SESSION['errorMessage'])) {
            echo '<div class="text-red-500 text-3x1 font-bold uppercase">' . $_SESSION['errorMessage'] . '</div>';
            unset($_SESSION['errorMessage']);
        }
        ?>
    </div>

    <div class="w-full max-w-md bg-gray-800 rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-bold text-center text-gray-200 mb-4">Welcome</h2>
        <form class="flex flex-col" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <!-- <input class="bg-gray-700 text-gray-200 border-0 rounded-md p-2 mb-4 focus:bg-gray-600 focus:outline-none focus:ring-1 focus:ring-blue-500 transition ease-in-out duration-150" type="text" name="username" id="" placeholder="Username"> -->
            <input class="bg-gray-700 text-gray-200 border-0 rounded-md p-2 mb-4 focus:bg-gray-600 focus:outline-none focus:ring-1 focus:ring-blue-500 transition ease-in-out duration-150" type="email" name="email" id="" placeholder="Email" required>
            <input class="bg-gray-700 text-gray-200 border-0 rounded-md p-2 mb-4 focus:bg-gray-600 focus:outline-none focus:ring-1 focus:ring-blue-500 transition ease-in-out duration-150" type="password" name="password" id="" placeholder="Password" required>
            <p class="text-white">
                Don't have an account?
                <a class="text-lg font-bold text-blue-500 -200 hover:underline mt-4" href="signup.php">Sign Up</a>
            </p>
            <button class="bg-gradient-to-r from-indigo-500 to-blue-500 text-white font-bold py-2 px-4 rounded-md mt-4 hover:bg-indigo-600 hover:to-blue-600 transition ease-in-out duration-150" type="submit" name="submit">
                Sign In
            </button>
        </form>
    </div>
</body>

</html>