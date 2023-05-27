<?php session_start();

if (isset($_POST['logout'])) {
    // Supprime 'user' de la session
    unset($_SESSION['user']);
    header('Location: http://localhost/bridgeconnect/login.php');
    exit;
}
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Profile - Bridgeconnect</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="blur-effect">
    <div class="container-fluid">

        <!-- La sidebar -->
        <div class="sidebar">
            <a class="active" href="http://localhost/bridgeconnect/home.php">Home</a>
            <a href="http://localhost/bridgeconnect/profile.php">Profile</a>
        </div>


        <!-- Affichage du statut de connexion -->
        <div class="login-status <?php echo (isset($_SESSION['user']) ? 'connected' : 'disconnected'); ?>">
        <?php echo (isset($_SESSION['user']) ? 'Connected as '.$_SESSION['user'] : 'Not connected'); ?>
        </div>

            <div class="col-12 col-md-8 col-xl-9 py-3">

                <div class="title">
                    <h1>Your Bridge Posts</h1>
                </div>

            <!-- Liste des posts personnels-->
                <?php
                    // Connexion à la bdd
                    $pdo = new PDO('mysql:host=localhost;dbname=bridgeconnect', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

                    // Afficher les messages de l'utilisateur
                    $userToShow = $_GET['pseudo'] ?? $_SESSION['user'] ?? null;

                    if($userToShow){
                        $prepaRequest = $pdo->prepare("SELECT * FROM msg WHERE pseudo = ? ORDER BY date_heure_message DESC");
                        $prepaRequest->bindParam(1, $userToShow);
                        $prepaRequest->execute();

                        // On affiche les messages :
                        while ($message = $prepaRequest->fetch(PDO::FETCH_ASSOC)) {
                            echo '<div class="post">';
                            echo '  <div class="post-header">';
                            echo '    <div class="pseudo">' . $message['pseudo'] . '</div>';
                            echo '<p class="msg_date_hour">Posted on ' . date("F j, Y", strtotime($message['date_heure_message'])) . ' at ' . date("H:i", strtotime($message['date_heure_message'])) . '</p>';
                            echo '<p class="msg_tag">#' . $message['tag'] . '</p>';
                            echo '  </div>';
                            echo '  <div class="msg_posted">' . $message['message'] . '</div>';
                            echo '</div>';
                        }
                    }
                ?>
            </div>
        </div>
    </div>
    </div>


    </div>
</div>




<!-- Btn de déconnexion -->
<div class="fixed-bottom text-end m-3">
    <form method="post">
        <button type="submit" name="logout" class="btn btn-danger btn-lg">Disconnect</button>
    </form>
</div>

    

</body>

</html>

