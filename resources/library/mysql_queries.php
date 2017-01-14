<?php

require '../config.php';

$TABLE_USERS = $config['tables']['users'];
$TABLE_EVENTS = 'events';
$TABLE_BOOKINGS = 'bookings';

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

// *** EVENT QUERIES ***

function create_event_table($conn) {
    global $TABLE_EVENTS;
    $sql = "CREATE TABLE $TABLE_EVENTS (
      id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
      user_host VARCHAR(50) NOT NULL,
      name VARCHAR(50) NOT NULL,
      description VARCHAR(30),
      location VARCHAR(50) NOT NULL,
      event_date TIMESTAMP NOT NULL,
      category VARCHAR(50),
      num_tickets_available VARCHAR(50) NOT NULL,
      ticket_end_date TIMESTAMP NOT NULL,
    )";

    if ($conn->query($sql)) {
        echo "Table $TABLE_EVENTS has been created";
    } else {
        echo "Error in making table" . $conn->error;
    }
}

function create_event($username, $event_details) {
  global $TABLE_EVENTS;
  $sql = "INSERT INTO $TABLE_EVENTS (
    user_host,
    name,
    description,
    location,
    event_date,
    category,
    num_tickets_available,
    ticket_end_date
  ) VALUES ($username,
    $event_details[name],
    $event_details[description],
    $event_details[location],
    $event_details[event_date],
    $event_details[category],
    $event_details[num_tickets_available],
    $event_details[ticket_end_date]
  )";

  get_db()->query($sql);
}

function create_bookings_table($conn) {
  global $TABLE_BOOKINGS;
  $sql = "CREATE TABLE $TABLE_BOOKINGS (
    username VARCHAR(50) NOT NULL,
    event_id INT(6) UNSIGNED NOT NULL,
  )";

  if ($conn->query($sql)) {
      echo "Table $TABLE_BOOKINGS has been created";
  } else {
      echo "Error in making table" . $conn->error;
  }
}

function register_for_event($username, $event_id) {
  global $TABLE_BOOKINGS;
  $sql = "INSERT INTO $TABLE_BOOKINGS (
    username,
    event_id
  ) VALUES (
    $username,
    $event_id
  )";

  get_db()->query($sql);
}

function get_all_events() {
  global $TABLE_EVENTS;
  $sql = "SELECT * FROM $TABLE_EVENTS";
  $result = get_db()->query($sql);
  while ($r = $result->fetch_object()) {
        $events[] = create_event_from_row($r);
  }
  $result->close();
  return $events;
}

// *** END EVENT QUERIES ***

// Queries for task 3+
function find_all_events($category) {
  global $TABLE_EVENTS;
  $sql = "SELECT * FROM $TABLE_EVENTS WHERE category = '$category'";
  $result = get_db()->query($sql);
  while ($r = $result->fetch_object()) {
    $events[] = create_event_from_row($r);
  }
  $result->close();
  return $events;
}

function find_events_with($start_timestamp, $end_timestamp) {
  global $TABLE_EVENTS;
  $sql = "SELECT * FROM $TABLE_EVENTS WHERE event_date
    BETWEEN FROM_UNIXTIME($start_timestamp) AND FROM_UNIXTIME($end_timestamp)"; // TODO test
  $result = get_db()->query($sql);
  while ($r = $result->fetch_object()) {
    $events[] = create_event_from_row($r);
  }
  $result->close();
  return $events;
}
// End: 3

function create_event_from_row($r) {
  return Array(
    'host' => $r['user_host'],
    'name' => $r['name'],
    'description' => $r['description'],
    'location' => $r['location'],
    'event_date' => $r['event_date'],
    'category' => $r['category'],
    'num_tickets_available' => $r['num_tickets_available'],
    'ticket_end_date' => $r['ticket_end_date']);
}

?>
