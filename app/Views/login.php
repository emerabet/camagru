<?php if (isset($my_verif) && $my_verif == "KO"): ?>
<div class="alert alert-warning" role="alert">
      Ce code d'activation est incorrect ou deja utilisé
</div>
<?php endif; ?>

<?php if (isset($my_verif) && $my_verif == "OK"): ?>
<div class="alert alert-success" role="alert">
      Votre compte est maintenant actif, vous pouvez vous connecter
</div>
<?php endif; ?>

<?php 
if (isset($my_errors) && count($my_errors) > 0):
      foreach ($my_errors as $key => $value): ?>

      <div class="alert alert-warning" role="alert">
            <?php echo htmlspecialchars($value); ?>
      </div>
      
<?php endforeach; endif; ?>

<div class="row justify-content-md-center">
      <form method="POST" action="index.php?p=login.auth" class="col col-sm-12 col-md-5">
            <div class="form-group row">
                  <input type="hidden" name="token" value="<?php echo htmlspecialchars($my_token); ?>" />
                        <label for="inputPseudo" class="sr-only">Pseudo</label>
                        <input type="text" id="inputPseudo" name="pseudo" class="form-control" placeholder="Pseudo" required autofocus>
            </div>
            <div class="form-group row">
                        <label for="inputPassword" class="sr-only">Mot de passe</label>
                        <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Mot de passe" required>
            </div>
            <div class="form-group row">
                  <button class="btn btn-primary" type="submit">Connexion</button>
            </div>
      </form>
</div>

<div class="row justify-content-md-center">

      <a class="col col-lg-2 my_trigger" href="javascript:;">Mot de passe oublié</a>
      <div class="my_modal">
            <div class="my_modal-content">
                  <span class="my_close-button">&times;</span>
                  <form method="POST" action="index.php?p=auth.forgot">
                        <input type="hidden" name="token" value="<?php echo htmlspecialchars($my_token); ?>" />
                        <label for="inputUsername" class="sr-only">Pseudo</label>
                        <input type="text" id="inputUsername" name="pseudo" class="form-control" placeholder="Pseudo" required autofocus>
                        <label for="inputEmail" class="sr-only">Email</label>
                        <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email" required>
                        <button class="btn btn-primary" name="submit" type="submit" value="OK">Reinitialiser</button>
                  </form>
            </div>
      </div>


</div>

