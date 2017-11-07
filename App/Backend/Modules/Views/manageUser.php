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
		  			<a data-action="Modification" data-href="/admin/user-update.html" class="checkPass text-primary"><span class="glyphicon glyphicon-edit" data-toggle="tooltip" title="Modifier"></span></a>
		  			<a data-action="Supression" data-href="/admin/user-delete.html" class="checkPass text-danger" ><span class="glyphicon glyphicon-remove" data-toggle="tooltip" title="Supprimer"></span></a>
		  		</div>
				</td>
			</tr>
		  	<?php } ?>
		</tbody>
	</table>
	<div class="margTop15 col-xs-12">
        <a href="#addUser" data-toggle="modal" data-backdrop="false" class="btn btn-primary">Ajouter un nouvel utilisateur</a>
        <?php if ($session->hasFlash()) echo '<span> ', $session->getFlash(), '</span>'; ?>
    </div>
</div>

<!-- Modal checkUser -->	
<div id="checkUser" class="modal">
	<div class="modal-dialog">
  	<div class="modal-content">
	    	<div class="modal-header">
	      		<button type="button" class="close" data-dismiss="modal">×</button>
				<h3></h3>
	    	</div>
	    	<div class="modal-body">
	      		<form id="formCheckPass">
	      			<input type="hidden" id="userId" name="userId" value=""> 
	           		<div class="form-group">
	              		<label for="pass" class="control-label">Mot de passe</label>
	              		<input type="password" class="form-control" id="pass" name ="pass" required>
	            	</div>
	            	<div class="controls">
	            	<button id="validPass" type="submit" class="btn btn-primary">Valider</button>
	            	<span id="message"> Mauvais mot de passe. </span>
	            	</div>
	     		</form>
	   		</div>
	   		<div class="modal-footer">
	      		<button class="btn btn-default" data-dismiss="modal">Annuler</button>
	    	</div>
	    </div>
  	</div>
</div>

<!-- Modal Add & Update-->	
<div id="addUser" class="modal">
	<div class="modal-dialog">
  	<div class="modal-content">
	    	<div class="modal-header">
	      		<button type="button" class="close" data-dismiss="modal">×</button>
				<h3>Ajout d'un utilisateur <span><i>(* obligatoire)</i></span></h3>
	    	</div>
	    	<div class="modal-body">
	      		<form action="/admin/user-add.html" method="POST">
	            	<div class="form-group">
	              		<label for="name" class="control-label">Nom*</label>
	              		<input type="text" class="form-control" name ="name" id="name" required autofocus>
	            	</div>
	            	<div class="form-group">
	              		<label for="email" class="control-label">Email</label>
	              		<input type="email" class="form-control" name="email" id="email">
	            	</div>
	           		<div class="form-group">
	              		<label for="pass" class="control-label">Mot de passe*</label>
	              		<input type="password" class="form-control" name ="pass" id="pass" required>
	            	</div>
	            	<div class="controls">
	            	<input type="submit" class="btn btn-primary" value="Valider" onclick="$('addUser').modal('hide');">
	            	<?php if ($session->hasFlash()) echo '<span> ', $session->getFlash(), '</span>'; ?>
	            	</div>
	     		</form>
	   		</div>
	   		<div class="modal-footer">
	      		<button class="btn btn-default" data-dismiss="modal">Annuler</button>
	    	</div>
	    </div>
  	</div>
</div>
