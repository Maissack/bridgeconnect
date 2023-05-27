<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/component/login.css">
    <title>Login - Bridgeconnect</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container vh-100 d-flex justify-content-center align-items-center" style="background-color: #FFA500;">
        <div class="col-lg-6">
            <form method="post" class="mb-5">

                <h1 class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Bridgeconnect - Sign in</h1>

                <div class="form-outline mb-4">
                    <input type="text" name="identifiant" placeholder="Username or e-mail address" required
                        class="form-control">
                </div>

                <div class="form-outline mb-4">
                    <input type="password" name="mot_de_passe" placeholder="Password" required
                        class="form-control">
                </div>

                <div class="row mb-4 align-items-center">
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="rememberCheck" checked>
                            <label class="form-check-label" for="rememberCheck">Remember me</label>
                        </div>
                    </div>
                    <div class="col">
                        <a href="#!">Forgot password ?</a>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-block mb-4">Sign in</button>
            </form>

            <div class="text-center">
                <p>Not a member yet? <a href="http://localhost/bridgeconnect/signup.php">Sign up</a></p>
            </div>

        </div>
    </div>


    <?php
    // Connexion à la bdd
    $pdo = new PDO('mysql:host=localhost;dbname=bridgeconnect', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $identifiant = $_POST['identifiant'];
        $password = $_POST['mot_de_passe'];

        // Préparation de la requête SQL
        $prepaRequest = $pdo->prepare("SELECT * FROM user WHERE nom = ? OR email = ?");
        $prepaRequest->bindParam(1, $identifiant);
        $prepaRequest->bindParam(2, $identifiant);
        $prepaRequest->execute();

        $user = $prepaRequest->fetch(PDO::FETCH_ASSOC);

        // Si l'user existe et si le mdp est correct
        if ($user && password_verify($password, $user['mot_de_passe'])) {
            session_start();
            $_SESSION['user'] = $user['nom'];

            // Redirection vers la page d'accueil
            header('Location: home.php');
            exit;
        } else {
            echo "<p class='text-center'>Invalid username or password.</p>";
        }
    }
    ?>

<footer class="footer">
    <p>Bridgeconnect © 2023. All rights reserved.</p>
</footer>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="js/script.js"></script>

</body>

</html>
