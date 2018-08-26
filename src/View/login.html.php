<?php $title = 'Login' ?>
<?php ob_start() ?>

<?php if ($vars['errorMessage']) { ?>
    <div class="error"><?php echo $vars['errorMessage'] ?></div>
<?php } ?>
<form method="post">
    Identifiant : <input required="required" type="text" name="login" placeholder="Identifiant"/>
    Mot de passe : <input required="required" type="password" name="password" placeholder="Mot de passe"/>
    <input type="submit" value="Se connecter"/>
</form>

Pas de compte? <a href="?controller=AccountController&action=createAccount">Créer un compte</a>

<?php $content = ob_get_clean() ?>
<?php require_once __DIR__ . '/base.html.php' ?>
