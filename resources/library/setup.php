<?php

require '../config.php';

require 'mysql_queries.php';

$conn = new mysqli($config['db']['host'], $config['db']['user'], $config['db']['password']);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!database_exists($conn)) {
    create_database($conn, $config['db']['name']);
}

if (!table_exists($conn)) {
    create_table($conn);
}

$conn->close();
?>
