<nav class="navbar navbar-fixed-top">
	<div class="container-fluid">
		<?php if(isset($_SESSION['auth'])){ ?>
			<a href="/" class="btn btn-info"><span class="glyphicon glyphicon-home"></span></a>
			<a href="/admin/" class="btn btn-primary"><span class="glyphicon glyphicon-cog"></span></a>
			<a href="#listComment" class="btn btnComments"><span class="glyphicon glyphicon-pencil"></span></a>
		<?php	include __DIR__.'/../../../Backend/Modules/Views/_menuUser.php';
		} else {?>
			<a href="/" class="btn btn-info navbar-btn">Accueil</a>
			<a href="#listComment" class="btn btnComments navbar-btn">Voir commentaires</a>
		<?php ;}?>
		<div class="btn-group"> 
			<button class="btn dropdown-toggle btnPosts navbar-btn" data-toggle="dropdown">Chapitres  <span class="caret"></span></button>
			<?php include '_menuPosts.php' ?> 
		</div>
	
	</div>
</nav>