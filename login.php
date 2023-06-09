<?php
// Retrieve the form data
$username = $_POST['username'];
$password = $_POST['password'];

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve the submitted username and password

  if ($username == "admin" && $password == "admin") {
    // Successful login, redirect to the secure page or perform other actions
    header('Location: items.php');
    exit;
  } else {
    // Invalid credentials, display an error message
    echo 'Invalid username or password.';
  }
}
?>