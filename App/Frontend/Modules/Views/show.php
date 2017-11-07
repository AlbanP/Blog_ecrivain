<?php include '_navMenu.php' ?> 
		
<div class="container-fluid margTop50">
	<article id="postId" name="<?= $post['id'] ?>">
		<h2 class="titlePost"><?= $post['title'] ?></h2>
		<span class="dateItem">Modifié le <?= $post['dateUpdate']->format('d/m/Y') ?></span>
		<p class="contentPost"><?= nl2br($post['content']) ?></p>
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
		<div id="comments">	
		</div>
	</div>

	<?php include '_formComment.php' ?>
	
</div>

<script src="/js/manageComments.js"></script>
<script src="/js/modal_tooltip.js"></script>



