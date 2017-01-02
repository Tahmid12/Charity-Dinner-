<?php

require '../config.php';

function user_exists($username, $email) {
    return FALSE;
}

function create_user($username, $email, $password) {
    return TRUE;
}

function create_database($conn, $db_name) {
    $sql = "CREATE DATABASE " . $db_name;
    if ($conn->query($sql)) {
        echo "Database created successfully";
    } else {
        echo "Not successfull: " . $conn->error;
    }
}

function create_table($conn, $db_name) {
    $sql = "CREATE TABLE users (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(50) NOT NULL,
        email VARCHAR(30) NOT NULL,
        password VARCHAR(50) NOT NULL,
    )";

    if ($conn->query($sql)) {
        echo "Table users has been created";
    } else {
        echo "Error in making table" . $conn->error;
    }
}

function database_exists($conn) {
        return false;
}

function table_exist($conn) {
        return false;
}

?>
