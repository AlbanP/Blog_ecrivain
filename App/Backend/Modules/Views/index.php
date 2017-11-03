
<header class="row">
    <a href="/"><img id="logo" class="col-xs-10 col-xs-offset-1 col-sm-4 col-sm-offset-0" src="/img/logo.jpg" alt="Retour vers le site" title="Retour vers le site"></a>
	<form action="" method="post" class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-0 form-horizontal">
		<legend>Connexion</legend>
	  	<div class="row">
	  		<label for="name" class="col-sm-3 control-label">Identifiant</label>
	  		<div class="col-sm-9">
	  			<input type="text" name="name" class="form-control" required />
	  		</div>
	  	</div>
	  	<div class="row margTop15">
	 		<label for="pass" class="col-sm-3 control-label ">Mot de passe</label>
	  		<div class="col-sm-9">
	  			<input type="password" name="pass" class="form-control" required/>
	  		</div>
	 	</div>
	  	<div class="pull-right margTop15">
	  		<?php if ($session->hasFlash()) echo '<span class="text-danger">', $session->getFlash() ,'</span>'; ?>
	  		<input type="submit" value="Connexion" class="btn btn-primary" />
	  	</div>
	</form>
</header>
