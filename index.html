<?php session_start();  // Démarre une nouvelle session ?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Home - Bridgeconnect</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    
<div class="blur-effect">
    <div class="container-fluid">
    
            <!-- La sidebar-->
            <div class="sidebar">
                <a class="active" href="http://localhost/bridgeconnect/home.php">Home</a>
                <a href="http://localhost/bridgeconnect/profile.php">Profile</a>
            </div>

        
            <div class="col-12 col-md-8 col-xl-9 py-3">
                <div class="d-flex mt-3">

                    <!-- Barre de recherche de msg -->
                    <form id="search-bar" class="d-flex">
                        <input class="form-control me-2" type="search" name="search" placeholder="Search Bridgeconnect" aria-label="Search">
                        <button class="btn btn-outline-warning" type="submit">Go</button>
                        <?php if (isset($_GET['search'])): ?>
                        <a href="home.php" class="btn btn-outline-warning">Back</a>
                        <?php endif; ?>
                    </form>

                    <!-- Bouton 'connect' en bas à droite (ouvrir modal de post) -->
                    <div class="mt-auto">
                        <button id="connect_btn" class="btn btn-warning mt-3" data-bs-toggle="modal"
                            data-bs-target="#connectModal">Connect</button>
                    </div>

                    <!-- Boutons de tris de msg (seulement dans 'All') -->
                    <form class="btn-tri" method="get">
                        <button type="submit" name="sort_newest" class="btn btn-outline-warning">Recent to oldest</button>
                        <button type="submit" name="sort_oldest" class="btn btn-outline-warning">Oldest to recent</button>
                    </form>
                </div>

                
            <!-- Liste des tags en haut de page-->
                <div class="tags">
                    <span class="tag" data-tag="all">All</span>
                    <span class="tag" data-tag="Nature">Nature</span>
                    <span class="tag" data-tag="Mode">Mode</span>
                    <span class="tag" data-tag="Food">Food</span>
                    <span class="tag" data-tag="Travel">Travel</span>
                    <span class="tag" data-tag="Beauty">Beauty</span>
                    <span class="tag" data-tag="Sport">Sport</span>
                    <span class="tag" data-tag="Tech">Tech</span>
                    <span class="tag" data-tag="Music">Music</span>
                    <span class="tag" data-tag="Photography">Photography</span>
                    <span class="tag" data-tag="Art">Art</span>
                </div>


                <?php
                // Connexion à la bdd
                    $pdo = new PDO('mysql:host=localhost;dbname=bridgeconnect', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

                // Si formulaire posté :
                    if (isset($_POST['message_send'])) {
                        
                        // Vérifier si c'est une image et si sa taille est inférieure à 2 Mo :
                        if (isset($_FILES['post_image']) && $_FILES['post_image']['size'] <= 2 * 1024 * 1024) { 
                            $repertoire_upload = 'uploads/'; 
                            $chemin_fichier_telecharge = $repertoire_upload . basename($_FILES['post_image']['name']);
                            if (move_uploaded_file($_FILES['post_image']['tmp_name'], $chemin_fichier_telecharge)) {
                            } else {
                                echo 'Erreur lors du téléchargement du fichier.';
                            }
                        } else {
                            echo 'Le fichier doit être inférieur à 2Mo.';
                        }
                        
                        // Prépa + exécution de la requête :
                        $prepaRequest = $pdo->prepare("INSERT INTO msg (pseudo, message, tag, date_heure_message) VALUES (?, ?, ?, NOW())");
                        $prepaRequest->bindParam(1, $_POST['pseudo']);
                        $prepaRequest->bindParam(2, $_POST['message']);
                        $prepaRequest->bindParam(3, $_POST['tag']);
                        $prepaRequest->execute();
                        }

                        // Si demande de suppression envoyée :
                        if (isset($_POST['delete_message_id'])) {
                            $prepaRequest = $pdo->prepare("DELETE FROM msg WHERE id = ?");
                            $prepaRequest->bindParam(1, $_POST['delete_message_id']);
                            $prepaRequest->execute();
                        }

                        // Si recherche effectuée :
                        if (isset($_GET['search'])) {
                            $prepaRequest = $pdo->prepare("SELECT * FROM msg WHERE message LIKE ?");
                            $search_term = '%' . $_GET['search'] . '%';
                            $prepaRequest->bindParam(1, $search_term);
                            $prepaRequest->execute();
                        } else {
                            // Affichage de tous les msg du plus récent au plus ancien (seulement dans 'All'):
                            $prepaRequest = $pdo->query("SELECT * FROM msg ORDER BY date_heure_message DESC");
                        }

                        // Si l'un des boutons de tri est cliqué :
                        if (isset($_GET['sort_newest']) || isset($_GET['sort_oldest'])) {
                            if (isset($_GET['sort_newest'])) {
                                $prepaRequest = $pdo->query("SELECT * FROM msg ORDER BY date_heure_message DESC");
                            } else {
                                $prepaRequest = $pdo->query("SELECT * FROM msg ORDER BY date_heure_message ASC");
                            }
                        }

                        // Affichage des msg :
                        while ($message = $prepaRequest->fetch(PDO::FETCH_ASSOC)) {
                            echo '<div class="post ' . $message['tag'] . '" data-tag="' . $message['tag'] . '">';  // Ajouter le tag en tant que classe
                            echo '<div class="post-header">';
                            echo '<p class="pseudo">' . $message['pseudo'] . '</p>';
                            echo '<p class="msg_tag">#' . $message['tag'] . '</p>';
                            echo '</div>';
                            echo '<p class="msg_posted">' . $message['message'] . '</p>';

                            // Afficher le btn de suppression uniquement pour les msg de l'user connecté
                            if (isset($_SESSION['user']) && $_SESSION['user'] === $message['pseudo']) {
                                echo '<form method="post">';
                                echo '<input type="hidden" name="delete_message_id" value="' . $message['id'] . '">';
                                echo '<button class="delete_btn_post" type="submit">Delete</button>';
                                echo '</form>';
                            }

                            echo '<p class="msg_date_hour">Posted on ' . date("F j, Y", strtotime($message['date_heure_message'])) . ' at ' . date("H:i", strtotime($message['date_heure_message'])) . '</p>';
                            echo '</div>';
                            }
                ?>
            </div>
        </div>
    </div>
</div> <!-- div du blur effect -->
    
    
<!-- Si l'user est co alors renvoie 'true' sinon renvoie 'false' -->
<?php
echo '<script>';
echo 'var userIsLogged = ';
echo (isset($_SESSION['user'])) ? 'true' : 'false';
echo ';</script>';
?>

<!-- Si l'user n'est pas co, un modal s'affiche pour lui demander de se co -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="loginModalLabel">Warning</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span> <!-- Croix de fermeture -->       
        </button>
      </div>
      <div class="modal-body">Please log in or register to use Bridgeconnect.</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="location.href='login.php'">Login</button>
        <button type="button" class="btn btn-secondary" onclick="location.href='signup.php'">Sign Up</button>
      </div>
    </div>
  </div>
</div>



<!-- Ouverture de la popup de post + ses fonctionnalités -->
<div class="modal fade" id="connectModal" tabindex="-1" aria-labelledby="connectModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="connectModalLabel">New BridgePost</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="confirmCloseModal(event)"></button>
            </div>
            <div class="modal-body">
                <form id="postForm" method="post" enctype="multipart/form-data">
                <input type="text" name="pseudo" placeholder="Pseudo" value="<?php echo isset($_SESSION['user']) ? $_SESSION['user'] : ''; ?>" readonly required> <!-- readonly empêche l'user de changer son pseudo -->

                    <textarea name="message" placeholder="Message (280 characters maximum)" required maxlength="280"></textarea>
                    <select name="tag" required>
                        <option disabled selected>Sélectionner un tag</option>
                        <option value="Nature">Nature</option>
                        <option value="Mode">Mode</option>
                        <option value="Food">Food</option>
                        <option value="Travel">Travel</option>
                        <option value="Beauty">Beauty</option>
                        <option value="Sport">Sport</option>
                        <option value="Tech">Tech</option>
                        <option value="Music">Music</option>
                        <option value="Photography">Photography</option>
                        <option value="Art">Art</option>
                    </select>
                    <button id="connect_btn_modal" type="submit" name="message_send">Connect</button>
                    <input type="file" name="post_image" accept="image/png, image/jpeg, image/gif" required> 
                </form>
            </div>
        </div>
    </div>
</div>
    
    

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="js/script.js"></script>
<script src="js/modal_post.js"></script>
<script src="js/taglist.js"></script>
<script src="js/modal_signup-in.js"></script>

    
</body>

</html>
