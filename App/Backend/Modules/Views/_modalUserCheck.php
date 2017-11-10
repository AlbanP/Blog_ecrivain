<div id="checkUser" class="modal" data-backdrop="false">
	<div class="modal-dialog">
  	<div class="modal-content">
	    	<div class="modal-header">
	      		<button type="button" class="close closeModal" data-dismiss="modal">×</button>
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
	      		<button class="btn btn-default closeModal" data-dismiss="modal">Annuler</button>
	    	</div>
	    </div>
  	</div>
</div>