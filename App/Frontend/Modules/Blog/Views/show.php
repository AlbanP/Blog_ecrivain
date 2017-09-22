<header class="row">
		<a href="/">
		<div class="col-xs-4">
			<img id="logo" class="col-xs-8" src="img/logo.jpg" alt="Billet simple pour l'Alaska de Jean Forteroche">
			<span>Page d'accueil</span>
		</div></a>
		<div class="btn-group col-xs-8"> 
			<button class="btn btn-lg dropdown-toggle" data-toggle="dropdown">Chapitres  <span class="caret"></span></button>
			<ul class="dropdown-menu">
				<?php foreach ($listPost as $postFromList){ ?>
					<li><a href="post-<?= $postFromList['id'] ?>.html"><?= $postFromList['title'] ?></a></li>
				<?php } ?>	
			</ul>
			<a class="btn btn-lg btn-default" href="#comment" role="button" >Commentaires</a>
		</div>
</header>
<section class="row">
	<article id="post" name="<?= $post['id'] ?>" class="col-xs-12">
		<h2><?= $post['title'] ?></h2>
		<span>Modifié le <?= $post['dateUpdate']->format('d/m/Y') ?></span>
		<p><?= nl2br($post['content']) ?></p>
	</article>
</section>

<section>
	<p class="italic">Vos commentaires</p>
	<div id="listCommentAjax"></div>
</section>
