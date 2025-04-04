<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Connect to the SQLite database
    $pdo = new PDO('sqlite:database/app.db');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Collect and sanitize input data
    $username = $_POST['username'];
    $code = $_POST['code'];

    // Prepare and execute the query to check the user credentials
    $stmt = $pdo->prepare('SELECT * FROM users WHERE username = :username AND code = :code');
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':code', $code);
    $stmt->execute();

    // Check if the user exists
    if ($stmt->rowCount() == 1) {
        // Valid login, redirect to the dashboard
        $_SESSION['username'] = $username;
        header('Location: dashboard.php');
        exit;
    } else {
        // Invalid login
        $error = 'Invalid username or code';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>

    <?php if (isset($error)): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <form action="login.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>

        <label for="code">Code:</label>
        <input type="password" id="code" name="code" required><br><br>

        <button type="submit">Login</button>
    </form>
</body>
</html>
