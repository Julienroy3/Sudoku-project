
<!-- <head>
	<link href="menu.css" rel="stylesheet" type="text/css" />
</head> -->
<body>
	<div id="menu">
		<ul>
		  <li><a href="index.php">Accueil</a></li>
		  <li><a href="contest.php">Concours</a></li>
		  <?php if(empty($_SESSION['id'])): ?>
		  	<li><a href="sign_up.php" id="Droite">Inscription</a></li>
		  	<li><a href="sign_in.php" id="Droite">Connexion</a></li>
		  <?php else: ?>
		  	<li><a href="#" id="Profil">Profil</a>
			    <ul>
			      <li><a href="profil.php">Profil</a></li>
			      <li><a href="performance.php">Performances</a></li>
			      <li><a href="logout.php">Déconnexion</a></li>
			    </ul>
		    </li>
		  <?php endif; ?>
		</ul>
	</div>

</body>
