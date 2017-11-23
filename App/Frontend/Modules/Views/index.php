<header class="container-fluid">
	<h1 class="col-xs-12 col-sm-7 pull-right" >Décrouvrez mon nouveau roman</h1>	
	<img class="col-xs-12 col-sm-5 margTop15" src="/img/logo.jpg" alt="Billet simple pour l'Alaska de Jean Forteroche">
	<p id="nameAuthor" class="visible-xs">Jean Forteroche</p>
	<div class="col-xs-12 col-sm-7">
		<p>Jean Forteroche, acteur et écrivain, publie par épisode son prochain roman « Billet simple pour l'Alaska ».</p>
		<p>Jean Forteroche se qualifie d'écrivain du terroir décrivant les hommes de la campagne bourguignonne de Forterre et de Puisaye prit entre la désertification et la modernité générant des peurs et des fantasmes. Comme Henri Vincenot, son « maître » comme il le qualifie, il recherche à dépeindre cette société à l'écart des villes mais qui la regarde...</p>
		<p>Ce roman à pour thème la création d'un élevage de Malamute de l'Alaska dans cette campagne auxerroise. Le malamute de l'Alaska tire son nom des Mahlemiuts en inuite : « les hommes habitant l’endroit où il y a de grandes vagues »...</p>
		<p>Suivez moi dans l'élaboratoin de mon roman au travers des chapitres ci-dessous et laisser des commentaires.</p>
	</div>
	<div id="author" class="hidden-xs col-sm-7 pull-right">
		<p id="nameAuthor">Jean Forteroche</p>
		<img id="photoAuthor" src="/img/photoAuthor.jpg" alt="Photo de Jean Forteroche">
	</div>
</header>
<nav class=" navbar margTop15">
	<div class="container-fluid">
		<div class="btn-group "> 
			<button class="btn dropdown-toggle btnPosts navbar-btn" data-toggle="dropdown">Acceder aux différents chapitres  <span class="caret"></span></button>
			<?php include '_menuPosts.php' ?> 
		</div>
		
		<?php if (isset($_SESSION['auth'])) { require __DIR__.'/../../../Backend/Modules/Views/_menuUser.php';}?>
		</div>
</nav>
<div class="container-fluid">
	<section class="row">		
			
			<article class="col-xs-12 col-sm-7">
				<?php foreach ($listPost as $post) { ?>
			  		<a href="post-<?= $post['id'] ?>.html"><div class="post-resume">
			  			<h2 class="titlePost"><strong><?= $post['title'] ?></strong></h2>
			  			<span class="dateItem">Modifié le <?= $post['dateUpdate']->format('d/m/Y') ?></span>
			  			<p><?= nl2br($post['content']) ?></p>
			  			<p><strong><i>Lire le chapitre ou voir ou écrire un commentaire</i></strong></p>
			  		</div></a>
			   	<?php } ?>
			</article>
			
		<aside class="col-xs-12 col-sm-5 pull-right text-center">
			<h2>Mes livres coup de coeur</h2>
			<div class="col-xs-6 col-sm-12 margTop15">
				<img src="img/CoupCoeur1.jpg" alt="La pape des escargots - Henri Vincenot" class="img-responsive center-block">
				<p><strong>Le pape des escargots</strong></p>
				<p>Henri Vincenot</p>
			</div>
			<div class="col-xs-6 col-sm-12 margTop15">
				<img src="img/CoupCoeur2.jpg" alt="La billebaude - Henri Vincenot" class="img-responsive center-block">
				<p><strong>La billebaude</strong></p>
				<p>Henri Vincenot</p>
			</div>
		</aside>
	</section>
</div>
