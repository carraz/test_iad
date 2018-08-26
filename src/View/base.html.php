<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title><?php echo $title ?></title>
    <link rel="stylesheet" href="public/style.css">
</head>
<body>
    <div class="header">
        <?php if ($displayLogout) { ?>
        <div class="logout">
            <a href="?controller=LoginController&action=logout">Se déconnecter</a>
        </div>
        <? } ?>
    </div>
    <div class="content">
        <?php echo $content ?>
    </div>
</body>
</html>