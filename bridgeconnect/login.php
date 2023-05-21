<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Login - Bridgeconnect</title>
</head>
<body>
    <script src="js/script.js"></script>
    <h2>Login</h2>

    <form method="post">
        <input type="text" name="nom" placeholder="Nom" required>
        <input type="password" name="mot_de_passe" placeholder="Mot de passe" required>
        <input type="submit" value="Login">
    </form>

<?php
    // Connecting to the database
    $pdo = new PDO('mysql:host=localhost;dbname=bridgeconnect', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['nom'];
        $password = $_POST['mot_de_passe'];

        // Preparing the SQL statement
        $stmt = $pdo->prepare("SELECT * FROM user WHERE nom = ?");
        $stmt->bindParam(1, $username);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if the user exists and the password is correct
        if ($user && password_verify($password, $user['mot_de_passe'])) {
            session_start();
            $_SESSION['user'] = $user['nom'];

            // Redirect to home page
            header('Location: home.php');
            exit;
        } else {
            echo "<p>Invalid username or password.</p>";
        }
    }
?>

</body>
</html>
