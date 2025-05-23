<?php
session_start();


if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] == true) {
    header("Location: index.php"); 
    exit();
}


if (isset($_SESSION['login_attempts'])) {
    $attempts = $_SESSION['login_attempts'];
} else {
    $attempts = 0;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $valid_username = "Adiyta"; 
    $valid_password = "password123"; 

    // Get user input
    $input_username = $_POST['username'];
    $input_password = $_POST['password'];

    
    if ($input_username == $valid_username && $input_password == $valid_password) {
        $_SESSION['authenticated'] = true;
        $_SESSION['username'] = $input_username;
        header("Location: index.php"); 
        exit();
    } else {
        $_SESSION['login_attempts'] = ++$attempts;
        echo "<p style='color: red;'>Invalid credentials. Attempt #$attempts.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 50px; }
        .container { max-width: 400px; margin: auto; background-color: white; padding: 20px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); }
        h1 { text-align: center; color: #333; }
        input[type="text"], input[type="password"] { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ddd; border-radius: 5px; }
        input[type="submit"] { width: 100%; padding: 10px; background-color: #4CAF50; color: white; border: none; border-radius: 5px; cursor: pointer; }
        input[type="submit"]:hover { background-color: #45a049; }
    </style>
</head>
<body>

    <div class="container">
        <h1>Login</h1>
        <form action="login.php" method="post">
            <label for="username">Username:</label>
            <input type="text" name="username" required><br>
            <label for="password">Password:</label>
            <input type="password" name="password" required><br>
            <input type="submit" value="Login">
        </form>
    </div>

</body>
</html>
