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
	<article class="col-xs-12">
		<h2><?= $post['title'] ?></h2>
		<span>Modifié le <?= $post['dateUpdate']->format('d/m/Y') ?></span>
		<p><?= nl2br($post['content']) ?></p>
	</article>
</section>

<section>
	<p class="italic">Vos commentaires</p>

	<form action="" method="post">
    	<?= isset($erreurs) && in_array(\Entity\Comment::AUTHOR_INVALID, $erreurs) ? 'L\'auteur est invalide.<br />' : '' ?>
    	<label>Pseudo</label>
    	<input type="text" name="author" value="<?= isset($commentForm) ? htmlspecialchars($commentForm['author']) : '' ?>" /><br />
    	
    	<?= isset($erreurs) && in_array(\Entity\Comment::CONTENT_INVALID, $erreurs) ? 'Le contenu est invalide.<br />' : '' ?>
    	<label>Contenu</label>
    	<textarea name="content" rows="7" cols="50"><?= isset($commentForm) ? htmlspecialchars($commentForm['content']) : '' ?></textarea><br />
    
    	<input type="submit" value="Envoyer" name="insertComment" />
	</form>

	<?php if (empty($listComment)){ ?>
		<p>Aucun commentaire n'a encore été posté. Soyez le premier à en laisser un !</p>
	<?php } else {
		foreach ($listComment as $comment) { ?>
  		<div>
    		<h3>Posté par <?= htmlspecialchars($comment['author']) ?></h3>
    		<p><?= nl2br(htmlspecialchars($comment['content'])) ?></p>
    		<a href="" title="responseComment">Répondre</a>
    		<a href="" title="reportComment">Signaler</a>
  		</div>
		<?php } 
	} ?>
	</section>
