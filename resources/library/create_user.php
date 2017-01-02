<?php

// TODO use isset() to check if these exist
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];

if (!user_exists($username, $email)) {
    $created = create_user($username, $email, $password);
    if (!$created) {
        die("Error: User couldn't be created.");
    }
    echo "User Account Created Successfully";
}

function user_exists($username, $email) {
    return FALSE;
}

function create_user($username, $email, $password) {
    return TRUE;
}

?>
