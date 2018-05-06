<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Page Title</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
</head>
<body>

<nav class="nav flex-column flex-sm-row">
        <a class="text-sm-center nav-link active" href="index.php">Home</a>
        <a class="text-sm-center nav-link" href="index.php?p=photo">Montage photo</a>
        <a class="text-sm-center nav-link" href="index.php?p=login">Login</a>
        <a class="text-sm-center nav-link" href="index.php?p=register">S'inscrire</a>
    </nav>

    <div class="container-fluid">

      <div class="row">
        <main class="col-sm-12 col-md-8">
          <?php echo $content; ?>
        </main>
        <div class="col-sm-12 col-md-4">
          <h1>test</h1>
        </div>
      </div>
    </div>
  
</body>
</html>