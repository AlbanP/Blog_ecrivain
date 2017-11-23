<nav class="navbar navbar-fixed-top">
	<div class="container-fluid">
		<a href="/" class="btn btn-info nav-icon"><span class="glyphicon glyphicon-home"></span></a>
		<a href="#listComment" class="btn btnComments nav-icon"><span class="glyphicon glyphicon-comment"></span></a>
		<a href="/" class="btn btn-info navbar-btn nav-text">Accueil</a>
		<a href="#listComment" class="btn btnComments navbar-btn nav-text">Voir commentaires</a>
		<?php if (isset($_SESSION['auth'])) {
            require __DIR__.'/../../../Backend/Modules/Views/_menuUser.php'; } ?>
        <div class="btn-group"> 
            <button class="btn dropdown-toggle btnPosts navbar-btn" data-toggle="dropdown">Chapitres  <span class="caret"></span></button>
            <?php require '_menuPosts.php' ?> 
        </div>
    </div>
</nav>