
<?php

require_once __DIR__ . '/connexion.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
}

if (!$id || $id < 1) {
    exit("Identifiant invalide.");
}

// Rechercher l'étudiant

$sql = "SELECT * FROM etudiants WHERE id = :id";

$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $id]);

$etudiant = $stmt->fetch();

if (!$etudiant) {
    exit("Étudiant introuvable.");
}

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nom = trim($_POST['nom'] ?? '');
    $prenom = trim($_POST['prenom'] ?? '');
    $age = $_POST['age'] ?? '';
    $formation = trim($_POST['formation'] ?? '');
    $moyenne = $_POST['moyenne'] ?? '';

    if ($nom === '' || $prenom === '' || $formation === '') {

        $message = "Tous les champs sont obligatoires.";

    } elseif (filter_var($age, FILTER_VALIDATE_INT) === false || $age < 16) {

        $message = "Âge invalide.";

    } elseif (!is_numeric($moyenne) || $moyenne < 0 || $moyenne > 20) {

        $message = "Moyenne invalide.";

    } else {

        $sql = "UPDATE etudiants
                SET nom = :nom,
                    prenom = :prenom,
                    age = :age,
                    formation = :formation,
                    moyenne = :moyenne
                WHERE id = :id";

        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            'nom' => $nom,
            'prenom' => $prenom,
            'age' => $age,
            'formation' => $formation,
            'moyenne' => $moyenne,
            'id' => $id
        ]);

        $message = "Étudiant modifié avec succès.";

        // Recharger les informations
        $stmt = $pdo->prepare("SELECT * FROM etudiants WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $etudiant = $stmt->fetch();
    }
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Modifier un étudiant</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<h1>Modifier un étudiant</h1>

<p><?= htmlspecialchars($message) ?></p>

<form method="POST">

    <input type="hidden" name="id" value="<?= (int)$etudiant['id'] ?>">

    <label>Nom :</label>
    <input type="text" name="nom"
           value="<?= htmlspecialchars($etudiant['nom']) ?>" required>

    <label>Prénom :</label>
    <input type="text" name="prenom"
           value="<?= htmlspecialchars($etudiant['prenom']) ?>" required>

    <label>Âge :</label>
    <input type="number" name="age" min="16"
           value="<?= (int)$etudiant['age'] ?>" required>

    <label>Formation :</label>
    <input type="text" name="formation"
           value="<?= htmlspecialchars($etudiant['formation']) ?>" required>

    <label>Moyenne :</label>
    <input type="number" name="moyenne" min="0" max="20" step="0.01"
           value="<?= htmlspecialchars((string)$etudiant['moyenne']) ?>"
           required>

    <button type="submit">Enregistrer les modifications</button>

</form>

<a href="liste.php">Retour à la liste</a>

</body>
</html>
