<nav class="col-sm-12 menu-nav">
    
    <!-- logo sudoku -->
    <a href="index.php">
        <img src="icons/sudo-ku.jpg" width="140" height="90" alt="logo_sudoku">
    </a>
    
    <!-- menu -->
    <div class="col-sm-10 menu">
        
        <!-- responsive menu -->
        <div class="dropdown">
            <div class="menu-responsive dropdown-toggle" data-toggle="dropdown"></div>
            <ul class="dropdown-menu">
                <li><a href="index.php">Accueil</a></li>
                <li><a href="contest.php">Concours</a></li>
                <?php if(empty($_SESSION['IdUser'])): ?>
                <li><a href="sign_up.php">Inscription</a></li>
                <li><a href="sign_in.php">Connexion</a></li>
                <?php else: ?>
                <li><a href="profil.php">Profil</a></li>
                <li><a href="perf.php">Performances</a></li>
                <li><a href="logout.php">Déconnexion</a></li>
                <?php endif; ?>
            </ul>
        </div>
        
        <ul class="nav nav-pills">
            <li><a href="index.php">Accueil</a></li>
            <li><a href="contest.php">Concours</a></li>
        </ul>
    
        <ul class="nav nav-pills">
            <?php if(empty($_SESSION['IdUser'])): ?>
            <li><a href="sign_up.php">Inscription</a></li>
		  	<li><a href="sign_in.php">Connexion</a></li>
            <?php else: ?>
             <div class="dropdown">
                 <a href="profil.php" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="icons/default.png" width="90" height="90" alt="profil"><span class="caret"></span>
                </a>
            <ul class="dropdown-menu">
                <li><a href="profil.php">Profil</a></li>
                <li><a href="perf">Performances</a></li>
                <li><a href="logout.php">Déconnexion</a></li>
            </ul>
            </div>
            <?php endif; ?>
        </ul>
    </div>
</nav>