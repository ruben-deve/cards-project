<?php
require 'config/auth.php';
require 'config/db.php';

$messageBooster = "";
$cartesGagnees = [];

if (isset($_POST['ouvrir_booster'])) {

    $userId = $_SESSION['utilisateur_id'];

    // vérifie les 24h
    $stmt = $pdo->prepare("
        SELECT date_ouverture 
        FROM ouvertures_booster
        WHERE utilisateur_id = ?
        ORDER BY date_ouverture DESC
        LIMIT 1
    ");

    $stmt->execute([$userId]);
    $derniereOuverture = $stmt->fetch();

    if ($derniereOuverture) {
        $dateDerniere = strtotime($derniereOuverture['date_ouverture']);
        $maintenant = time();

        if (($maintenant - $dateDerniere) < 86400) {
            $messageBooster = "Vous devez attendre 24h avant d'ouvrir un nouveau booster.";
        } else {
            ouvrirBooster();
        }
    } else {
        ouvrirBooster();
    }
}


function ouvrirBooster()
{
    global $pdo, $userId, $messageBooster, $cartesGagnees;

    // appel api
    $json = file_get_contents("https://dragonball-api.com/api/characters");
    $data = json_decode($json, true);
    $personnages = $data['items'];
    shuffle($personnages);
    $cartesGagnees = array_slice($personnages, 0, 5);

    // stock la collection
    $stmt = $pdo->prepare("
    INSERT INTO collection
    (
        utilisateur_id,
        carte_id,
        nom,
        image,
        race,
        affiliation,
        description
    )
    VALUES (?, ?, ?, ?, ?, ?, ?)
");


foreach ($cartesGagnees as $carte) {

    $stmt->execute([
        $userId,
        $carte['id'],
        $carte['name'],
        $carte['image'],
        $carte['race'],
        $carte['affiliation'],
        $carte['description']
    ]);
}
    // enregistre l'ouverture
    $stmt = $pdo->prepare("
        INSERT INTO ouvertures_booster(utilisateur_id)
        VALUES (?)
    ");

    $stmt->execute([$userId]);
    $messageBooster = "🎉 Booster ouvert !";
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage - Ma collection de cartes</title>

    <!-- lien vers la feuille de style -->
    <link rel="stylesheet" href="css/main.css">
</head>

<body>

    <!--en-tête du site : logo + navigation -->
    <header>
        <div class="logo">
            <a href="index.php">DragonBall-CardZ</a>
        </div>

        <!-- bouton hamburger, visible sur mobile -->
        <button class="burger-btn" id="burgerBtn" aria-label="Ouvrir le menu">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <nav id="mainNav">
            <ul>
                <li><a href="index.php">Accueil</a></li>

                <?php if (isset($_SESSION['utilisateur_id'])): ?>

                    <li><a href="profil.php">Profil</a></li>
                    <li><a href="">Déconnexion</a></li>

                <?php else: ?>

                    <li><a href="connexion.php">Connexion</a></li>
                    <li><a href="inscription.php">Inscription</a></li>

                <?php endif; ?>

            </ul>
        </nav>
    </header>

    <!-- contenu principal de la page -->
    <main>

        <!-- section titre de la page -->
        <section class="intro">
            <h1>Découvrez toutes les cartes</h1>
            <p>Ouvrez des boosters et complétez votre collection !</p>
            <form method="POST">
                <button type="submit" name="ouvrir_booster">Ouvrir un booster</button>
            </form>
            <p>
                <?= $messageBooster ?>
            </p>
        </section>

        <!-- champ de recherche -->
        <input type="text" id="rechercheInput" placeholder="Rechercher une carte...">

        <!-- section cartes disponibles -->
        <section class="cartes-liste">

            <!-- boutons de filtre par maison -->
            <div class="filtres-maison"></div>

            <h2>Liste des cartes</h2>

            <!-- api.js -->

        </section>
    </main>

    <!-- pied de page -->
    <footer>
        <p>&copy; 2026 - Projet d'axe Coding; Digital Innovation</p>
    </footer>

    <!-- btn flottant de formulaire d'échange -->
    <button class="flottant-btn" id="ouvrirModal">⇄</button>
    <div class="modal-overlay" id="modalOverlay">
        <div class="modal">
            <button class="modal-close" id="fermerModal">✕</button>
            <h2>Échanger une carte</h2>
            <form id="formEchange">
                <label for="destinataire">Échanger avec :</label>
                <input type="text" id="destinataire" placeholder="Pseudo utilisateur">

                <label for="carteAEchanger">Carte à donner :</label>
                <select id="carteAEchanger">
                    <option>Nom de la carte</option>
                </select>

                <button type="submit">Valider l'échange</button>
            </form>
        </div>
    </div>

    <!-- ajout des fichiers js -->
    <script src="js/nav.js"></script>
    <script src="js/api.js"></script>
    <script src="js/favoris.js"></script>
    <script src="js/filtre.js"></script>
    <script src="js/recherche.js"></script>
    <script src="js/modal.js"></script>

</body>

</html>