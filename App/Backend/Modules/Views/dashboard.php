<div class="container-fluid margTop50">
	<section class="row">	
		<article class="col-xs-12 col-sm-7">
			<p class="titlePost">Liste des chapitres : </p>
			<p>Nombre de chapitres publiés : <span class="badge"><?= $numberPost ?></span></p>
			<div class="margTop15 borderTop">
				<?php foreach ($listPost as $post) { ?>
		  		<div class="borderBot margTop15">
	  				<span class="titlePost"><?= $post['title'] ?></span>
	  				<?php if (is_null($post['orderPosted'])) { echo '<span class="label label-info margLeft15">Brouillon</span>'; } else { echo '<span class="label label-success margLeft15">Publié</span>'; } ?>
	  				<div class="iconMenu pull-right">
		  				<a href= "post-update-<?= $post['id'] ?>.html" class="text-primary"><span class="glyphicon glyphicon-edit" data-toggle="tooltip" title="Modifier"></span></a>
		  				<?php if (is_null($post['orderPosted'])) { $post['statusPost']='post'; ?>
		  					<a href="post-posted-<?= $post['id'] ?>.html" class="text-success"><span class="glyphicon glyphicon-share" data-toggle="tooltip" title="Publier"></span></a>
		  				<?php } else { $post['statusPost']='draft'; ?>
		  					<a href="post-posted-<?= $post['id'] ?>.html" class="text-muted"><span class="glyphicon glyphicon-inbox" data-toggle="tooltip" title="Ne plus publier"></span></a>
		  				<?php } ?>
		  				<a data-href="/admin/post-delete-<?= $post['id'] ?>.html" class="text-danger" data-confirm="Supression du chapitre et des commentaires qui sont associés. Valider pour confirmer." data-id-item="<?= $post['id'] ?>" data-name="<?= $post['title'] ?>" data-title="Suppresion du chapitre "><span class="glyphicon glyphicon-remove" data-toggle="tooltip" title="Supprimer"></span></a>
		  				<a href="/post-<?= $post['id'] ?>.html#listComment" class="text-warning"><span class="glyphicon glyphicon-share-alt" data-toggle="tooltip" title="Voir les commentaires"></span></a>
		  				<span data-toggle="tooltip" title="Nombre total de commentaire(s)"> (<?php if(is_null($post['nbComment'])){echo 0;} else {echo $post['nbComment'];} ?>) </span>
	  				</div>
	  				<div class="dateItem">Dernier enregistrement le <?= $post['dateUpdate']->format('d/m/Y à H\hi') ?></div>	
		   		</div>
		   		<?php } ?>
		   	</div>
		</article>
		<aside id="reportedBlock" class="col-xs-12 col-sm-5">
			<p class="titlePost">Commentaires signalés :</p>
			<p>Nombre total de commentaires (non modérés) : <span class="badge"><?= $numberCommentAll?></span></p>
			<p>Nombre total de commentaires signalés : <span class="badge"><?= $numberCommentReport ?></span></p>
			<div class="borderTop">
				<?php foreach ($commentReported as $comment) { ?>
				<div id="<?= $comment['id'] ?>" class="borderBot margTop15">
					<span class="authorComment"><?= htmlspecialchars($comment['author']) ?></span>
					<div class="iconMenu pull-right">
						<a class="commentModerate text-danger margLeft15" data-id-item="<?= $comment['id'] ?>"><span class="glyphicon glyphicon-thumbs-down" data-toggle="tooltip" title="Modérer"></span></a>
						<a class="commentUnreport text-success margLeft15" data-id-item="<?= $comment['id'] ?>"><span class="glyphicon glyphicon-thumbs-up" data-toggle="tooltip" title="Accepter"></span></a>
						<a href= "/post-<?= $comment['postId']?>.html#<?= $comment['id']?>" class="text-warning margLeft15"><span class="glyphicon glyphicon-share-alt" data-toggle="tooltip" title="Voir les commentaires"></span></a>
					</div>
					<div class="dateItem"><?= $comment['date']->format('d/m/Y à H\hi') ?></div>
					<div><?= nl2br(htmlspecialchars($comment['content'])) ?></div>
				</div>
				<?php } ?>
			</div>
		</aside>
	</section>
</div>
<?= require __DIR__.'/_modalConfirm.php' ?>

