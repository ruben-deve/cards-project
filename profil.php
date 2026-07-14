<?php
require 'config/auth.php';
require 'config/db.php';

// Récupère les infos de l'utilisateur connecté
$stmt = $pdo->prepare("SELECT pseudo, email FROM utilisateurs WHERE id = ?");
$stmt->execute([$_SESSION['utilisateur_id']]);
$utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt = $pdo->prepare("
    SELECT *
    FROM collection
    WHERE utilisateur_id = ?
");

$stmt->execute([
    $_SESSION['utilisateur_id']
]);

$cartes = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon profil - Ma collection de cartes</title>

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

        <!-- informations de l'utilisateur connecté -->
        <section class="infos-profil">
            <h1>Mon Profil</h1>
            <p class="pseudo"><?= htmlspecialchars($utilisateur['pseudo']) ?></p>
            <p class="email"><?= htmlspecialchars($utilisateur['email']) ?></p>
        </section>

        <!-- champ de recherche -->
        <input type="text" id="rechercheInput" placeholder="Rechercher une carte...">

        <!-- liste des cartes possédées par l'utilisateur -->
        <section class="cartes-liste">

            <h2>Mes cartes</h2>

            <!-- boutons de filtre -->
            <div class="filtres-maison">

                <button class="filtre-btn filtre-active" data-race="toutes">
                    Toutes
                </button>

                <?php

                $races = array_unique(
                    array_column($cartes, 'race')
                );

                foreach ($races as $race):

                    if (!empty($race)):
                        ?>

                        <button class="filtre-btn" data-race="<?= strtolower($race) ?>">
                            <?= $race ?>
                        </button>

                        <?php
                    endif;
                endforeach;
                ?>
            </div>

            <?php if (empty($cartes)): ?>
                <p>Vous n'avez aucune carte pour le moment.</p>
            <?php else: ?>

                <?php foreach ($cartes as $carte): ?>

                    <article class="carte" data-race="<?= strtolower($carte['race']) ?>">

                        <a href="carte-details.php?id=<?= $carte['carte_id'] ?>">
                            <img src="<?= $carte['image'] ?>" alt="<?= $carte['nom'] ?>">

                            <h3>
                                <?= $carte['nom'] ?>
                            </h3>

                            <p class="maison">
                                <?= $carte['race'] ?>
                            </p>

                            <p class="acteur">
                                <?= $carte['affiliation'] ?>
                            </p>
                        </a>

                    </article>

                <?php endforeach; ?>

            <?php endif; ?>

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
    <script src="js/favoris.js"></script>
    <script src="js/filtre.js"></script>
    <script src="js/recherche.js"></script>
    <script src="js/modal.js"></script>

</body>

</html>