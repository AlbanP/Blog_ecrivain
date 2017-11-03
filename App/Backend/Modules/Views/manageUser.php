
<section class="row">
<div class="col-xs-12">
	
	<table class="col-xs-12">
		<tr>
			<th>Nom</th>
			<th>Email</th>
			<th>Date de création</th>
			<th>Rôle</th>
			<th>Action</th>
		</tr>
		<?php foreach ($listUser as $user) { ?>
	  	<tr>
	  		<td><strong><?= $user['name'] ?></strong></td>
	  		<td><?= $user['email'] ?></td>	
	  		<td><?= $user['dateCreation']->format('d/m/Y à H\hi') ?></td>
	  		<td><?= $user['role'] ?></td>
	  		<td>
	  			<button data-toggle="modal" data-backdrop="false" href="#update<?= $user['id'] ?>" class="btn btn-primary">Modifier</button>
				<div id="update<?= $user['id'] ?>" class="modal fade">
				    <div class="modal-dialog">
				        <div class="modal-content">
				            <div class="modal-header">
				              	<button type="button" class="close" data-dismiss="modal">x</button>
				              	<h4 class="modal-title">Modification d'un compte utilisateur"</h4>
				            </div>
				            <div class="modal-body">
				            	<p>Saisisez le mot de passe pour modifier le compte utilisateur "<?= $user['name'] ?>"</p>
				              	<form action="/admin/user-update.html">
				              		<input type="hidden" class="form-control" name ="id" id="id" value="<?= $user['id'] ?>">
				                	<div class="form-group">
				                  		<label for="pass">Mot de passe</label>
				                  		<input type="password" class="form-control" name ="pass" id="pass">
				                  		<p class="response"></p>
				                	</div>
				                	<button type="submit" class="btn btn-default">Envoyer</button>
				             	</form>
				           	</div>
				            <div class="modal-footer">
				              	<button class="btn btn-info" data-dismiss="modal">Annuler</button>
				           	</div>
				        </div>
				    </div>
			    </div>

		        <button data-toggle="modal" data-backdrop="false" href="#delete<?= $user['id'] ?>" class="btn btn-primary">Supprimer</button>
				<div id="delete<?= $user['id'] ?>" class="modal fade">
				    <div class="modal-dialog">
				        <div class="modal-content">
				            <div class="modal-header">
				              	<button type="button" class="close" data-dismiss="modal">x</button>
				              	<h4 class="modal-title">Supression d'un compte utilisateur</h4>
				            </div>
				            <div class="modal-body">
				            	<p>Saisisez le mot de passe pour confirmer la suppression du compte utilisateur "<?= $user['name'] ?>"</p>
				              	<form action="/admin/user-delete.html">
				              		<input type="hidden" class="form-control" name ="id" id="id" value="<?= $user['id'] ?>">
				                	<div class="form-group">
				                  		<label for="pass">Mot de passe</label>
				                  		<input type="password" class="form-control" name ="pass" id="pass">
				                  		<p class="response"></p>
				                	</div>
				                	<button type="submit" class="btn btn-default">Envoyer</button>
				             	</form>
				           	</div>
				            <div class="modal-footer">
				              	<button class="btn btn-info" data-dismiss="modal">Annuler</button>
				           	</div>
				        </div>
				    </div>
			    </div>
	  		</td>
	  	</tr>
	   	<?php } ?>
	</table>
</div>
</section>
		<div id="UserAdd">
        	<button data-toggle="modal" data-backdrop="false" href="#formAdd" class="btn btn-primary">Ajouter un nouvel utilisateur</button>
      	</div>
	    <div id="formAdd" class="modal fade">
	        <div class="modal-dialog">
	          <div class="modal-content">
	            <div class="modal-header">
	              <button type="button" class="close" data-dismiss="modal">x</button>
	              <h4 class="modal-title">Nouvelle utilisateur</h4>
	            </div>
	            <div class="modal-body">
	              	<form action="/admin/user-add.html">
	                	<div class="form-group">
	                  		<label for="name">Nom</label>
	                  		<input type="text" class="form-control" name ="name" id="name">
	                	</div>
	                	<div class="form-group">
	                  		<label for="email">Email</label>
	                  		<input type="email" class="form-control" name="email" id="email">
	                	</div>
	               		<div class="form-group">
	                  		<label for="pass">Mot de passe</label>
	                  		<input type="password" class="form-control" name ="pass" id="pass">
	                	</div>
	                	<button type="submit" class="btn btn-default">Envoyer</button>
	             	</form>
	           	</div>
	            <div class="modal-footer">
	              <button class="btn btn-info" data-dismiss="modal">Annuler</button>
	            </div>
	          </div>
	        </div>
      	</div>

<script src="/js/modal.js" type="text/javascript" charset="utf-8"></script>
