<?php require '_navMenu.php' ?> 
		
<div class="container-fluid margTop50">
	<article id="postId" name="<?= $post['id'] ?>">
		<h2 class="titlePost"><?= $post['title'] ?></h2>
		<span class="dateItem">Modifié le <?= $post['dateUpdate']->format('d/m/Y') ?></span>
		<p class="contentPost"><?= $post['content'] ?></p>
	</article>
</div>	
<div class="container-fluid margTop50">
	<div id="listComment" class="margBot15">
		<div id="null">
			<div>
				<button class="btn commentAdd btnComments" type="button">Ecrire un commentaire</button>
			</div>
			<p class="titlePost margTop15"><i>Vos commentaires</i></p>
		</div>
		<div id="comments"></div>
	</div>
</div>
<?php require __DIR__.'/_formComment.php' ?>
	

<?php require __DIR__.'/../../../Backend/Modules/Views/_modalConfirm.php' ?>





