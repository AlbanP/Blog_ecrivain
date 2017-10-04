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
	<article id="postId" name="<?= $post['id'] ?>" class="col-xs-12">
		<h2><?= $post['title'] ?></h2>
		<span>Modifié le <?= $post['dateUpdate']->format('d/m/Y') ?></span>
		<p><?= nl2br($post['content']) ?></p>
	</article>
</section>

<section>

	<div id="listComment">
		<div>
			<p class="italic">Vos commentaires</p>
			<button class="commentAdd" type="button">Ecrire un message</button>
		</div>
		<ul class="media-list">
			<li class="media thumbnail">
				
			</li>
		</ul>
	</div>	

	<div id="formComment">
		<form action="" method="post">
	    	<?= isset($erreurs) && in_array(\Entity\Comment::AUTHOR_INVALID, $erreurs) ? 'L\'auteur est invalide.<br />' : '' ?>
	    	<label>Pseudo</label>
	    	<input id="commentAuthor" type="text" name="commentAuthor" value="<?= isset($commentForm) ? htmlspecialchars($commentForm['author']) : '' ?>" /><br />
	    	
	    	<?= isset($erreurs) && in_array(\Entity\Comment::CONTENT_INVALID, $erreurs) ? 'Le contenu est invalide.<br />' : '' ?>
	    	<label>Contenu</label>
	    	<textarea id="commentContent" name="commentContent" rows="7" cols="50"><?= isset($commentForm) ? htmlspecialchars($commentForm['content']) : '' ?></textarea><br />
	    
	    	<input id="commentSubmit" type="submit" value="Envoyer" name="commentSubmit" />
	        <bouton id="commentCancel" type="button">Annuler</bouton>
		</form>
	</div>
</section>
<script src="/js/manageComments.js"></script>



