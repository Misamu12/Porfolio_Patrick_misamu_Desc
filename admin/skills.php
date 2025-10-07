<?php
session_start();

// Vérification de la connexion
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

// Récupération des compétences (à remplacer par des données réelles)
$skills = [
    [
        'id' => 1,
        'name' => 'HTML/CSS',
        'level' => 90,
        'logo' => 'images/html-css.png'
    ],
    [
        'id' => 2,
        'name' => 'Bootstrap',
        'level' => 85,
        'logo' => 'images/bootstrap.png'
    ],
    [
        'id' => 3,
        'name' => 'JavaScript',
        'level' => 85,
        'logo' => 'images/javascript.png'
    ],
    [
        'id' => 4,
        'name' => 'React.js',
        'level' => 80,
        'logo' => 'images/react.png'
    ],
    [
        'id' => 5,
        'name' => 'Node.js',
        'level' => 75,
        'logo' => 'images/nodejs.png'
    ],
    [
        'id' => 6,
        'name' => 'React Native',
        'level' => 70,
        'logo' => 'images/react-native.png'
    ],
    [
        'id' => 7,
        'name' => 'PHP',
        'level' => 75,
        'logo' => 'images/php.png'
    ],
    [
        'id' => 8,
        'name' => 'SQL',
        'level' => 80,
        'logo' => 'images/sql.png'
    ]
];

// Traitement du formulaire d'ajout/modification
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
    if ($_POST['action'] === 'add') {
        // Logique d'ajout (à implémenter)
        $success = "Compétence ajoutée avec succès!";
    } elseif ($_POST['action'] === 'edit' && isset($_POST['skill_id'])) {
        // Logique de modification (à implémenter)
        $success = "Compétence mise à jour avec succès!";
    }
}

// Traitement de la suppression
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    // Logique de suppression (à implémenter)
    $success = "Compétence supprimée avec succès!";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - Gestion des compétences</title>
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="admin-container">
        <!-- Sidebar -->
        <?php include 'includes/sidebar.php'; ?>
        
        <!-- Main Content -->
        <main class="main-content">
            <!-- Top Bar -->
            <?php include 'includes/topbar.php'; ?>
            
            <!-- Skills Content -->
            <div class="content-wrapper">
                <div class="page-header">
                    <h1><i class="fas fa-chart-bar"></i> Gestion des compétences</h1>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#addSkillModal">
                        <i class="fas fa-plus"></i> Ajouter une compétence
                    </button>
                </div>
                
                <?php if (isset($success)): ?>
                <div class="alert alert-success">
                    <?php echo $success; ?>
                </div>
                <?php endif; ?>
                
                <!-- Skills Table -->
                <div class="card">
                    <div class="card-header">
                        <h2>Liste des compétences</h2>
                        <div class="card-actions">
                            <div class="search-box">
                                <input type="text" id="skillSearch" placeholder="Rechercher...">
                                <i class="fas fa-search"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Logo</th>
                                        <th>Nom</th>
                                        <th>Niveau</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($skills as $skill): ?>
                                    <tr>
                                        <td>
                                            <div class="skill-logo">
                                                <img src="../<?php echo $skill['logo']; ?>" alt="<?php echo $skill['name']; ?>">
                                            </div>
                                        </td>
                                        <td><?php echo $skill['name']; ?></td>
                                        <td>
                                            <div class="skill-level-wrapper">
                                                <div class="skill-level-bar">
                                                    <div class="skill-level-progress" style="width: <?php echo $skill['level']; ?>%"></div>
                                                </div>
                                                <span class="skill-level-value"><?php echo $skill['level']; ?>%</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="table-actions">
                                                <button class="btn btn-sm btn-icon btn-info" data-toggle="modal" data-target="#editSkillModal" data-skill-id="<?php echo $skill['id']; ?>" data-skill-name="<?php echo $skill['name']; ?>" data-skill-level="<?php echo $skill['level']; ?>" data-skill-logo="<?php echo $skill['logo']; ?>">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <a href="?delete=<?php echo $skill['id']; ?>" class="btn btn-sm btn-icon btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette compétence?')">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Footer -->
            <?php include 'includes/footer.php'; ?>
        </main>
    </div>
    
    <!-- Add Skill Modal -->
    <div class="modal" id="addSkillModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Ajouter une compétence</h3>
                    <button class="modal-close" data-dismiss="modal">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="add">
                        
                        <div class="form-group">
                            <label for="skill_name">Nom de la compétence</label>
                            <input type="text" id="skill_name" name="skill_name" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="skill_level">Niveau (en %)</label>
                            <input type="range" id="skill_level" name="skill_level" min="0" max="100" value="50" oninput="this.nextElementSibling.value = this.value">
                            <output  oninput="this.nextElementSibling.value = this.value">
                            <output>50</output>
                        </div>
                        
                        <div class="form-group">
                            <label for="skill_logo">Logo</label>
                            <div class="file-upload">
                                <input type="file" id="skill_logo" name="skill_logo" accept="image/*">
                                <label for="skill_logo">
                                    <i class="fas fa-upload"></i>
                                    <span>Choisir un fichier</span>
                                </label>
                            </div>
                            <small>Format recommandé: PNG, 64x64px</small>
                        </div>
                        
                        <div class="form-actions">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-primary">Ajouter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Edit Skill Modal -->
    <div class="modal" id="editSkillModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Modifier une compétence</h3>
                    <button class="modal-close" data-dismiss="modal">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="edit">
                        <input type="hidden" name="skill_id" id="edit_skill_id">
                        
                        <div class="form-group">
                            <label for="edit_skill_name">Nom de la compétence</label>
                            <input type="text" id="edit_skill_name" name="skill_name" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="edit_skill_level">Niveau (en %)</label>
                            <input type="range" id="edit_skill_level" name="skill_level" min="0" max="100" oninput="this.nextElementSibling.value = this.value">
                            <output id="edit_skill_level_output">50</output>
                        </div>
                        
                        <div class="form-group">
                            <label>Logo actuel</label>
                            <div class="current-logo">
                                <img id="edit_skill_logo_preview" src="/placeholder.svg" alt="Logo actuel">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="edit_skill_logo">Changer le logo</label>
                            <div class="file-upload">
                                <input type="file" id="edit_skill_logo" name="skill_logo" accept="image/*">
                                <label for="edit_skill_logo">
                                    <i class="fas fa-upload"></i>
                                    <span>Choisir un fichier</span>
                                </label>
                            </div>
                            <small>Format recommandé: PNG, 64x64px</small>
                        </div>
                        
                        <div class="form-actions">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script src="js/admin.js"></script>
</body>
</html>
