<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Sign up - Bridgeconnect</title>
</head>
<body>
<script src="js/script.js"></script>
</body>
</html>


<?php
// Je me connecte à la base de données :
$pdo = new PDO('mysql:host=localhost;dbname=bridgeconnect', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

// Si le formulaire a été posté :
if($_POST) {
    // Vérification que les deux mots de passe sont identiques
    if($_POST['mot_de_passe'] != $_POST['mot_de_passe_confirmation']) {
        echo "Les mots de passe ne correspondent pas.";
    } else {
        // Préparation de la requête d'insertion :
        $stmt = $pdo->prepare("INSERT INTO user (nom, prenom, email, mot_de_passe) VALUES (?, ?, ?, ?)");

        // Bind des paramètres :
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT);
        $photo = $_POST['photo'];
        $stmt->bindParam(1, $nom);
        $stmt->bindParam(2, $prenom);
        $stmt->bindParam(3, $email);
        $stmt->bindParam(4, $mot_de_passe);

        // Exécution de la requête :
        $stmt->execute();

        // Redirection vers la page home.php :
        header('Location: login.php');
        exit;
    }
} else {
    ?>


<form method="post">
    <input type="text" name="nom" placeholder="Nom" required>
    <input type="text" name="prenom" placeholder="Prénom" required>
    <input type="email" name="email" placeholder="E-mail" required>
    <div class="show-password">
        <input type="password" name="mot_de_passe" placeholder="Mot de passe (8 caractères mini)" required minlength="8">
        <span class="toggle-password" onclick="togglePassword()"><img src="https://img.icons8.com/ios-filled/24/000000/visible.png" /></span>
    </div>
    <input type="password" name="mot_de_passe_confirmation" placeholder="Confirmation du mot de passe" required>
    <?php if(isset($erreur)) { ?>
        <span class="error"><?php echo $erreur; ?></span>
    <?php } ?>
    <input type="submit" value="S'inscrire"> 
</form>
    
    <?php
}
?>
