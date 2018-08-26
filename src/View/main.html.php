<?php
$title = 'Chat';
$displayLogout = true;
?>
<?php ob_start() ?>

Page principale

<?php $content = ob_get_clean() ?>
<?php require_once __DIR__ . '/base.html.php' ?>
