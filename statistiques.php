
<?php

require_once __DIR__ . '/connexion.php';

$sql = "SELECT
        COUNT(*) AS nombre_etudiants,
        AVG(moyenne) AS moyenne_classe,
        MAX(moyenne) AS meilleure_moyenne,
        MIN(moyenne) AS plus_faible_moyenne
        FROM etudiants";

$stmt = $pdo->query($sql);

$stats = $stmt->fetch();

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Statistiques</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<h1>Statistiques de la classe</h1>

<p>
Nombre total d'étudiants :
<?= $stats['nombre_etudiants'] ?>
</p>

<p>
Moyenne de la classe :
<?= round((float)$stats['moyenne_classe'], 2) ?>
</p>

<p>
Meilleure moyenne :
<?= $stats['meilleure_moyenne'] ?>
</p>

<p>
Plus faible moyenne :
<?= $stats['plus_faible_moyenne'] ?>
</p>

<a href="index.php">Accueil</a>

</body>
</html>
