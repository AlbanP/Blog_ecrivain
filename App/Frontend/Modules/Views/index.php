<header class="container-fluid">
	<h1 class="col-xs-12 col-sm-7 pull-right" >Décrouvrez mon nouveau roman</h1>	
	<img class="col-xs-12 col-sm-5 margTop15" src="/img/logo.jpg" alt="Billet simple pour l'Alaska de Jean Forteroche">
	<p id="nameAuthor" class="visible-xs">Jean Forteroche</p>
	<p class="col-xs-12 col-sm-7">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam porttitor suscipit nisl, a ultrices risus faucibus eget. Integer nec magna quis justo viverra luctus ac non quam. Maecenas libero lorem, venenatis cursus efficitur vel, maximus ac sapien. Sed tortor diam, sodales eu eros eu, pretium imperdiet augue. Quisque tempus lacus enim, eget consequat quam mattis eget. Cras a tortor vitae diam egestas consequat ut aliquet sem. Quisque risus lorem, mattis eget tincidunt sed, sagittis vitae lectus. Sed nec fringilla metus, quis semper felis. Integer massa arcu, sollicitudin at neque ac, varius scelerisque tellus. Vestibulum suscipit nulla vel maximus volutpat. Ut sapien nulla, egestas id purus sed, rhoncus sollicitudin leo. Quisque pharetra turpis ut enim feugiat, at feugiat velit dictum.</p>
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
		
		<?php if(isset($_SESSION['auth'])){ 
			include __DIR__.'/../../../Backend/Modules/Views/_menuUser.php' 
		;}?>

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
