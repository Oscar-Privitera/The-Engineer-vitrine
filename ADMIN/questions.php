<?php

// Paramètres de connexion à la base de données
$servername = "10.56.8.71"; // Adresse du serveur
$username = "priv0007"; // Nom d'utilisateur de la base de données
$password = "mT1PLB05Mp"; // Mot de passe de la base de données
$dbname = "the_engineer"; // Nom de la base de données

// Création de la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

// Requête pour récupérer les données de la table contact_messages
$sql = "SELECT id_card, question, proposition_1, proposition_2, proposition_3, answer FROM cards";
$result = $conn->query($sql);

// Variable pour compter les messages
$messageCount = 1;
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/styles.css" />
    <title>Contacts - The Engineer</title>
</head>

<body>
    <div class="bg-circle-blur-container">
        <div class="bg-circle-blur bg-circle-one"></div>
        <div class="bg-circle-blur bg-circle-two"></div>
        <div class="bg-circle-blur bg-circle-three"></div>
    </div>
    <div class="blur-cover">
        <header>
            <div class="header--container-logo-name">
                <div class="header--container-logo">
                    <div class="logo--part-left"></div>
                    <div class="logo--part-right"></div>
                </div>
                <p class="header--name-game">The Engineer</p>
            </div>
            <nav>
                <a href="./admin.php">Messages</a>
                <a href="./questions.html">Questions</a>
            </nav>
            <div class="header--container-play-btn">
                <p class="header--play-btn">Jouer !</p>
            </div>
        </header>
        <div class="index-hero-banner">
            <p class="index--welcome-msg">Bienvenue dans la partie admin !</p>
            <h2 class="index--lets-go-msg">Questions enregistrées</h2>
            <h1 class="index--title-game-name">Questions</h1>
        </div>
        <div class="admin-container-all-message">
            <div class="questions-container">
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="admin-card-msg">';
                        echo '<div class="admin-card-msg--header">';
                        echo '<p class="admin-card-msg--label">Question</p>';
                        echo '</div>';
                        echo '<p class="admin-card-msg--content-msg">' . $row['question'] . '</p>';
                        echo '<div class="admin-card-msg--footer">';
                        echo '</p>';
                        echo '<p class="admin-card-msg--count-msg">N°' . $messageCount++ . '</p>';
                        echo '</div>';
                        echo '<p>Réponses possibles</p>';
                        echo '<p>Choix numéro 1 : ' . $row['proposition_1'] . '</p>';
                        echo '<p>Choix numéro 2 : ' . $row['proposition_2'] . '</p>';
                        echo '<p>Choix numéro 3 : ' . $row['proposition_3'] . '</p>';
                        echo '<p>Réponse : ' . $row['answer'] . '</p>';
                        echo '<button>Supprimer</button>';
                        echo '<img src="../ASSETS/fingerprint.png" alt="Image empreinte digitale" class="admin-card-msg--bg-icon" />';
                        echo '</div>';
                    }
                } else {
                    echo "<p>Pas de message</p>";
                }
                ?>
            </div>
        </div>

        <footer>
            <div class="footer--container-all-category-link">
                <div class="footer--container-link-usefull">
                    <div class="footer--container-title-polygon">
                        <img src="../ASSETS/triangle.png" class="footer--social-icons" alt="Triangle" />
                        <h4 class="footer--title">Liens utiles</h4>
                    </div>
                    <div class="footer--body-link">
                        <img src="../ASSETS/triangle-orange.png" class="footer--triangle-icons" alt="Triangle" />
                        <p class="footer--link-label">Mentions légales</p>
                    </div>
                    <div class="footer--body-link">
                        <img src="../ASSETS/triangle-orange.png" class="footer--triangle-icons" alt="Triangle" />
                        <p class="footer--link-label">À propos</p>
                    </div>
                </div>
                <div class="footer--container-link-social-network">
                    <div class="footer--container-title-polygon">
                        <img src="../ASSETS/triangle.png" class="footer--social-icons" alt="Triangle" />
                        <h4 class="footer--title">Réseaux sociaux</h4>
                    </div>
                    <div class="footer--body-link">
                        <img src="../ASSETS/discord.png" class="footer--social-icons" alt="Icône de Discord" />
                        <p class="footer--link-label">Discord</p>
                    </div>
                    <div class="footer--body-link">
                        <img src="../ASSETS/x.png" class="footer--social-icons" alt="Icône de X ( Anciennement Twitter )" />
                        <p class="footer--link-label">X ( Twitter )</p>
                    </div>
                    <div class="footer--body-link">
                        <img src="../ASSETS/linkedin.png" class="footer--social-icons" alt="Icône de LinkedIn" />
                        <p class="footer--link-label">LinkedIn</p>
                    </div>
                </div>
            </div>
            <p class="footer--copyright">Copyright 2023 Tout droits réservés | <span class="footer--copyright--span">The
                    Enginner</span></p>
        </footer>
    </div>
</body>

</html>

<?php
// Fermeture de la connexion à la base de données
$conn->close();
?>