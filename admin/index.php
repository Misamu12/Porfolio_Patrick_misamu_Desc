<?php
session_start();

// Vérification de la connexion
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

// Récupération des statistiques (à remplacer par des données réelles)
$stats = [
    'projects' => 50,
    'clients' => 100,
    'experience' => 10,
    'awards' => 5
];

// Récupération des derniers messages (à remplacer par des données réelles)
$messages = [
    [
        'id' => 1,
        'name' => 'Jean Dupont',
        'email' => 'jean.dupont@example.com',
        'subject' => 'Demande de collaboration',
        'message' => 'Bonjour Patrick, je souhaiterais discuter d\'une possible collaboration sur un projet web...',
        'date' => '2023-04-15 14:30:00',
        'read' => true
    ],
    [
        'id' => 2,
        'name' => 'Marie Martin',
        'email' => 'marie.martin@example.com',
        'subject' => 'Question technique',
        'message' => 'Bonjour, j\'aurais besoin de votre expertise concernant un problème de développement React...',
        'date' => '2023-04-14 09:15:00',
        'read' => false
    ],
    [
        'id' => 3,
        'name' => 'Pierre Lefebvre',
        'email' => 'pierre.lefebvre@example.com',
        'subject' => 'Opportunité d\'emploi',
        'message' => 'Nous recherchons un chef de projet technique pour notre startup et votre profil nous intéresse...',
        'date' => '2023-04-13 16:45:00',
        'read' => false
    ]
];

// Récupération des dernières activités (à remplacer par des données réelles)
$activities = [
    [
        'type' => 'project',
        'action' => 'Ajout du projet "E-commerce Pharma"',
        'date' => '2023-04-15 10:30:00'
    ],
    [
        'type' => 'skill',
        'action' => 'Mise à jour de la compétence "React.js" (85%)',
        'date' => '2023-04-14 14:20:00'
    ],
    [
        'type' => 'profile',
        'action' => 'Modification de la description du profil',
        'date' => '2023-04-13 09:45:00'
    ],
    [
        'type' => 'message',
        'action' => 'Réponse au message de Jean Dupont',
        'date' => '2023-04-12 16:30:00'
    ]
];

// Fonction pour formater la date
function formatDate($date) {
    $timestamp = strtotime($date);
    return date('d/m/Y à H:i', $timestamp);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - Tableau de bord</title>
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
            
            <!-- Dashboard Content -->
            <div class="dashboard">
                <div class="page-header">
                    <h1><i class="fas fa-tachometer-alt"></i> Tableau de bord</h1>
                    <p>Bienvenue dans votre espace d'administration</p>
                </div>
                
                <!-- Stats Cards -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon bg-primary">
                            <i class="fas fa-code"></i>
                        </div>
                        <div class="stat-details">
                            <h3>Projets</h3>
                            <p class="stat-value"><?php echo $stats['projects']; ?></p>
                        </div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-icon bg-success">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-details">
                            <h3>Clients</h3>
                            <p class="stat-value"><?php echo $stats['clients']; ?></p>
                        </div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-icon bg-info">
                            <i class="fas fa-briefcase"></i>
                        </div>
                        <div class="stat-details">
                            <h3>Années d'expérience</h3>
                            <p class="stat-value"><?php echo $stats['experience']; ?></p>
                        </div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-icon bg-warning">
                            <i class="fas fa-award"></i>
                        </div>
                        <div class="stat-details">
                            <h3>Récompenses</h3>
                            <p class="stat-value"><?php echo $stats['awards']; ?></p>
                        </div>
                    </div>
                </div>
                
                <!-- Dashboard Widgets -->
                <div class="dashboard-widgets">
                    <!-- Recent Messages -->
                    <div class="widget">
                        <div class="widget-header">
                            <h2><i class="fas fa-envelope"></i> Messages récents</h2>
                            <a href="messages.php" class="btn btn-sm btn-outline">Voir tous <i class="fas fa-arrow-right"></i></a>
                        </div>
                        <div class="widget-content">
                            <div class="messages-list">
                                <?php foreach ($messages as $message): ?>
                                <div class="message-item <?php echo $message['read'] ? '' : 'unread'; ?>">
                                    <div class="message-avatar">
                                        <span><?php echo substr($message['name'], 0, 1); ?></span>
                                    </div>
                                    <div class="message-content">
                                        <div class="message-header">
                                            <h4><?php echo $message['name']; ?></h4>
                                            <span class="message-date"><?php echo formatDate($message['date']); ?></span>
                                        </div>
                                        <p class="message-subject"><?php echo $message['subject']; ?></p>
                                        <p class="message-preview"><?php echo substr($message['message'], 0, 80) . '...'; ?></p>
                                    </div>
                                    <div class="message-actions">
                                        <a href="message-view.php?id=<?php echo $message['id']; ?>" class="btn btn-sm btn-icon" title="Voir le message">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-icon" title="Supprimer" data-action="delete" data-id="<?php echo $message['id']; ?>">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Recent Activity -->
                    <div class="widget">
                        <div class="widget-header">
                            <h2><i class="fas fa-history"></i> Activités récentes</h2>
                        </div>
                        <div class="widget-content">
                            <div class="activity-list">
                                <?php foreach ($activities as $activity): ?>
                                <div class="activity-item">
                                    <div class="activity-icon 
                                        <?php 
                                        switch($activity['type']) {
                                            case 'project': echo 'bg-primary'; break;
                                            case 'skill': echo 'bg-success'; break;
                                            case 'profile': echo 'bg-info'; break;
                                            case 'message': echo 'bg-warning'; break;
                                            default: echo 'bg-secondary';
                                        }
                                        ?>">
                                        <i class="fas 
                                            <?php 
                                            switch($activity['type']) {
                                                case 'project': echo 'fa-code'; break;
                                                case 'skill': echo 'fa-chart-bar'; break;
                                                case 'profile': echo 'fa-user'; break;
                                                case 'message': echo 'fa-envelope'; break;
                                                default: echo 'fa-check';
                                            }
                                            ?>"></i>
                                    </div>
                                    <div class="activity-content">
                                        <p><?php echo $activity['action']; ?></p>
                                        <span class="activity-date"><?php echo formatDate($activity['date']); ?></span>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Quick Actions -->
                <div class="quick-actions">
                    <div class="widget-header">
                        <h2><i class="fas fa-bolt"></i> Actions rapides</h2>
                    </div>
                    <div class="actions-grid">
                        <a href="profile.php" class="action-card">
                            <div class="action-icon bg-primary">
                                <i class="fas fa-user-edit"></i>
                            </div>
                            <h3>Modifier le profil</h3>
                        </a>
                        
                        <a href="skills.php" class="action-card">
                            <div class="action-icon bg-success">
                                <i class="fas fa-chart-bar"></i>
                            </div>
                            <h3>Gérer les compétences</h3>
                        </a>
                        
                        <a href="projects.php" class="action-card">
                            <div class="action-icon bg-info">
                                <i class="fas fa-project-diagram"></i>
                            </div>
                            <h3>Gérer les projets</h3>
                        </a>
                        
                        <a href="settings.php" class="action-card">
                            <div class="action-icon bg-warning">
                                <i class="fas fa-cog"></i>
                            </div>
                            <h3>Paramètres</h3>
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Footer -->
            <?php include 'includes/footer.php'; ?>
        </main>
    </div>
    
    <script src="js/admin.js"></script>
</body>
</html>
