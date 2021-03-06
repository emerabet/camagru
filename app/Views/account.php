<div class="row justify-content-md-center">
    <form method="POST" action="index.php?p=user.update" class="col col-sm-12 col-md-5">
        <input type="hidden" name="token" value="<?php echo htmlspecialchars($my_token); ?>" />
        
        <div class="form-group row">
        <label for="inputUsername" class="sr-only">Pseudo</label>
        <input type="text" id="inputUsername" name="pseudo" class="form-control" placeholder="Pseudo" value="<?php echo htmlspecialchars($my_user['name']); ?>" required autofocus>
        </div>

        <div class="form-group row">
        <label for="inputEmail" class="sr-only">Email</label>
        <input type="email" id="inputEmail" name="email" class="form-control" value="<?php echo htmlspecialchars($my_user['email']); ?>" placeholder="Email" required>
        </div>

        <div class="form-group row">
        <div class="form-check">
        <input type="checkbox" name="notif" class="form-check-input" id="chkNotif" <?php if ($my_user['notif'] == 1): ?>checked<?php endif; ?>>
            <label class="form-check-label" for="exampleCheck1">Je veux être notifié des commentaires</label>
        </div>
        </div>
       
        <div class="form-group row">
        <div class="form-check">
            <input type="checkbox" name="chk" class="form-check-input" id="chkAccount">
            <label class="form-check-label" for="exampleCheck1">Je veux modifier mon mot de passe</label>
        </div>
        </div>

        <div class="form-group row">
        <label for="inputPassword" class="sr-only">Mot de passe</label>
        <input type="password" id="inputPassword" readonly name="password" class="form-control" placeholder="Mot de passe" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="6 caracteres minimum comprenant au moins 1 chiffre, une majuscule et une minuscule">
        </div>

        <div class="form-group row">
        <label for="inputConfirmPassword" class="sr-only">Confirmation mot de passe</label>
        <input type="password" id="inputConfirmPassword" readonly name="confirmpwd" class="form-control" placeholder="Confirmation du mot de passe" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="6 caracteres minimum comprenant au moins 1 chiffre, une majuscule et une minuscule">
        </div>

        <div class="form-group row">
        <button class="btn btn-primary" name="submit" type="submit" value="OK">Mettre à jour</button>
        </div>
    </form>
</div>