<?php
  $where = $_GET['p'] ?? "";
  $col = $where == "photo" ? 8 : 12;
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Camagru - <?php echo $my_title; ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <nav class="nav flex-column flex-sm-row my-nav">
        <a class="text-sm-center nav-link active" href="index.php">Gallerie</a>
        <?php if ($my_logged === false): ?>
          <a class="text-sm-center nav-link" href="index.php?p=login">Login</a>
          <a class="text-sm-center nav-link" href="index.php?p=register">S'inscrire</a>
        <?php endif; 
         if ($my_logged === true): ?>
        <a class="text-sm-center nav-link" href="index.php?p=photo">Montage photo</a>
        <a class="text-sm-center nav-link" href="index.php?p=user.account">Mon compte</a>        
        <a class="text-sm-center nav-link" href="index.php?p=logout">Se déconnecter</a>
        <?php endif; ?>
    </nav>

    <div class="container-fluid my-container">
    <div id="toast" class="toast" style="display: none;"></div>
      <div class="row">
        <main class="col-sm-12 col-md-<?php echo $col; ?>">
          <?php echo $content; ?>
        </main>
        <?php if ($where == "photo"): ?>
          <div class="col-sm-12 col-md-4">
            <ul id="side-img" class="list-group"></ul>
          </div>
        <?php endif; ?>
      </div>
    </div>
    <footer class="footer">emerabet</footer>
    
    <?php echo $loadjs; ?>
    <script src="js/ajax.js"></script>
    <script src="js/popup.js"></script>
    <?php if ($where == "" || $where == "home"): ?>
      <script src="js/gallery.js"></script>
    <?php endif; ?>
    <?php if ($where == "photo.show"): ?>
      <script src="js/comment.js"></script>
    <?php endif; ?>
    <?php if ($where == "photo"): ?>
      <script src="js/camera.js"></script>
      <script src="js/dragdrop.js"></script>
    <?php endif; ?> 
</body>
</html>