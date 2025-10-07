<div class="topbar">
    <div class="topbar-left">
        <button class="menu-toggle" id="menuToggle">
            <i class="fas fa-bars"></i>
        </button>
        <div class="breadcrumb">
            <a href="index.php">Administration</a>
            <span>/</span>
            <span>Tableau de bord</span>
        </div>
    </div>
    
    <div class="topbar-right">
        <div class="topbar-actions">
            <button id="themeToggle" class="theme-toggle-btn">
                <i class="fas fa-sun light-icon"></i>
                <i class="fas fa-moon dark-icon"></i>
            </button>
            
            <a href="../index.html" class="btn btn-sm btn-outline" target="_blank">
                <i class="fas fa-external-link-alt"></i>
                <span>Voir le site</span>
            </a>
            
            <div class="dropdown">
                <button class="dropdown-toggle">
                    <i class="fas fa-bell"></i>
                    <span class="badge">3</span>
                </button>
                <div class="dropdown-menu">
                    <div class="dropdown-header">
                        <h4>Notifications</h4>
                        <a href="#">Marquer tout comme lu</a>
                    </div>
                    <div class="dropdown-content">
                        <a href="#" class="notification-item unread">
                            <div class="notification-icon bg-primary">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="notification-content">
                                <p>Nouveau message de Marie Martin</p>
                                <span>Il y a 2 heures</span>
                            </div>
                        </a>
                        <a href="#" class="notification-item unread">
                            <div class="notification-icon bg-success">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="notification-content">
                                <p>Nouveau contact ajouté</p>
                                <span>Il y a 1 jour</span>
                            </div>
                        </a>
                        <a href="#" class="notification-item">
                            <div class="notification-icon bg-warning">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                            <div class="notification-content">
                                <p>Mise à jour système disponible</p>
                                <span>Il y a 3 jours</span>
                            </div>
                        </a>
                    </div>
                    <div class="dropdown-footer">
                        <a href="#">Voir toutes les notifications</a>
                    </div>
                </div>
            </div>
            
            <div class="dropdown user-dropdown">
                <button class="dropdown-toggle">
                    <div class="user-avatar">
                        <span>PM</span>
                    </div>
                    <span class="user-name">Patrick Missamu</span>
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div class="dropdown-menu">
                    <a href="profile.php" class="dropdown-item">
                        <i class="fas fa-user"></i>
                        <span>Mon profil</span>
                    </a>
                    <a href="settings.php" class="dropdown-item">
                        <i class="fas fa-cog"></i>
                        <span>Paramètres</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="logout.php" class="dropdown-item">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Déconnexion</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
