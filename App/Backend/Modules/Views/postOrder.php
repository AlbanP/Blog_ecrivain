<div class="container-fluid margTop50"> 
  <div class="margTop15">
    <h2 class="titlePost">Ordre des chapitres publiés <span>(Déplacer/glisser les chapitres dans l'ordre souhaité)</span></h2>
  </div>
  <form class="margTop15" action="" method="post">
    <table>
        <thead>
          <tr class="ui-state-default row">
            <th class="col-xs-3" colspan="6">Ordre d'affichage</th>
            <th class="col-xs-9" colspan="6">Titre chapitre</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($listPost as $post) { ?>
          <tr class="ui-state-default row">
            <td class="col-xs-3" colspan="6"><?php static $order = 1; echo $newOrder = $order++ ; ?></td>
            <td class="col-xs-9" colspan="6"><?= $post['title'] ?></td>
            <input type="hidden" name="" value="<?= $post['id'] ?>"> 
          </tr>
        <?php } ?>  
        </tbody>
    </table>
    <div class="margTop15">
      <input type="submit"  name="newListOrder"  value="Enregistrer l'ordre de publication" class="btn btn-primary">
      <?php if ($session->hasFlash()) echo '<span> ', $session->getFlash(), '</span>'; ?>
    </div>
  </form>
</div>
