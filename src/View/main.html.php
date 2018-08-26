<?php
$title = 'Chat';
$displayLogout = true;
?>
<?php ob_start() ?>

<div class="chat">
    <?php
    /** @var \Model\Message $message */
    foreach ($vars['messages'] as $message) { ?>
        <div class="message">
            <span class="login"><?php echo htmlspecialchars($message->getUser()->getLogin()); ?>
             (<?php echo $message->getCreatedAt()->format('d/m/Y H:i')?>)
            </span>
            <span class="messageContent"><?php echo htmlspecialchars($message->getMessage()); ?></span>
        </div>
    <?php
    }
    ?>
</div>

<?php foreach ($vars['errors'] as $error) { ?>
    <div class="error"><?php echo $error ?></div>
<?php } ?>

<form method="post">
    <div>Votre message</div>
    <textarea id="message-textarea" required="required" name="message"></textarea>
    <input type="submit" value="Envoyer">
</form>

<?php $content = ob_get_clean() ?>
<?php require_once __DIR__ . '/base.html.php' ?>
