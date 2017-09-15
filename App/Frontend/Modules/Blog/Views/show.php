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
		<p><?= nl2br($post['content']) ?></p>
	</article>
</section>

<section id="comment">
	<p class="italic">Vos commentaires</p>

	<form action="" method="post">
    	<?= isset($erreurs) && in_array(\Entity\Comment::AUTHOR_INVALID, $erreurs) ? 'L\'auteur est invalide.<br />' : '' ?>
    	<label>Pseudo</label>
    	<input type="text" name="author" value="<?= isset($commentForm) ? htmlspecialchars($commentForm['author']) : '' ?>" /><br />
    	
    	<?= isset($erreurs) && in_array(\Entity\Comment::CONTENT_INVALID, $erreurs) ? 'Le contenu est invalide.<br />' : '' ?>
    	<label>Contenu</label>
    	<textarea name="content" rows="7" cols="50"><?= isset($commentFprm) ? htmlspecialchars($commentForm['content']) : '' ?></textarea><br />
    
    	<input type="submit" value="Commenter" name="insertComment" />
	</form>

	    <h2>Un formulaire de connexion en AJAX</h2>
	    <form>
	    <p>
	        Pseudo : <input type="text" id="authorComment" name="authorComment" />
	        Commentaire : <textarea id="messageComment" name="messageComment"></textarea>
	        <input type="submit" id="submit" value="Envoyer" />
	    </p>
	    </form>
	    <div id="Comments"></div>

	 <?php if ($user->hasFlash()) echo '<p style="text-align: center;">', $user->getFlash(), '</p>'; ?>
	<?php if (empty($comment)){ ?>
		<p>Aucun commentaire n'a encore été posté. Soyez le premier à en laisser un !</p>
	<?php 
	}
	foreach ($comment as $comment) { ?>
  		<fieldset>
    		<legend>
      			Posté par <strong><?= htmlspecialchars($comment['author']) ?></strong> 
    		</legend>
    		<p><?= nl2br(htmlspecialchars($comment['content'])) ?></p>
  		</fieldset>
		<?php
		} ?>
	</section>
