<?php
// Chemin vers le fichier JSON
$json_file = 'utilisateurs.json';

// Fonction pour lire les utilisateurs depuis le fichier JSON
function lireUtilisateurs($file) {
    $data = file_get_contents($file);
    return json_decode($data, true);
}

// Fonction pour écrire les utilisateurs dans le fichier JSON
function ecrireUtilisateurs($file, $data) {
    file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));
}

// Traitement du formulaire d'ajout d'utilisateur
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajouter'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];

    // Lire les utilisateurs existants
    $utilisateurs = lireUtilisateurs($json_file);
    
    // Ajouter le nouvel utilisateur
    $utilisateurs[] = [
        'nom' => $nom,
        'prenom' => $prenom,
        'email' => $email
    ];

    // Écrire les nouvelles données dans le fichier JSON
    ecrireUtilisateurs($json_file, $utilisateurs);
}

// Traitement du formulaire de suppression d'utilisateur
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['supprimer'])) {
    $emailASupprimer = $_POST['email_supprimer'];

    // Lire les utilisateurs existants
    $utilisateurs = lireUtilisateurs($json_file);

    // Filtrer les utilisateurs pour supprimer celui avec l'email donné
    $utilisateurs = array_filter($utilisateurs, function($utilisateur) use ($emailASupprimer) {
        return $utilisateur['email'] !== $emailASupprimer;
    });

    // Réindexer les utilisateurs
    $utilisateurs = array_values($utilisateurs);

    // Écrire les nouvelles données dans le fichier JSON
    ecrireUtilisateurs($json_file, $utilisateurs);
}

// Lire les utilisateurs pour afficher
$utilisateurs = lireUtilisateurs($json_file);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Utilisateurs</title>
    <link rel="stylesheet" href="style.css"> <!-- Lien vers le fichier CSS -->
</head>
<body>
    <h1>Gestion des Utilisateurs</h1>

    <h2>Liste des Utilisateurs</h2>
    <table>
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
        </tr>
        <?php foreach ($utilisateurs as $utilisateur): ?>
            <tr>
                <td><?= htmlspecialchars($utilisateur['nom']) ?></td>
                <td><?= htmlspecialchars($utilisateur['prenom']) ?></td>
                <td><?= htmlspecialchars($utilisateur['email']) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h2>Ajouter un Utilisateur</h2>
    <form method="POST">
        <label for="nom">Nom:</label>
        <input type="text" id="nom" name="nom" required>
        <label for="prenom">Prénom:</label>
        <input type="text" id="prenom" name="prenom" required>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <button type="submit" name="ajouter">Ajouter</button>
    </form>

    <h2>Supprimer un Utilisateur</h2>
    <form method="POST">
        <label for="email_supprimer">Email de l'utilisateur à supprimer:</label>
        <input type="email" id="email_supprimer" name="email_supprimer" required>
        <button type="submit" name="supprimer">Supprimer</button>
    </form>
</body>
</html>
