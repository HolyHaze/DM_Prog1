<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);

    // Vérifier que tous les champs sont remplis
    if (empty($name) || empty($email) || empty($message)) {
        echo "Tous les champs doivent être remplis.";
        exit;
    }

    // Afficher les données
    echo "<h1>Merci pour votre message !</h1>";
    echo "<p><strong>Nom :</strong> " . htmlspecialchars($name) . "</p>";
    echo "<p><strong>Email :</strong> " . htmlspecialchars($email) . "</p>";
    echo "<p><strong>Message :</strong> " . nl2br(htmlspecialchars($message)) . "</p>";

    // Bonus : Envoi des données par email
    $to = "destinataire@example.com"; // Remplacez par l'email de destination
    $subject = "Nouveau message de contact";
    $body = "Nom: $name\nEmail: $email\nMessage: $message";
    $headers = "From: $email";

    // Tentative d'envoi de l'email
    // Si vous voyez une erreur comme "Failed to connect to mailserver at 'localhost' port 25",
    // cela signifie que PHP essaie d'envoyer l'email en utilisant le serveur SMTP par défaut,
    // qui est configuré sur 'localhost' et le port 25. 
    // Pour que cela fonctionne, vous devez vérifier la configuration de votre fichier php.ini :
    // - Assurez-vous que les paramètres 'SMTP' et 'smtp_port' sont correctement configurés.
    // - Par défaut, sur un environnement local comme XAMPP, il se peut que vous deviez 
    //   configurer un serveur SMTP externe (comme Gmail) pour envoyer des emails.
    // - Si la configuration par défaut ne fonctionne pas, envisagez d'utiliser une bibliothèque
    //   comme PHPMailer pour gérer l'envoi d'emails plus facilement.
    if (mail($to, $subject, $body, $headers)) {
        echo "<p>Email envoyé avec succès.</p>";
    } else {
        echo "<p>Erreur lors de l'envoi de l'email. Vérifiez votre configuration SMTP.</p>";
    }
} else {
    echo "Méthode non autorisée.";
}
?>
