
<div class="margTop15">
  <h2>Ordre des chapitres publiés</h2>
  <p>Déplacer les chapitres dans l'ordre souhaité</p>
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
          <th class="col-xs-9" colspan="6"><?= $post['title'] ?></th>
          <input type="hidden" name="" value="<?= $post['id'] ?>"> 
        </tr>
      <?php } ?>  
      </tbody>
  </table>
  <input type="submit"  name="newListOrder"  value="Enregistrer l'ordre de publication" class="btn btn-primary margTop15"> 
</form>