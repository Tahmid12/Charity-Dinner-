<?php

function create_cookie($username) {
  # Call this before any output (or headers)
  setcookie("username", $username, time() + 900000);
}

function is_current_user($username) {
  return isset($_COOKIE["username"]) && $_COOKIE["username"] == $username;
}

?>
