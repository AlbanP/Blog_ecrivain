<div class="container-fluid margTop50">
	<section class="row">	
		<article class="col-xs-12 col-sm-7">
			<p class="titlePost">Liste des chapitres : </p>
			<p>Nombre de chapitres publiés : <span class="badge"><?= $numberPost ?></span></p>
			<div class="margTop15">
				<?php foreach ($listPost as $post) { ?>
		  		<div class="borderBot margTop15">
	  				<span class="titlePost"><?= $post['title'] ?></span>
	  				<?php if (is_null($post['orderPosted'])) { echo '<span class="label label-info">Brouillon</span>'; } else { echo '<span class="label label-success">Publié</span>'; } ?>
	  				<div class="iconMenu">
		  				<a href= "post-update-<?= $post['id'] ?>.html" class="text-primary" data-toggle="tooltip" title="Modifier"><span class="glyphicon glyphicon-edit"></span></a>
		  				<?php if (is_null($post['orderPosted'])) { $post['statusPost']='post'; ?>
		  					<a href="post-posted-<?= $post['id'] ?>.html" class="text-success" data-toggle="tooltip" title="Publier"><span class="glyphicon glyphicon-share"></span></a>
		  				<?php } else { $post['statusPost']='draft'; ?>
		  					<a href="post-posted-<?= $post['id'] ?>.html" class="text-muted" data-toggle="tooltip" title="Ne plus publier"><span class="glyphicon glyphicon-inbox"></span></a>
		  				<?php } ?>
		  				<a data-actionHref="/admin/post-delete-<?= $post['id'] ?>.html" class="text-danger" data-confirm="Supression du chapitre et des commentaires qui sont associés. Valider pour confirmer." data-idItem="<?= $post['id'] ?>" data-nameId="<?= $post['title'] ?>" data-titleModal="Suppresion du chapitre " data-toggle="tooltip" title="Supprimer"><span class="glyphicon glyphicon-remove"></span></a>
		  				<a href="/post-<?= $post['id'] ?>.html#listComment" class="text-warning" data-toggle="tooltip" title="Voir les commentaires"><span class="glyphicon glyphicon-share-alt"></span></a>
		  				<span></span>
	  				</div>
	  				<div class="dateItem">Dernier enregistrement le <?= $post['dateUpdate']->format('d/m/Y à H\hi') ?></div>	
		   		</div>
		   		<?php } ?>
		   	</div>
		</article>
		<aside class="col-xs-12 col-sm-5">
			<p class="titlePost">Commentaires signalés :</p>
			<p>Nombre total de commentaires : <span class="badge"><?= $numberCommentAll?></span></p>
			<p>Nombre total de commentaires signalés : <span class="badge"><?= $numberCommentReport ?></span></p>
			<div>
				<?php foreach ($commentReported as $comment) { ?>
				<div id="<?= $comment['id'] ?>" class="borderBot">
					<span class="authorComment"><?= $comment['author'] ?></span>
					<div class="iconMenu">
						<a class="commentModerate text-danger margLeft15" idItem="<?= $comment['id'] ?>" data-toggle="tooltip" title="Modérer"><span class="glyphicon glyphicon-thumbs-down"></span></a>
						<a class="commentUnreport text-success margLeft15" idItem="<?= $comment['id'] ?>" data-toggle="tooltip" title="Accepter"><span class="glyphicon glyphicon-thumbs-up"></span></a>
						<a href= "/post-<?= $comment['postId']?>.html#<?= $comment['id']?>" class="text-warning margLeft15" data-toggle="tooltip" title="Voir les commentaires"><span class="glyphicon glyphicon-share-alt"></span></a>
					</div>
					<div class="dateItem"><?= $comment['date']->format('d/m/Y à H\hi') ?></div>
					<div><?= $comment['content'] ?></div>
				</div>
				<?php } ?>
			</div>
		</aside>
	</section>
</div>
<script src="/js/manageComments.js"></script>
