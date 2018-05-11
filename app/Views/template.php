<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Page Title</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <nav class="nav flex-column flex-sm-row">
        <a class="text-sm-center nav-link active" href="index.php">Home</a>
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

    <div class="container-fluid">
      <div class="row">
        <main class="col-sm-12 col-md-8">
          <?php echo $content; ?>
        </main>
        <div class="col-sm-12 col-md-4">
          <h1>test</h1>
          <ul id="side-img" class="list-group"></ul>
        </div>
      </div>
    </div>
    <footer class="footer">emerabet</footer>
    <?php echo $loadjs; ?>
    <script src="js/popup.js"></script>
    <script src="js/camera.js"></script>
    <script src="js/dragdrop.js"></script>
    <script src="js/ajax.js"></script>
</body>
</html>