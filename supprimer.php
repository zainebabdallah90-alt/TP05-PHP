
<?php

require_once __DIR__ . '/connexion.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit("Méthode non autorisée.");
}

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

if (!$id || $id < 1) {
    exit("Identifiant invalide.");
}

$sql = "DELETE FROM etudiants WHERE id = :id";

$stmt = $pdo->prepare($sql);

$stmt->execute(['id' => $id]);

if ($stmt->rowCount() > 0) {

    echo "Étudiant supprimé avec succès.";

} else {

    echo "Aucun étudiant trouvé avec cet identifiant.";

}

?>

<br>

<a href="liste.php">Retour à la liste</a>
