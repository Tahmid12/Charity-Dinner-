<?php

require '../config.php';

$TABLE_USERS = $config['tables']['users'];

function connect_to_db() {
  global $config;
  return new mysqli($config['db']['host'], $config['db']['user'], $config['db']['password']);
}

function default_db($conn) {
  global $config;
  $conn->select_db($config['db']['name']);
}

function get_db() {
  $conn = connect_to_db();
  default_db($conn);
  return $conn;
}

function user_exists($username, $email) {
    return FALSE;
}

function user_exists_p($username, $password) {
  global $TABLE_USERS;
  $conn = get_db();
  $result = $conn->query("SELECT * FROM $TABLE_USERS WHERE username='$username' AND password='$password'");
  if ($result->num_rows) { // Greater than 1 because somehow if duplicates - shouldn't happen though
    return true;
  } {
    return false;
  }
}

function create_user($username, $email, $password) {
    global $config;
    $conn = get_db();

    $table_name = $config['tables']['users'];
    $sql = "INSERT INTO $table_name (username, email, password)
    VALUES ('$username', '$email', '$password')";

    if ($conn->query($sql)) {
        return TRUE;
    } else {
        die("Error: " . $sql . "<br>" . $conn->error);
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
        username VARCHAR(50) PRIMARY KEY,
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
