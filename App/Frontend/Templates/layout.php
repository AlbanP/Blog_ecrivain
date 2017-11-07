<!DOCTYPE html>
<html>
  <head>
    <title>
      <?= isset($title) ? $title : 'Blog de Jean Forteroche' ?>
    </title>  
    <meta charset="utf-8" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="/css/style.css" type="text/css" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  
  <body>
    
      <?= $content ?>
      
    <div class="container-fluid margTop50">
      <footer>
        <a href="/mentionsLegales.html">Mentions légales</a>
        <a href="/admin/">Privé</a>
      </footer>
    </div>
          
    
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </body>
</html>