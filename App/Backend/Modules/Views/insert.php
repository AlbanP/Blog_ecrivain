<div class="container-fluid margTop50">
    <form action="" method="post">
        <?php if(isset($post) && !$post->isNew()){ ?>
            <input type="hidden" name="id" value="<?= $post['id'] ?>" />
        <?php } ?>
        <div class="form-horizontal margTop15">   
            <label for="title" class="control-label col-xs-2">Titre : </label>
            <div class="col-xs-4">
                <input id="title" class="form-control" type="text" name="title" onchange="changed()" value="<?= isset($post) ? $post['title'] : '' ?>" required />
            </div>
            <input type="submit" name="typeSave" value="Publier" class="btn btn-sm btn-success margLeft15" />
            <input type="submit" name="typeSave" value="Brouillon" class="btn btn-sm btn-info" />
            <span class="margLeft15"><?php if ($session->hasFlash()) echo $session->getFlash(); ?></span>  
        </div>
        <div class="margTop15">
            <textarea id="content" name="content" class="form-control" margTop15"><?= isset($post) ? $post['content'] : '' ?></textarea><br />
        </div>
    </form>
</div>
<script src="/js/quitSavePost.js"></script>