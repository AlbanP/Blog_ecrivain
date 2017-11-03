<nav class="row">
	<div class="navBar">
		<a href="/" class="btn btn-info">Accueil</a>
		<div class="btn-group"> 
			<button class="btn dropdown-toggle btnPosts" data-toggle="dropdown">Chapitres  <span class="caret"></span></button>

			<?php include '_menuPosts.php' ?> 
		
		</div>
		<a href="#listComment" class="btn btnComments">Voir commentaires</a>
		
		<?php include __DIR__.'/../../../Backend/Modules/Views/_menuUser.php' ?> 
	
	</div>
</nav>
<section class="row">
	<article id="postId" name="<?= $post['id'] ?>" class="col-xs-12">
		<h2><?= $post['title'] ?></h2>
		<span class="dateItem">Modifié le <?= $post['dateUpdate']->format('d/m/Y') ?></span>
		<p><?= nl2br($post['content']) ?></p>
	</article>
</section>
<section>
	<div id="listComment">
		<div>
			<button class="btn commentAdd btnComments" type="button">Ecrire un commentaire</button>
			<p class="titlePost margTop15"><i>Vos commentaires</i></p>
		</div>
		<div id="comments">	
		</div>
	</div>

	<?php include __DIR__.'/../../../Backend/Modules/Views/_formComment.php' ?>

</section>
<script src="/js/manageComments.js"></script>
<script src="/js/modal_tooltip.js"></script>



