
<?php foreach ($listComment as $comment){ ?>
	<article class="comment" name="<?= $comment['id'] ?>">
		<p><?= $comment['author'] ?> le <?= $comment['date']->format('d/m/Y à H\hi') ?></p>
		<p><?= $comment['content'] ?></p>
		<div>
			<a class="commentResponse"  name="<?= $comment['id'] ?>" >Répondre</a>
			<a class="commentReport" name="<?= $comment['id'] ?>"" href="/comment-reportAjax.html">Signaler</a>
			<div class="commentForm"></div>
		</div>	
	</article>
<?php } ?>