<form method="POST" class="col-sm-12 col-md-5">
      <input type="hidden" name="token" value="<?php echo htmlspecialchars($my_token); ?>" />
      
      <label for="inputUsername" class="sr-only">Pseudo</label>
      <input type="text" id="inputUsername" name="pseudo" class="form-control" placeholder="Pseudo" required autofocus>

      <label for="inputEmail" class="sr-only">Email</label>
      <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email" required>
      
      <label for="inputPassword" class="sr-only">Mot de passe</label>
      <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Mot de passe" required>

      <label for="inputConfirmPassword" class="sr-only">Confirmation mot de passe</label>
      <input type="password" id="inputConfirmPassword" name="confirmpwd" class="form-control" placeholder="Confirmation du mot de passe" required>

      <button class="btn btn-primary" name="submit" type="submit" value="OK">S'inscrire</button>
</form>