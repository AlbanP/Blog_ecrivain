<!DOCTYPE html>
<html>
    <head>
        <title>
            <?= isset($title) ? $title : 'Blog de Jean Forteroche' ?>
        </title>  
        <meta charset="utf-8" />
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

        <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel = "stylesheet">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
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
                  changed(true);
                });
              }
            });
        </script>
    </head>
  
    <body>
        <nav class="navbar navbar-fixed-top" >
            <div class="container-fluid">
                <div class="navbar-header col-xs-9">   
                    <button type="button" class="pull-left navbar-toggle margLeft5" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse col-xs-9">           
                    <div class="container-fluid">
                        <ul class="nav navbar-nav">
                            <li><div><a href="/" class="btn btn-info navbar-btn margLeft5">Accueil</a></div></li>
                            <li><div class="margLeft5">
                                <?php if ($title != "Tableau de bord") {
                                    echo '<a href="/admin/" class="btn btn-primary navbar-btn">Tableau de bord</a>'; } ?>
                            </div></li>
                            <li><div class="margLeft5">
                                <?php if ($title != "Ajout d'un chapitre") {
                                    echo '<a href="/admin/post-add.html" class="btn btn-success navbar-btn">Ajouter un chapitre</a>'; } ?>
                            </div></li>
                            <li><div class="margLeft5">
                                <?php if ($title != "Classement") {
                                    echo '<a href="/admin/post-postOrder.html" class="btn btn-warning navbar-btn">Classer les chapitres</a>'; } ?>
                            </div></li>
                        </ul>
                    </div>  
                </div>
                <?php require __DIR__.'/../Modules/Views/_menuUser.php' ?>
            </div>
        </nav>
      
        <?= $content ?>

        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <?= isset($script) ? $script : '' ?>  
    </body>
</html>