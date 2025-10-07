<?php
session_start();

// Vérification de la connexion
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

// Récupération des projets (à remplacer par des données réelles)
$projects = [
    [
        'id' => 1,
        'title' => 'Pharma Prunelle',
        'description' => 'Direction du projet qui a permis de placer des logiciels pour faciliter la gestion pharmaceutique.',
        'image' => 'https://via.placeholder.com/500x300',
        'tags' => ['Node.js', 'React.js', 'SQL'],
        'date' => '2023-01-15'
    ],
    [
        'id' => 2,
        'title' => 'Portfolio Startup',
        'description' => 'Directeur du développement de l\'architecture de l\'Application web (portfolio) de la Startup.',
        'image' => 'https://via.placeholder.com/500x300',
        'tags' => ['React.js', 'Tailwind CSS', 'JavaScript'],
        'date' => '2022-11-20'
    ],
    [
        'id' => 3,
        'title' => 'E-commerce Pharma',
        'description' => 'Développement d\'une plateforme e-commerce pour une chaîne de pharmacies.',
        'image' => 'https://via.placeholder.com/500x300',
        'tags' => ['PHP', 'MySQL', 'Bootstrap'],
        'date' => '2022-08-05'
    ]
];

// Traitement du formulaire d'ajout/modification
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
    if ($_POST['action'] === 'add') {
        // Logique d'ajout (à implémenter)
        $success = "Projet ajouté avec succès!";
    } elseif ($_POST['action'] === 'edit' && isset($_POST['project_id'])) {
        // Logique de modification (à implémenter)
        $success = "Projet mis à jour avec succès!";
    }
}

// Traitement de la suppression
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    // Logique de suppression (à implémenter)
    $success = "Projet supprimé avec succès!";
}

// Fonction pour formater la date
function formatDate($date) {
    $timestamp = strtotime($date);
    return date('d/m/Y', $timestamp);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - Gestion des projets</title>
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
            
            <!-- Projects Content -->
            <div class="content-wrapper">
                <div class="page-header">
                    <h1><i class="fas fa-project-diagram"></i> Gestion des projets</h1>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#addProjectModal">
                        <i class="fas fa-plus"></i> Ajouter un projet
                    </button>
                </div>
                
                <?php if (isset($success)): ?>
                <div class="alert alert-success">
                    <?php echo $success; ?>
                </div>
                <?php endif; ?>
                
                <!-- Projects Grid -->
                <div class="projects-grid">
                    <?php foreach ($projects as $project): ?>
                    <div class="project-card">
                        <div class="project-image">
                            <img src="<?php echo $project['image']; ?>" alt="<?php echo $project['title']; ?>">
                            <div class="project-actions">
                                <button class="btn btn-icon btn-light" data-toggle="modal" data-target="#editProjectModal" data-project-id="<?php echo $project['id']; ?>">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <a href="?delete=<?php echo $project['id']; ?>" class="btn btn-icon btn-light" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce projet?')">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </div>
                        </div>
                        <div class="project-content">
                            <h3><?php echo $project['title']; ?></h3>
                            <p class="project-date"><i class="far fa-calendar-alt"></i> <?php echo formatDate($project['date']); ?></p>
                            <p class="project-description"><?php echo $project['description']; ?></p>
                            <div class="project-tags">
                                <?php foreach ($project['tags'] as $tag): ?>
                                <span class="tag"><?php echo $tag; ?></span>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            
            <!-- Footer -->
            <?php include 'includes/footer.php'; ?>
        </main>
    </div>
    
    <!-- Add Project Modal -->
    <div class="modal" id="addProjectModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Ajouter un projet</h3>
                    <button class="modal-close" data-dismiss="modal">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="add">
                        
                        <div class="form-group">
                            <label for="project_title">Titre du projet</label>
                            <input type="text" id="project_title" name="project_title" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="project_description">Description</label>
                            <textarea id="project_description" name="project_description" rows="4" required></textarea>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="project_date">Date</label>
                                <input type="date" id="project_date" name="project_date" required>
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label for="project_tags">Tags (séparés par des virgules)</label>
                                <input type="text" id="project_tags" name="project_tags" placeholder="ex: HTML, CSS, JavaScript">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="project_image">Image</label>
                            <div class="file-upload">
                                <input type="file" id="project_image" name="project_image" accept="image/*" required>
                                <label for="project_image">
                                    <i class="fas fa-upload"></i>
                                    <span>Choisir un fichier</span>
                                </label>
                            </div>
                            <small>Format recommandé: JPG ou PNG, 1200x800px</small>
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
    
    <!-- Edit Project Modal -->
    <div class="modal" id="editProjectModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Modifier un projet</h3>
                    <button class="modal-close" data-dismiss="modal">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="edit">
                        <input type="hidden" name="project_id" id="edit_project_id">
                        
                        <div class="form-group">
                            <label for="edit_project_title">Titre du projet</label>
                            <input type="text" id="edit_project_title" name="project_title" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="edit_project_description">Description</label>
                            <textarea id="edit_project_description" name="project_description" rows="4" required></textarea>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="edit_project_date">Date</label>
                                <input type="date" id="edit_project_date" name="project_date" required>
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label for="edit_project_tags">Tags (séparés par des virgules)</label>
                                <input type="text" id="edit_project_tags" name="project_tags">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label>Image actuelle</label>
                            <div class="current-image">
                                <img id="edit_project_image_preview" src="/placeholder.svg" alt="Image actuelle">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="edit_project_image">Changer l'image</label>
                            <div class="file-upload">
                                <input type="file" id="edit_project_image" name="project_image" accept="image/*">
                                <label for="edit_project_image">
                                    <i class="fas fa-upload"></i>
                                    <span>Choisir un fichier</span>
                                </label>
                            </div>
                            <small>Format recommandé: JPG ou PNG, 1200x800px</small>
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
