<div class="offset4">
    <form name="formConnect" id="formValidate" class="form-horizontal" method="post">
        <div class="form-group">
        <label class="col-md-4 control-label  required" for="username">Login</label>
        <div class="col-md-offset-4 form-control">
        <input type="text" id="cusername" name="username" placeholder="Login ou visiteur" data-rule-required="true" data-rule-minlength="2" data-msg-required="Le login est obligatoire" data-msg-minlength="Le login doit au moins avoir 2 caractères">
        </div>
        </div>
        <div class="form-group">
        <label class="col-md-4 control-label required" for="password" >Mot de passe</label>
        <div class="col-md-offset-4 form-control">
        <input type="password" id="cpassword" name="password" placeholder="Mot de passe"  data-rule-required="true" data-rule-minlength="2" data-msg-required="Le mot de passe est obligatoire" data-msg-minlength="Le mot de passe doit au moins avoir 2 caractères">
        </div>
        </div>
        <div class="form-group">
        <div class="col-md-offset-4 form-control">
        <div class="onoffswitch">
            <input type="checkbox" name="rememberme" class="onoffswitch-checkbox" id="rememberme" checked>
            <label class="onoffswitch-label" for="rememberme">
                <div class="onoffswitch-inner"></div>
                <div class="onoffswitch-switch"></div>
            </label>
        </div>
        <label class="onoffswitch-label" for="rememberme"> Se souvenir de moi 1</label>
        <button type="submit" class="btn btn-sm btn-primary">Connexion</button>
        </div>
        </div>
    </form>
</div>
<div class="alert alert-info">Vous pouvez vous connecter en tant que simple visiteur <b>login</b> : 'visiteur' <b>sans mot de passe</b>.</div>