<?php
$user = 'root';
$password = 'root';
$db_name = 'charity_dinner';
$host = 'localhost';
$port = 3306;

$conn = new mysqli($host, $user, $password);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!database_exists($conn)) {
    create_database($conn);
}

if (!table_exists($conn)) {
    create_table($conn);
}

$conn->close();

function create_database($conn) {
    $sql = "CREATE DATABASE " . $db_name;
    if ($conn->query($sql) === TRUE) {
        echo "Database created successfully";
    } else {
        echo "Not successfull: " . $conn->error;
    }
}

function create_table($conn) {
    $sql = "CREATE TABLE users (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(50) NOT NULL,
        email VARCHAR(30) NOT NULL,
        password VARCHAR(50) NOT NULL,
    )";

    if ($conn->query($sql) === TRUE) {
        echo "Table users has been created";
    } else {
        echo "error in making table" . $conn->error;
    }
}

function database_exists($conn) {
        return false;
}

function table_exist($conn) {
        return false;
}
?>
