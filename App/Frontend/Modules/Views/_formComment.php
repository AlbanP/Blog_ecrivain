<div id="formComment" class="row" >
	<form action="" method="post" class="col-xs-10 col-xs-push-1 form-horizontal margTop15 margBot15 borderAll" >
		<legend class="textAnnotation">Saisiez votre pseudo et message (*obligatoire)</legend>
		<div class="row">
	    	<label for="commentAuthor" class="control-label col-xs-2">Pseudo*</label>
	    	<div class="col-xs-10">
	    		<input id="commentAuthor" class="form-control" type="text" name="commentAuthor" value="<?= isset($_SESSION['name'])? $_SESSION['name'] :'' ?>" required />
	    	</div>
	    </div>
	    <div class="row margTop5">	
	    	<label for="commentContent" class="control-label col-xs-2">Message*</label>
	    	<div class="col-xs-10">
	    		<textarea id="commentContent" class="form-control" name="commentContent" required></textarea>
	    	</div>
	    </div>
	    <div class="pull-right margTop15 margBot15">
	    	<input id="commentSubmit" class="btn btn-primary" type="submit" value="Envoyer" name="commentSubmit" />
	        <bouton id="commentCancel" class="btn btn-default" type="button">Annuler</bouton>
	    </div>
	</form>
</div>