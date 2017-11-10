<div id="saveUser" class="modal">
	<div class="modal-dialog">
  	<div class="modal-content">
	    	<div class="modal-header">
	      		<button type="button" class="close closeModal" data-dismiss="modal">×</button>
				<h3>Ajout d'un utilisateur <span><i>(* obligatoire)</i></span></h3>
	    	</div>
	    	<div class="modal-body">
	      		<form id="formSaveUser" action="/admin/user-add.html" method="POST">
	      			<input type="hidden" class="userId" name="userId" value=""> 
	            	<div class="form-group">
	              		<label for="name" class="control-label">Nom*</label>
	              		<input type="text" class="form-control name" name ="name" value="" required autofocus>
	            	</div>
	            	<div class="form-group">
	              		<label for="email" class="control-label">Email</label>
	              		<input type="email" class="form-control email" name="email" value="">
	            	</div>
	           		<div class="form-group">
	              		<label for="pass" class="control-label">Mot de passe*</label>
	              		<input type="password" class="form-control" name ="pass" id="pass" required>
	            	</div>
	            	<div class="controls">
	            	<input type="submit" class="btn btn-primary" value="Valider" onclick="$('saveUser').modal('hide');">
	            	<?php if ($session->hasFlash()) echo '<span> ', $session->getFlash(), '</span>'; ?>
	            	</div>
	     		</form>
	   		</div>
	   		<div class="modal-footer">
	      		<button class="btn btn-default closeModal" data-dismiss="modal">Annuler</button>
	    	</div>
	    </div>
  	</div>
</div>