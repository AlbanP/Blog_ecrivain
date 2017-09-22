	<form action="" method="post">
    	<?= isset($erreurs) && in_array(\Entity\Comment::AUTHOR_INVALID, $erreurs) ? 'L\'auteur est invalide.<br />' : '' ?>
    	<label>Pseudo</label>
    	<input class="author" type="text" name="author" value="<?= isset($commentForm) ? htmlspecialchars($commentForm['author']) : '' ?>" /><br />
    	
    	<?= isset($erreurs) && in_array(\Entity\Comment::CONTENT_INVALID, $erreurs) ? 'Le contenu est invalide.<br />' : '' ?>
    	<label>Contenu</label>
    	<textarea class="content" name="content" rows="7" cols="50"><?= isset($commentForm) ? htmlspecialchars($commentForm['content']) : '' ?></textarea><br />
    
    	<input id="submitComment" type="submit" value="Envoyer" name="submitComment" />
        <input id="submitCancel" type="submit" value="Annuler" name="submitCancel" />
	</form>