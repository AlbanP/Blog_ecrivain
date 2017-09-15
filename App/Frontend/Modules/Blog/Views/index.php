<header class="row">
	<h1 class="col-xs-12 col-sm-7 pull-right" >Décrouvrez mon nouveau roman</h1>	
	<img id="logo" class="col-xs-12 col-sm-5" src="img/logo.jpg" alt="Billet simple pour l'Alaska de Jean Forteroche">
	<p id="nameAuthor" class="visible-xs">Jean Forteroche</p>
	<p class="col-xs-12 col-sm-7">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam porttitor suscipit nisl, a ultrices risus faucibus eget. Integer nec magna quis justo viverra luctus ac non quam. Maecenas libero lorem, venenatis cursus efficitur vel, maximus ac sapien. Sed tortor diam, sodales eu eros eu, pretium imperdiet augue. Quisque tempus lacus enim, eget consequat quam mattis eget. Cras a tortor vitae diam egestas consequat ut aliquet sem. Quisque risus lorem, mattis eget tincidunt sed, sagittis vitae lectus. Sed nec fringilla metus, quis semper felis. Integer massa arcu, sollicitudin at neque ac, varius scelerisque tellus. Vestibulum suscipit nulla vel maximus volutpat. Ut sapien nulla, egestas id purus sed, rhoncus sollicitudin leo. Quisque pharetra turpis ut enim feugiat, at feugiat velit dictum.</p>
	<div id="author" class="hidden-xs col-sm-7 pull-right">
		<p id="nameAuthor">Jean Forteroche</p>
		<img id="photoAuthor" src="img/photoAuthor.jpg" alt="Photo de Jean Forteroche">
	</div>
</header>
<section class="row">
	<div class="col-xs-12 col-sm-7">		
		<nav>
			<div class="btn-group"> 
				<button class="btn btn-lg dropdown-toggle" data-toggle="dropdown"> Acceder aux différents chapitres  <span class="caret"></span></button>
				<ul class="dropdown-menu">
					<?php foreach ($listPost as $post){ ?>
						<li><a href="post-<?= $post['id'] ?>.html"><?= $post['title'] ?></a></li>
				 	<?php } ?>	
				</ul>
			</div>
		</nav>	
		<article>
			<div>
			<?php foreach ($listPost as $post) { ?>
		  		<a href="post-<?= $post['id'] ?>.html"><div>
		  			<h2><?= $post['title'] ?></h2>
		  			<p><?= nl2br($post['content']) ?></p>
		  			<p class="italic">Lire le chapitre ou voir ou écrire un commentaire</p>
		  		</div></a>
		   	<?php } ?>
		   	</div>
		</article>
	</div>	
	<aside class="col-xs-12 col-sm-5 pull-right">
		<h2>Mes livres coup de coeur</h2>
		<div class="book col-xs-6 col-sm-12">
			<img src="img/CoupCoeur1.jpg" alt="La pape des escargots - Henri Vincenot">
			<p>Le pape des escargots</p>
			<p>Henri Vincenot</p>
		</div>
		<div class="book col-xs-6 col-sm-12">
			<img src="img/CoupCoeur2.jpg" alt="La billebaude - Henri Vincenot">
			<p>La billebaude</p>
			<p>Henri Vincenot</p>
		</div>
	</aside>
</section>
