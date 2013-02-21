<div class="offset4">
    <form name="formConnect" id="formValidate" class="form-horizontal" method="post">
        <div class="control-group">
        <label class="control-label sstitre  required" for="username">Login</label>
        <div class="controls">
        <input type="text" id="cusername" name="username" placeholder="Login ou visiteur" data-rule-required="true" data-rule-minlength="2" data-msg-required="Le login est obligatoire" data-msg-minlength="Le login doit au moins avoir 2 caractères">
        </div>
        </div>
        <div class="control-group">
        <label class="control-label sstitre required" for="password" >Mot de passe</label>
        <div class="controls">
        <input type="password" id="cpassword" name="password" placeholder="Mot de passe"  data-rule-required="true" data-rule-minlength="2" data-msg-required="Le mot de passe est obligatoire" data-msg-minlength="Le mot de passe doit au moins avoir 2 caractères">
        </div>
        </div>
        <div class="control-group">
        <div class="controls">
        <label class="checkbox">
        <input type="checkbox"> Se souvenir de moi
        </label>
        <button type="submit" class="btn btn-primary">Connexion</button>
        </div>
        </div>
    </form>
</div>
<div class="alert alert-info">Vous pouvez vous connecter en tant que simple visiteur <b>login</b> : 'visiteur' <b>sans mot de passe</b>.</div>