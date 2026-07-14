<?php
session_start();
require 'config/db.php';

$erreur = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pseudo = trim($_POST['pseudo']);
    $email = trim($_POST['email']);
    $motDePasse = $_POST['mdp'];
    $confirmation = $_POST['mdp_confirm'];

    if (empty($pseudo) || empty($email) || empty($motDePasse) || empty($confirmation)) {
        $erreur = 'Tous les champs sont obligatoires.';
    } elseif ($motDePasse !== $confirmation) {
        $erreur = 'Les mots de passe ne correspondent pas.';
    } elseif (strlen($motDePasse) < 6) {
        $erreur = 'Le mot de passe doit contenir au moins 6 caractères.';
    } else {
        $stmt = $pdo->prepare('SELECT id FROM utilisateurs WHERE email = ? OR pseudo = ?');
        $stmt->execute([$email, $pseudo]);

        if ($stmt->fetch()) {
            $erreur = 'Ce pseudo ou cet email est déjà utilisé.';
        } else {
            $hash = password_hash($motDePasse, PASSWORD_DEFAULT);

            $stmt = $pdo->prepare('INSERT INTO utilisateurs (pseudo, email, mot_de_passe) VALUES (?, ?, ?)');
            $stmt->execute([$pseudo, $email, $hash]);

            $_SESSION['utilisateur_id'] = $pdo->lastInsertId();
            $_SESSION['pseudo'] = $pseudo;

            header('Location: index.html');
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Ma collection de cartes</title>

    <!-- lien vers la feuille de style -->
    <link rel="stylesheet" href="css/main.css">
</head>

<body>

    <!--en-tête du site : logo + navigation -->
    <header>
        <div class="logo">
            <a href="inscription.php">DragonBall-CardZ</a>
        </div>

        <nav id="mainNav">
            <ul>
                <li><a href="connexion.php">Connexion</a></li>
                <li><a href="inscription.php">Inscription</a></li>
            </ul>
        </nav>
    </header>

    <!-- contenu principal de la page : formulaire d'inscription -->
    <main>

        <section class="inscription">
            <h1>Créer un compte</h1>

            <?php if (!empty($erreur)): ?>
                <p class="erreur"><?= htmlspecialchars($erreur) ?></p>
            <?php endif; ?>

            <form action="inscription.php" method="post">

                <div class="champ">
                    <label for="pseudo">Pseudo</label>
                    <input type="text" id="pseudo" name="pseudo" required>
                </div>

                <div class="champ">
                    <label for="email">Adresse e-mail</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="champ">
                    <label for="mdp">Mot de passe</label>
                    <input type="password" id="mdp" name="mdp" required>
                </div>

                <div class="champ">
                    <label for="mdp-confirm">Confirmer le mot de passe</label>
                    <input type="password" id="mdp-confirm" name="mdp_confirm" required>
                </div>

                <button type="submit">S'inscrire</button>

            </form>

            <p>Déjà un compte ? <a href="connexion.php">Connectez-vous ici</a></p>
        </section>
        
    </main>

    <!-- pied de page -->
    <footer>
        <p>&copy; 2026 - Projet d'axe Coding; Digital Innovation</p>
    </footer>

</body>

</html>