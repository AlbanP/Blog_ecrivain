<ul class="dropdown-menu menuList">
	<?php foreach ($listPost as $p){ ?>
		<li><a href="post-<?= $p['id'] ?>.html"><?= $p['title'] ?></a></li>
 	<?php } ?>	
</ul>