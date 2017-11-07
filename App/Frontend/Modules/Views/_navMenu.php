<nav class="navbar navbar-fixed-top">
	<div class="container-fluid">
		<a href="/" class="btn btn-info navbar-btn">Accueil</a>
		<?php if(isset($_SESSION['auth'])){ ?>
			<a href="/admin/" class="btn btn-primary navbar-btn">Tableau de bord</a>
		<?php ;}?>
		<div class="btn-group"> 
			<button class="btn dropdown-toggle btnPosts navbar-btn" data-toggle="dropdown">Chapitres  <span class="caret"></span></button>

			<?php include '_menuPosts.php' ?> 
		
		</div>
		<a href="#listComment" class="btn btnComments navbar-btn">Voir commentaires</a>
		
		<?php if(isset($_SESSION['auth'])){ 
			include __DIR__.'/../../../Backend/Modules/Views/_menuUser.php' 
		;}?>
	
	</div>
</nav>