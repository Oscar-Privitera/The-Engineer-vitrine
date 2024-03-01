<?php
// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire et les échapper
    $forname = htmlspecialchars($_POST["forname"]);
    $surname = htmlspecialchars($_POST["surname"]);
    $email = htmlspecialchars($_POST["email"]);
    $message_content = htmlspecialchars($_POST["message_content"]);

    // Paramètres de connexion à la base de données
    $servername = "10.56.8.71"; // Adresse du serveur
    $username = "priv0007"; // Nom d'utilisateur de la base de données
    $password = "mT1PLB05Mp"; // Mot de passe de la base de données
    $dbname = "the_engineer"; // Nom de la base de données

    // Connexion à la base de données via PDO
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // Configurer PDO pour signaler les erreurs
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Requête SQL préparée pour insérer les données dans la base de données
        $sql = "INSERT INTO contact_messages (forname, surname, email, message_content, date_msg) VALUES (:forname, :surname, :email, :message_content, :current_date)";
        $stmt = $conn->prepare($sql);

        // Liaison des paramètres de la requête
        $stmt->bindParam(':forname', $forname);
        $stmt->bindParam(':surname', $surname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':message_content', $message_content);
        // Ajout de la date actuelle comme paramètre
        $current_date = date("Y-m-d");
        $stmt->bindParam(':current_date', $current_date);

        // Exécution de la requête
        $stmt->execute();

        echo "Les données ont été insérées avec succès !";
    } catch (PDOException $e) {
        echo "Erreur lors de l'insertion des données : " . $e->getMessage();
    }

    // Fermer la connexion à la base de données
    $conn = null;
}
