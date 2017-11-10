<div class="container-fluid margTop50">
	<div class="margTop15">
		<h2 class="titlePost">Gestion des utilisateurs</h2>
	</div>
	<table class="table-striped margTop15 col-xs-12">
		<thead>
			<tr>
				<th>Nom</th>
				<th>Email</th>
				<th>Date de création</th>
				<th>Rôle</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($listUser as $user) { ?>
		  	<tr>
		  		<td><strong><?= $user['name'] ?></strong></td>
		  		<td><?= $user['email'] ?></td>	
		  		<td><?= $user['date']->format('d/m/Y à H\hi') ?></td>
		  		<td><?= $user['role'] ?></td>
		  		<td>
		  		<div id="<?= $user['id'] ?>" class="iconMenu" data-name="<?= $user['name'] ?>">
		  		<!-- <a data-action="Modification" data-href="/admin/user-update.html" class="updateUser text-primary"><span class="glyphicon glyphicon-edit" data-toggle="tooltip" title="Modifier"></span></a> -->
		  			<a data-action="Supression" data-href="/admin/user-delete.html" class="deleteUser text-danger" ><span class="glyphicon glyphicon-remove" data-toggle="tooltip" title="Supprimer"></span></a>
		  		</div>
				</td>
			</tr>
		  	<?php } ?>
		</tbody>
	</table>
	<div class="margTop15 col-xs-12">
        <a href="#saveUser" data-toggle="modal" data-backdrop="false" class="btn btn-primary">Ajouter un nouvel utilisateur</a>
        <?php if ($session->hasFlash()) echo '<span> ', $session->getFlash(), '</span>'; ?>
    </div>
</div>

<?php 
	require __DIR__.'/_modalUserCheck.php'; 
	require __DIR__.'/_modalUserSave.php';
?>	

