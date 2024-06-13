<?php
$host = 'localhost';
$dbusername = 'root';
$dbpassword = '';
$dbname = 'php_test';

$connection = new mysqli($host, $dbusername, $dbpassword, $dbname);

if ($connection->connect_error) {
    $logMessage = date('d-m-Y H:i:s') . " - Error connecting to MySQL database: " . $connection->connect_error . PHP_EOL;
} else {
    $logMessage = date('d-m-Y H:i:s') . " - MySQL Database Connected Successfully" . PHP_EOL;
}

$logFile = 'db_connection_log.txt';
file_put_contents($logFile, $logMessage, FILE_APPEND);
