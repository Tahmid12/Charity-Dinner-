<?php

require '../config.php';

require 'mysql_queries.php';

$conn = connect_to_db();

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!database_exists($conn)) {
    create_database($conn, $config['db']['name']);
}

default_db($conn);

if (!table_exists($conn)) {
    create_table($conn, $config['tables']['users']);
}

create_event_table($conn);
create_bookings_table($conn);

$conn->close();
?>
