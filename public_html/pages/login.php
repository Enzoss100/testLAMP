<?php
// Show all errors (dev mode)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

// Handle POST login
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'] ?? '';
    $code = $_POST['code'] ?? '';

    try {
        // Absolute path to your database
        $pdo = new PDO('sqlite:../database/app.db');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepared statement
        $stmt = $pdo->prepare('SELECT * FROM users WHERE username = :username AND code = :code');
        $stmt->execute([
            ':username' => $username,
            ':code' => $code
        ]);

        // If user exists, go to dashboard
        if ($stmt->fetch()) {
            $_SESSION['username'] = $username;
            header('Location: dashboard.php');
            exit;
        } else {
            $error = "Invalid username or code";
        }

    } catch (PDOException $e) {
        die("Database error: " . $e->getMessage());
    }
}
?>

<!-- Simple HTML Form -->
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

    <form method="POST" action="login.php">
        <label>Username:</label>
        <input type="text" name="username" required><br><br>

        <label>Code:</label>
        <input type="password" name="code" required><br><br>

        <input type="submit" value="Login">
    </form>
</body>
</html>
