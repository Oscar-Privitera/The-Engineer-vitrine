<?php
// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire et les échapper
    $question = htmlspecialchars($_POST["question"]);
    $proposition_1 = htmlspecialchars($_POST["proposition_1"]);
    $proposition_2 = htmlspecialchars($_POST["proposition_2"]);
    $proposition_3 = htmlspecialchars($_POST["proposition_3"]);
    $answer = htmlspecialchars($_POST["answer"]);

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
        $sql = "INSERT INTO cards (question, proposition_1, proposition_2, proposition_3, answer) VALUES (:question, :proposition_1, :proposition_2, :proposition_3, :answer)";
        $stmt = $conn->prepare($sql);

        // Liaison des paramètres de la requête
        $stmt->bindParam(':question', $question);
        $stmt->bindParam(':proposition_1', $proposition_1);
        $stmt->bindParam(':proposition_2', $proposition_2);
        $stmt->bindParam(':proposition_3', $proposition_3);
        $stmt->bindParam(':answer', $answer);

        // Exécution de la requête
        $stmt->execute();

        echo "Les données ont été insérées avec succès !";
    } catch (PDOException $e) {
        echo "Erreur lors de l'insertion des données : " . $e->getMessage();
    }

    // Fermer la connexion à la base de données
    $conn = null;
}
