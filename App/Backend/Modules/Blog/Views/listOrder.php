  <img id="logo" class="col-xs-2" src="/img/logo.jpg" alt="Billet simple pour l'Alaska de Jean Forteroche">
  <a href="/admin/"><h1 class="col-xs-5" >Billet simple pour l'Alaska</h1></a>

<h2 class="col-xs-12">Ordre des chapitres publiés</h2>
<p class="col-xs-12">Déplacer les chapitres dans l'ordre souhaité</p>
<p>Nombre de chapitre publié : <?= $numberPost ?></p>
<form class="col-xs-12" action="" method="post">
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
  <input type="submit"  name="newListOrder"  value="Enregistrer l'ordre de publication"> 
</form>