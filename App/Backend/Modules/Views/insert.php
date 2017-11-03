<form action="" method="post" class="margTop15">
    <?php if(isset($post) && !$post->isNew()){ ?>
        <input type="hidden" name="id" value="<?= $post['id'] ?>" />
    <?php } ?>
    <div>   
        <label for="title">Titre : </label><input id="title" type="text" name="title" onchange="changed()" value="<?= isset($post) ? $post['title'] : '' ?>" required/>
        <input type="submit" name="typeSave" value="Publier" class="btn btn-sm btn-success" />
        <input type="submit" name="typeSave" value="Brouillon" class="btn btn-sm btn-info" />
        <span class="margLeft15"><?php if ($session->hasFlash()) echo $session->getFlash(); ?></span>  
    </div>
    <div class="margTop15">
        <textarea id="content" name="content" class="margTop15"><?= isset($post) ? $post['content'] : '' ?></textarea><br />
    </div>
</form>
<script src="/js/quitSavePost.js"></script>