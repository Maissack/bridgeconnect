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

    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-4 col-xl-3 px-sm-2 px-0 bg-dark position-fixed">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start"
                        id="menu">
                        <li class="nav-item">
                            <a href="http://localhost/bridgeconnect/home.php" class="nav-link align-middle px-0">
                                <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Home</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link align-middle px-0">
                                <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Profil</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <button class="btn btn-warning mt-3" data-bs-toggle="modal"
                                data-bs-target="#connectModal">Connect</button>
                        </li>
                    </ul>
                </div>
                
            </div>
            <div class="col-12 col-md-8 col-xl-9 py-3">
                <div class="d-flex justify-content-end mt-3">
                    <form id="search-bar" class="d-flex">
                        <input class="form-control me-2" type="search" name="search"
                            placeholder="Search Bridgeconnect" aria-label="Search">
                        <button class="btn btn-outline-warning" type="submit">Go</button>
                        <?php if (isset($_GET['search'])): ?>
                        <a href="home.php" class="btn btn-outline-warning">Back</a>
                        <?php endif; ?>
                    </form>

                    <form class="btn-group" method="get">
                        <button type="submit" name="sort_newest" class="btn btn-outline-warning">Recent to oldest
                        </button>
                        <button type="submit" name="sort_oldest" class="btn btn-outline-warning">Oldest to recent
                        </button>
                    </form>
                </div>

                <?php
                    // Connecting to the database
                    $pdo = new PDO('mysql:host=localhost;dbname=bridgeconnect', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

                    // Si le formulaire a été posté :
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        // Préparation de la requête :
                        $stmt = $pdo->prepare("INSERT INTO msg (pseudo, message, date_heure_message) VALUES (?, ?, NOW())");
                        // Bind des paramètres :
                        $stmt->bindParam(1, $_POST['pseudo']);
                        $stmt->bindParam(2, $_POST['message']);
                        // Exécution de la requête :
                        $stmt->execute();
                    }

                    // Si une demande de suppression a été envoyée :
                    if (isset($_POST['delete_message_id'])) {
                        // Préparation de la requête :
                        $stmt = $pdo->prepare("DELETE FROM msg WHERE id = ?");
                        // Bind des paramètres :
                        $stmt->bindParam(1, $_POST['delete_message_id']);
                        // Exécution de la requête :
                        $stmt->execute();
                    }

                    // Si une recherche a été effectuée :
                    if (isset($_GET['search'])) {
                        // Préparation de la requête :
                        $stmt = $pdo->prepare("SELECT * FROM msg WHERE message LIKE ?");
                        // Bind des paramètres :
                        $search_term = '%' . $_GET['search'] . '%';
                        $stmt->bindParam(1, $search_term);
                        // Exécution de la requête :
                        $stmt->execute();
                    } else {
                        // Affichage de tous les messages du plus récent au plus ancien :
                        $stmt = $pdo->query("SELECT * FROM msg ORDER BY date_heure_message DESC");
                    }

                    // Si l'un des boutons de tri est cliqué :
                    if (isset($_GET['sort_newest']) || isset($_GET['sort_oldest'])) {
                        // Préparation de la requête :
                        if (isset($_GET['sort_newest'])) {
                            $stmt = $pdo->query("SELECT * FROM msg ORDER BY date_heure_message DESC");
                        } else {
                            $stmt = $pdo->query("SELECT * FROM msg ORDER BY date_heure_message ASC");
                        }
                    }

                    // On affiche les messages :
                    while ($message = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo '<div class="message">';
                        echo '<p class="pseudo">' . $message['pseudo'] . ' : ' . '</p>';
                        echo '<p class="msg_posted">' . $message['message'] . '</p>';
                        echo '<form method="post">';
                        echo '<input type="hidden" name="delete_message_id" value="' . $message['id'] . '">';
                        echo '<button type="submit">Delete</button>';
                        echo '</form>';
                        echo '<p class="meta msg_hour">Posted on ' . date("F j, Y", strtotime($message['date_heure_message'])) . ' at ' . date("H:i", strtotime($message['date_heure_message'])) . '</p>';
                        echo '</div>';
                    }
                ?>

            </div>

        </div>
    </div>

    <div class="modal fade" id="connectModal" tabindex="-1" aria-labelledby="connectModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="connectModalLabel">New BridgePost</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post">
                        <input type="text" name="pseudo" placeholder="Pseudo" required>
                        <textarea name="message" placeholder="Message (280 characters maximum)" required
                            maxlength="280"></textarea>
                        <input type="submit" value="Connect">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>

</body>

</html>
