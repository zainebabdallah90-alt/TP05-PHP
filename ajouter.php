
<?php

require_once __DIR__ . '/connexion.php';

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nom = trim($_POST['nom'] ?? '');
    $prenom = trim($_POST['prenom'] ?? '');
    $age = $_POST['age'] ?? '';
    $formation = trim($_POST['formation'] ?? '');
    $moyenne = $_POST['moyenne'] ?? '';

    if ($nom === '' || $prenom === '' || $formation === '') {

        $message = "Tous les champs textuels sont obligatoires.";

    } elseif (filter_var($age, FILTER_VALIDATE_INT) === false || $age < 16) {

        $message = "L'âge doit être un entier supérieur ou égal à 16.";

    } elseif (!is_numeric($moyenne) || $moyenne < 0 || $moyenne > 20) {

        $message = "La moyenne doit être comprise entre 0 et 20.";

    } else {

        try {

            $sql = "INSERT INTO etudiants
                    (nom, prenom, age, formation, moyenne)
                    VALUES
                    (:nom, :prenom, :age, :formation, :moyenne)";

            $stmt = $pdo->prepare($sql);

            $stmt->execute([
                'nom' => $nom,
                'prenom' => $prenom,
                'age' => $age,
                'formation' => $formation,
                'moyenne' => $moyenne
            ]);

            $message = "Étudiant ajouté avec succès.";

        } catch (PDOException $e) {

            $message = "Une erreur est survenue lors de l'ajout.";

        }
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un étudiant</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<h1>Ajouter un étudiant</h1>

<p><?= htmlspecialchars($message) ?></p>

<form method="POST">

    <label>Nom :</label>
    <input type="text" name="nom" required>

    <label>Prénom :</label>
    <input type="text" name="prenom" required>

    <label>Âge :</label>
    <input type="number" name="age" min="16" required>

    <label>Formation :</label>
    <input type="text" name="formation" required>

    <label>Moyenne :</label>
    <input type="number" name="moyenne"
           min="0" max="20" step="0.01" required>

    <button type="submit">Ajouter</button>

</form>

<a href="liste.php">Voir la liste des étudiants</a>

</body>
</html>
