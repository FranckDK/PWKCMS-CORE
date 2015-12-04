

<form class="form-signin" method="post" action="action.php?type=CONFIG&mod=Utilisateurs&fonc=Login">
        <h2 class="form-signin-heading">Veuillez vous identifier <?php echo @$_SESSION['cms_user_login']; ?></h2>
        <div class="login-wrap">
            <input type="text" id="login" name="login" class="form-control" placeholder="Login" autofocus>
            <input type="password" id="pass" name="pass" class="form-control" placeholder="Mot de passe">
            <!--<label class="checkbox">
                <input type="checkbox" value="remember-me"> Remember me
                <span class="pull-right">
                    <a data-toggle="modal" href="#myModal"> Forgot Password?</a>
                </span>
            </label>-->
            <button class="btn btn-lg btn-login btn-block" type="submit">Connexion</button>
        </div>
</form>