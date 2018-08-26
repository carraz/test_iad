<?php $title = 'Création de compte' ?>
<?php ob_start() ?>

<?php foreach ($vars['errors'] as $error) { ?>
    <div class="error"><?php echo $error ?></div>
<?php } ?>
<form method="post">
    Identifiant : <input required="required" type="text" name="login" placeholder="Identifiant"/>
    Mot de passe : <input required="required" type="password" name="plainPassword" placeholder="Mot de passe"/>
    Répéter le mot de passe :
    <input required="required" type="password" name="passwordRepeat" placeholder="Mot de passe"/>
    <input type="submit" value="Créer le compte"/>
</form>

<?php $content = ob_get_clean() ?>
<?php require_once __DIR__ . '/base.html.php' ?>
