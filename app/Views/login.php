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

<form method="POST" action="index.php?p=login.auth">
      <label for="inputPseudo" class="sr-only">Pseudo</label>
      <input type="text" id="inputPseudo" name="pseudo" class="form-control" placeholder="Pseudo" required autofocus>

      <label for="inputPassword" class="sr-only">Mot de passe</label>
      <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Mot de passe" required>
      <button class="btn btn-primary" type="submit">Connexion</button>
</form>