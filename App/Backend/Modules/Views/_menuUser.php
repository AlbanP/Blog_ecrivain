<div class="pull-right">
	<div id="session" name="true" class="btn-group"> 
	  <button class="btn btn-danger navbar-btn dropdown-toggle" data-toggle="dropdown"> <?= $_SESSION['name'] ?> <span class="caret"> </span></button>
	  <ul class="dropdown-menu dropdown-menu-right menuList">
	    <li><a href="/"> Page d'accueil</a></li>
	    <li><a href="/admin/"> Tableau de bord</a></li>
	    <li class="divider"></li>
	    <li><a href="/admin/user-manage.html"> Gestion des utilisateurs</a></li>
	    <li><a href="/admin/user-deconnexion.html"> Déconnexion</a></li>
	  </ul>
	</div>
</div>
