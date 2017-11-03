<section class="row">	
	<div id="postId" name="<?= $postId ?>" class="col-xs-12">
		<span class="titlePost">Commentaires du chapitre : <?= $titlePost ?></span>
		<p>Nombre de commentaires : <span class="badge"><?= $numberComment?></span></p>
		<p>Nombre de commentaires signalés : <span class="badge"><?= $numberCommentReport ?></span></p>
	</div>
	<div id="listComment" class="col-xs-12">
		<div class="margBot15">
			<button class="btn commentAdd btnComments" type="button">Ecrire un commentaire</button>
		</div>
		<div id="comments">	
		</div>
	</div>	

	<?php include '_formComment.php' ?>

</section>
<script src="/js/manageComments.js"></script>
