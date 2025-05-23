<?php
session_start();

function validate_login($username, $password) {
    
    $valid_username = "Adiyta";
    $valid_password = "password123";

    if ($username == $valid_username && $password == $valid_password) {
        return true;
    }
    return false;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (validate_login($username, $password)) {
        $_SESSION['authenticated'] = true;
        $_SESSION['username'] = $username;
        header("Location: index.php"); 
        exit();
    } else {
        $_SESSION['login_attempts'] = isset($_SESSION['login_attempts']) ? $_SESSION['login_attempts'] + 1 : 1;
        echo "Invalid login attempt " . $_SESSION['login_attempts'];
    }
}
?>
