# COMPTE RENDU TP 5
## Introduction aux bases de données avec MySQL et PDO

### Activité 1 — Comprendre une base de données relationnelle

**1. Que représente une ligne de cette table ?**

Une ligne représente un étudiant avec toutes ses informations personnelles et scolaires.

**2. Que représente une colonne ?**

Une colonne représente une caractéristique de l'étudiant, comme le nom, le prénom, l'âge, la formation ou la moyenne.

**3. Pourquoi chaque étudiant possède-t-il un identifiant ?**

Chaque étudiant possède un identifiant unique pour le distinguer des autres étudiants et faciliter les opérations sur ses informations.

**4. Pourquoi une base de données peut-elle être plus pratique pour rechercher et modifier des données ?**

Une base de données permet de rechercher, modifier, ajouter et supprimer rapidement des informations grâce aux requêtes SQL.

---

### Activité 2 — Créer la base et la table avec SQL

**1. Pourquoi id est-il une clé primaire ?**

Parce qu'il permet d'identifier chaque étudiant de manière unique et d'éviter les doublons d'identification.

**2. Pourquoi nom est-il déclaré NOT NULL ?**

Parce que le nom est une information obligatoire et ne doit pas être vide ou NULL.

**3. Que signifie AUTO_INCREMENT ?**

AUTO_INCREMENT permet de générer automatiquement un identifiant différent pour chaque nouvel étudiant.

**4. Pourquoi la moyenne n'est-elle pas stockée dans une colonne de type texte ?**

Parce que la moyenne est une valeur numérique qui nécessite des calculs, des comparaisons et des opérations mathématiques.

**5. Que se passe-t-il si l'on tente d'insérer NULL dans une colonne obligatoire ?**

La base de données refuse l'insertion et affiche une erreur, car la colonne est déclarée NOT NULL.

---

### Activité 3 — Insérer des étudiants avec INSERT

**1. Quel est le rôle de INSERT INTO ?**

INSERT INTO permet d'ajouter de nouveaux enregistrements dans une table.

**2. Quel est le rôle de SELECT ?**

SELECT permet de récupérer et d'afficher les données enregistrées dans une table.

**3. À quoi sert la clause WHERE ?**

WHERE permet de filtrer les résultats selon une condition précise.

**4. À quoi sert ORDER BY ?**

ORDER BY permet de trier les résultats selon une ou plusieurs colonnes, dans l'ordre croissant ou décroissant.

**5. Quelle différence existe entre SELECT * et la sélection de colonnes précises ?**

SELECT * affiche toutes les colonnes de la table, tandis que la sélection de colonnes précises affiche uniquement les informations demandées.

---

### Activité 4 — Modifier et supprimer avec SQL

**1. Quel est le rôle de UPDATE ?**

UPDATE permet de modifier les informations d'un ou plusieurs enregistrements dans une table.

**2. Quel est le rôle de DELETE ?**

DELETE permet de supprimer un ou plusieurs enregistrements d'une table.

**3. Pourquoi faut-il vérifier attentivement la clause WHERE ?**

Parce que WHERE permet de cibler les enregistrements concernés. Sans cette clause, UPDATE ou DELETE peut affecter toutes les lignes de la table.

**4. Pourquoi vaut-il mieux utiliser un identifiant plutôt qu'un nom pour modifier un étudiant ?**

Parce que l'identifiant est unique, contrairement au nom qui peut être identique pour plusieurs étudiants. Cela permet de modifier le bon enregistrement.

---

### Activité 5 — Créer la connexion PDO

**1. Quel est le rôle de new PDO(...) ?**

new PDO(...) permet de créer une connexion entre l'application PHP et la base de données MySQL/MariaDB.

**2. À quoi sert require_once ?**

require_once permet d'inclure un fichier PHP une seule fois afin d'éviter les inclusions répétées.

**3. Pourquoi utilise-t-on __DIR__ pour construire le chemin du fichier ?**

__DIR__ retourne le chemin du dossier contenant le fichier PHP actuel. Cela permet de retrouver correctement les fichiers inclus.

**4. Pourquoi ne doit-on pas afficher les détails techniques d'une erreur de connexion aux utilisateurs ?**

Pour protéger les informations sensibles et éviter de révéler des détails sur la configuration et la structure de la base de données.

**5. Pourquoi les identifiants de connexion doivent-ils rester confidentiels ?**

Parce qu'ils permettent d'accéder à la base de données. Leur divulgation peut entraîner un accès non autorisé et la modification ou la suppression des données.

---

### Activité 6 — Lire les étudiants depuis PHP

**1. Quel est le rôle de $pdo->query() ?**

Cette méthode permet d'exécuter une requête SQL directement depuis PHP et de récupérer son résultat.

**2. Que retourne fetchAll() ?**

fetchAll() retourne toutes les lignes récupérées sous forme d'un tableau contenant les résultats de la requête.

**3. Pourquoi utilise-t-on foreach ?**

foreach permet de parcourir chaque étudiant récupéré et d'afficher ses informations dans le tableau HTML.

**4. Pourquoi utilise-t-on htmlspecialchars() lors de l'affichage des chaînes ?**

Cette fonction transforme les caractères spéciaux HTML afin d'éviter l'exécution de code HTML ou JavaScript malveillant et de protéger contre les attaques XSS.

**5. Quelle différence existe entre les
