
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