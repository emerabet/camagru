<?php $key = $_GET['key'] ?? "" ?>
<form method="POST" class="col-sm-12 col-md-5">
      <input type="hidden" name="token" value="<?php echo htmlspecialchars($my_token); ?>" />
      <input type="hidden" name="key" value="<?php echo htmlspecialchars($key); ?>" />

      <label for="inputPassword" class="sr-only">Mot de passe</label>
      <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Mot de passe" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="6 caracteres minimum comprenant au moins 1 chiffre, une majuscule et une minuscule">

      <label for="inputConfirmPassword" class="sr-only">Confirmation mot de passe</label>
      <input type="password" id="inputConfirmPassword" name="confirmpwd" class="form-control" placeholder="Confirmation du mot de passe" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="6 caracteres minimum comprenant au moins 1 chiffre, une majuscule et une minuscule">

      <button class="btn btn-primary" name="submit" type="submit" value="OK">Reinitialiser</button>
</form>