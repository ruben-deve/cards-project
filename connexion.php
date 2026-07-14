<?php
session_start();
require 'config/db.php';

$erreur = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $motDePasse = $_POST['mdp'];

    $stmt = $pdo->prepare('SELECT id, pseudo, mot_de_passe FROM utilisateurs WHERE email = ?');
    $stmt->execute([$email]);
    $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($utilisateur && password_verify($motDePasse, $utilisateur['mot_de_passe'])) {
        $_SESSION['utilisateur_id'] = $utilisateur['id'];
        $_SESSION['pseudo'] = $utilisateur['pseudo'];

        header('Location: index.php');
        exit;
    } else {
        $erreur = 'Email ou mot de passe incorrect.';
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Ma collection de cartes</title>

    <!-- lien vers la feuille de style -->
    <link rel="stylesheet" href="css/main.css">
</head>

<body>

    <!--en-tête du site : logo + navigation -->
    <header>
        <div class="logo">
            <a href="connexion.php">DragonBall-CardZ</a>
        </div>

        <nav id="mainNav">
            <ul>
                <li><a href="connexion.php">Connexion</a></li>
                <li><a href="inscription.php">Inscription</a></li>
            </ul>
        </nav>
    </header>

    <!-- contenu principal de la page : formulaire de connexion -->
    <main>

        <section class="connexion">
            <h1>Connexion</h1>

            <?php if (!empty($erreur)): ?>
                <p class="erreur"><?= htmlspecialchars($erreur) ?></p>
            <?php endif; ?>

            <form action="connexion.php" method="post">

                <div class="champ">
                    <label for="email">Adresse e-mail</label>
                    <input type="email" id="emailInput" name="email" required>
                </div>

                <div class="champ">
                    <label for="mdp">Mot de passe</label>
                    <input type="password" id="mdp" name="mdp" required>
                </div>

                <button type="submit">Se connecter</button>

            </form>

            <p>Pas encore de compte ? <a href="inscription.php">Inscrivez-vous ici</a></p>
        </section>

    </main>

    <!-- pied de page -->
    <footer>
        <p>&copy; 2026 - Projet d'axe Coding; Digital Innovation</p>
    </footer>

    <script src='js/connexion.js'></script>

</body>

</html>