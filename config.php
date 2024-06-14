<?php
// config.php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "portfolio";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function createUserSession($username) {
    session_start();
    $_SESSION['username'] = $username;
}

function isAuthenticated() {
    session_start();
    return isset($_SESSION['username']);
}

function logout() {
    session_start();
    session_destroy();
}
?>
