<header class="row">
	<img id="logo" class="col-xs-2" src="/img/logo.jpg" alt="Billet simple pour l'Alaska de Jean Forteroche">
	<a href="/"><h1 class="col-xs-5" >Billet simple pour l'Alaska</h1></a>
	<div class="col-xs-5">
		<p>Nombre de chapitres publiés : <?= $numberPost ?></p>
		<p>Nombre de commentaires : <?= $numberCommentAll?></p>
		<p>Nombre de commentaires signalés : <?= $numberCommentReport ?></p>
		<a class="btn btn-success" href="/admin/post-add.html" alt="Ajout chapitre">Ajouter un nouveau chapitre</a>
		<a class="btn btn-primary" href="/admin/post-listOrder.html" alt="Classer les chapitres publiés">Classer les chapitres publiés</a>
		<a class="btn btn-danger" href="/admin/user-deconnexion.html" alt="Deconnexion">Deconnexion</a>
		<a class="btn btn-info" href="/admin/user-manage.html" alt="Gestion des utilisateurs">Gestion des utilisateurs</a>
	</div>
</header>
<section class="row">
	<div class="col-xs-12 col-sm-7">		
		<nav>
			<div class="btn-group"> 
				<button class="btn btn-lg dropdown-toggle" data-toggle="dropdown"> Acceder aux différents chapitres  <span class="caret"></span></button>
				<ul class="dropdown-menu">
					<?php foreach ($listPost as $post){ ?>
						<li><a href="post-update-<?= $post['id'] ?>.html"><?= $post['title'] ?></a></li>
				 	<?php } ?>	
				</ul>
			</div>
		</nav>	
		<article>
			<div>
			<?php foreach ($listPost as $post) { ?>
		  		<a href="post-update-<?= $post['id'] ?>.html"><div>
		  			<h2><?= $post['title'] ?></h2>
		  			<p><?php if (is_null($post['orderPosted'])) { echo "Brouillon"; } else { echo "Publié"; } ?></p>
		  			<a href= "post-update-<?= $post['id'] ?>.html">Modifier</a>
		  			<?php if (is_null($post['orderPosted'])) { $post['statusPost']='post'; ?>
		  				<a href="post-posted-<?= $post['id'] ?>.html">Publier</a>
		  			<?php } else { $post['statusPost']='draft'; ?>
		  				<a href="post-posted-<?= $post['id'] ?>.html">Ne plus publier</a>
		  	<?php } ?>
		  			<a href="post-delete-<?= $post['id'] ?>.html">Supprimer</a>
		  			<p>Dernier enregistrement le <?= $post['dateUpdate']->format('d/m/Y à H\hi') ?></p>
		  		</div></a>

		   	<?php } ?>
		   	</div>
		</article>
	</div>