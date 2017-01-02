<?php

require '../config.php';

function connect_to_db() {
  global $config;
  return new mysqli($config['db']['host'], $config['db']['user'], $config['db']['password']);
}

function default_db($conn) {
  global $config;
  $conn->select_db($config['db']['name']);
}

function user_exists($username, $email) {
    return FALSE;
}

function create_user($username, $email, $password) {
    global $config;
    $conn = connect_to_db();
    default_db($conn);

    $table_name = $config['tables']['users'];
    $sql = "INSERT INTO $table_name (username, email, password)
    VALUES ('$username', '$email', '$password')";

    if ($conn->query($sql)) {
        echo "New record created successfully";
        return TRUE;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        return FALSE;
    }
}

function create_database($conn, $db_name) {
    $sql = "CREATE DATABASE " . $db_name;
    if ($conn->query($sql)) {
        echo "Database created successfully";
    } else {
        echo "Not successful: " . $conn->error;
    }
}

function create_table($conn, $table_name) {
    $sql = "CREATE TABLE $table_name (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL,
        email VARCHAR(30) NOT NULL,
        password VARCHAR(50) NOT NULL
    )";

    if ($conn->query($sql)) {
        echo "Table $table_name has been created";
    } else {
        echo "Error in making table" . $conn->error;
    }
}

function database_exists($conn) {
        return false;
}

function table_exists($conn) {
        return false;
}

?>
