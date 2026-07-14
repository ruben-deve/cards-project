<?php require 'config/auth.php';?>

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
        <button class="burger-btn" id="burgerBtn" aria-labell="Ouvrir le menu">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <nav id="mainNav">
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="profil.php">Profil</a></li>
                <li><a href="connexion.php">Connexion</a></li>
                <li><a href="inscription.php">Inscription</a></li>
            </ul>
        </nav>
    </header>

    <!-- contenu principal de la page -->
    <main>

        <!-- informations de l'utilisateur connecté -->
         <section class="infos-profil">
            <h1>Mon Profil</h1>
            <p class="pseudo">Pseudo utilisateur</p>
            <p class="email">email@email.fr</p>
         </section>

         <!-- champ de recherche -->
          <input type="text" id="rechercheInput" placeholder="Rechercher une carte...">

          <!-- liste des cartes possédées par l'utilisateur -->
          <section class="cartes-liste">
            

            <!-- boutons de filtre par maison -->
             <div class="filtres-maison"></div>

             <h2>Mes cartes</h2>

             <!-- api.js -->

          </section>


    </main>

    <!-- pied de page -->
    <footer>
        <p>&copy; 2026 - Projet d'axe Coding; Digital Innovation</p>
    </footer>

    <!-- btn flottant de formulaire d'échange -->
    <button class="flottant-btn" id="ouvrirModal">⇄</button>
    <div class ="modal-overlay" id="modalOverlay">
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