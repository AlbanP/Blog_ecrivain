<a href="/admin/"><h1 class="col-xs-5" >Billet simple pour l'Alaska</h1></a>
<form action="" method="post">
    <?php if(isset($post) && !$post->isNew()){ ?>
        <input type="hidden" name="id" value="<?= $post['id'] ?>" />
    <?php } ?>
        <input type="submit" name="typeSave" value="Publier" />
        <input type="submit" name="typeSave" value="Brouillon" />



    <p>   
        <?= isset($erreurs) && in_array(\Entity\Post::TITRE_INVALIDE, $erreurs) ? 'Le titre est invalide.<br />' : '' ?>
        <label>Titre</label><input type="text" name="title" value="<?= isset($post) ? $post['title'] : '' ?>" /><br />
    
        <?= isset($erreurs) && in_array(\Entity\Post::CONTENU_INVALIDE, $erreurs) ? 'Le contenu est invalide.<br />' : '' ?>
        <textarea id="postShow" name="content"><?= isset($post) ? $post['content'] : '' ?></textarea><br />
        
        <?php if(isset($post) && !$post->isNew()){ ?>
            <input type="hidden" name="id" value="<?= $post['id'] ?>" />
        <?php } ?>
            <input type="submit" name="typeSave" value="Publier" />
            <input type="submit" name="typeSave" value="Brouillon" />
    </p>
</form>