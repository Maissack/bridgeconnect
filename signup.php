<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/component/signup.css">
    <title>Sign up - Bridgeconnect</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <section class="vh-100">
        <div class="container">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-12 col-xl-11">
                    <div class="card text-black">
                        <div class="card-body p-md-5">
                            <div class="row justify-content-center">
                                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
                                    <h1 class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Bridgeconnect - Sign up</h1>
                                    <form method="post" class="mx-1 mx-md-4">
                                        <input type="text" name="nom" placeholder="Username" required class="form-control mb-4">
                                        <input type="text" name="prenom" placeholder="First name" required class="form-control mb-4">
                                        <input type="email" name="email" placeholder="E-mail address" required class="form-control mb-4">
                                        <div class="show-password">
                                            <input type="password" name="mot_de_passe" placeholder="Password (8 characters minimum)" required minlength="8" class="form-control mb-4">
                                            <span class="toggle-password" onclick="togglePassword()"><img src="https://img.icons8.com/ios-filled/24/000000/visible.png"></span>
                                        </div>
                                        <input type="password" name="mot_de_passe_confirmation" placeholder="Confirm password" required class="form-control mb-4">
                                        <?php if(isset($erreur)) { ?>
                                            <span class="error"><?php echo $erreur; ?></span>
                                        <?php } ?>
                                        <div class="form-check mb-4">
                                            <input class="form-check-input" type="checkbox" id="termsCheck" required>
                                            <label class="form-check-label" for="termsCheck">
                                                I accept the terms and conditions
                                            </label>
                                        </div>
                                        <input type="submit" value="Sign up" class="btn btn-primary">
                                    </form>
                                </div>
                                <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
                                    <img src="img/Apple.jpeg" class="img-fluid" alt="Sample image">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="js/toggle_password.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>


<footer class="footer">
    <p>Bridgeconnect © 2023. All rights reserved.</p>
</footer>

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
}
?>
