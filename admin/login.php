<?php
session_start();

// Vérification simple des identifiants (à remplacer par une vérification en base de données)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = "admin";
    $password = "admin123"; // À remplacer par un hash sécurisé en production
    
    if ($_POST['username'] === $username && $_POST['password'] === $password) {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        header("Location: index.php");
        exit;
    } else {
        $error = "Identifiants incorrects";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - Connexion</title>
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="login-page">
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <div class="logo">
                    <div class="logo-icon">
                        <span>PM</span>
                    </div>
                    <div class="logo-text">
                        <span class="logo-name">Patrick</span>
                        <span class="logo-surname">Missamu</span>
                    </div>
                </div>
                <h1>Administration</h1>
                <p>Connectez-vous pour gérer votre portfolio</p>
            </div>
            
            <?php if (isset($error)): ?>
                <div class="alert alert-danger">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>
            
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="login-form">
                <div class="form-group">
                    <label for="username">Nom d'utilisateur</label>
                    <div class="input-icon-wrapper">
                        <i class="fas fa-user"></i>
                        <input type="text" id="username" name="username" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <div class="input-icon-wrapper">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="password" name="password" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-full">
                        <i class="fas fa-sign-in-alt"></i> Connexion
                    </button>
                </div>
                
                <div class="form-group text-center">
                    <button type="button" id="themeToggle" class="theme-toggle-btn">
                        <i class="fas fa-sun light-icon"></i>
                        <i class="fas fa-moon dark-icon"></i>
                        <span class="sr-only">Changer de thème</span>
                    </button>
                </div>
            </form>
            
            <div class="login-footer">
                <p>&copy; <?php echo date('Y'); ?> Patrick Missamu. Tous droits réservés.</p>
            </div>
        </div>
    </div>
    
    <script src="js/admin.js"></script>
</body>
</html>
