<?php
// Connecting to the database
$pdo = new PDO('mysql:host=localhost;dbname=bridgeconnect', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

// Récupérer les données du formulaire
$data = json_decode(file_get_contents('php://input'), true);

// Vérifier les données requises
if (isset($data['pseudo'], $data['message'], $data['tag'])) {
    $pseudo = $data['pseudo'];
    $message = $data['message'];
    $tag = $data['tag'];

    // Préparation de la requête :
    $stmt = $pdo->prepare("INSERT INTO posts (pseudo, message, tag, date_heure_message) VALUES (?, ?, ?, NOW())");
    // Bind des paramètres :
    $stmt->bindParam(1, $pseudo);
    $stmt->bindParam(2, $message);
    $stmt->bindParam(3, $tag);
    // Exécution de la requête :
    if ($stmt->execute()) {
        $response = ['success' => true, 'message' => 'Post saved successfully'];
    } else {
        $response = ['success' => false, 'message' => 'Failed to save post'];
    }
} else {
    $response = ['success' => false, 'message' => 'Missing required data'];
}

// Retourner la réponse au format JSON
header('Content-Type: application/json');
echo json_encode($response);
