<!DOCTYPE html>
<html>
  <head>
    <title>
      <?= isset($title) ? $title : 'Blog de Jean Forteroche' ?>
    </title>  
    <meta charset="utf-8" />
    <link <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css" type="text/css" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  
  <body>
    <div class="container-fluid"> 
      <?= $content ?>
      <footer>
        <a href="/mentionsLegales.html">Mentions légales</a>
        <a href="/admin/">Privé</a>
      </footer>
    </div>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="/js/insertComment.js"></script>
  </body>
</html>