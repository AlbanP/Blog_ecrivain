<!DOCTYPE html>
<html>
  <head>
    <title>
      <?= isset($title) ? $title : 'Blog de Jean Forteroche' ?>
    </title>  
    <meta charset="utf-8" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

    <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css"
         rel = "stylesheet">
    <script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
    <script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

    <link rel="stylesheet" href="/css/style.css" type="text/css" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script type="text/javascript" src="/tinymce/tinymce.min.js"></script>
    <script type="text/javascript">
      tinymce.init({
        selector : '#content',
        language : 'fr_FR',
        content_css : '/css/style.css',
        height : 500,
        menubar : false,
        statusbar : false,
        plugins: [
          "image print searchreplace fullscreen contextmenu paste imagetools",
        ],
        toolbar: ' undo redo | bold italic underline strikethrough | superscript subscript | alignleft aligncenter alignright alignjustify | outdent indent | removeformat | print | fullscreen | searchreplace  ',
        init_instance_callback: function (editor) {
          editor.on('Change', function (e) {
            changed();
          });
        }
      });
     </script>
  </head>
  
  <body>
    <div class="container-fluid">
      <nav class="row">
        <div class="navBar">
          <a href="/" class="btn btn-info">Accueil</a>
          <?php if($title != "Tableau de bord") { echo '<a href="/admin/" class="btn btnPosts">Tableau de bord</a>' ;}?>
          <?php if($title != "Ajout d'un chapitre") { echo '<a href="/admin/post-add.html" class="btn btn-success">Ajouter un chapitre</a>' ;} ?>
          <?php if($title != "Classement") { echo '<a href="/admin/post-listOrder.html" class="btn btn-warning">Classer les chapitres</a>' ;}?>
          <span class="titlePage"><?= $title ?></span>

          <?php include __DIR__.'/../Modules/Views/_menuUser.php' ?> 
        
        </div>
      </nav>
      <?= $content ?>
    </div>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="/js/modal_tooltip.js"></script>
    <script src="/js/listOrder.js"></script>
  </body>
</html>