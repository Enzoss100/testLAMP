<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

echo "Welcome to your dashboard, " . $_SESSION['username'] . "!";
?>
