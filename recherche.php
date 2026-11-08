
<?php

require_once __DIR__ . '/connexion.php';

$nomRecherche = trim($_GET['nom'] ?? '');

$etudiants = [];

if ($nomRecherche !== '') {

    $sql = "SELECT id, nom, prenom, age, formation, moyenne
            FROM etudiants
            WHERE nom LIKE :nom
            ORDER BY nom, prenom";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        'nom' => '%' . $nomRecherche . '%'
    ]);

    $etudiants = $stmt->fetchAll();
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Rechercher un étudiant</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<h1>Rechercher un étudiant</h1>

<form method="GET">

    <label>Nom à rechercher :</label>

    <input type="text"
           name="nom"
           value="<?= htmlspecialchars($nomRecherche) ?>">

    <button type="submit">Rechercher</button>

</form>

<?php if ($nomRecherche !== ''): ?>

    <?php if (count($etudiants) > 0): ?>

        <h2>Résultats de recherche</h2>

        <table border="1" cellpadding="8">

            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Âge</th>
                <th>Formation</th>
                <th>Moyenne</th>
            </tr>

            <?php foreach ($etudiants as $etudiant): ?>

            <tr>
                <td><?= (int)$etudiant['id'] ?></td>
                <td><?= htmlspecialchars($etudiant['nom']) ?></td>
                <td><?= htmlspecialchars($etudiant['prenom']) ?></td>
                <td><?= (int)$etudiant['age'] ?></td>
                <td><?= htmlspecialchars($etudiant['formation']) ?></td>
                <td><?= htmlspecialchars((string)$etudiant['moyenne']) ?></td>
            </tr>

            <?php endforeach; ?>

        </table>

    <?php else: ?>

        <p>Aucun étudiant trouvé.</p>

    <?php endif; ?>

<?php endif; ?>

<a href="index.php">Accueil</a>

</body>
</html>
