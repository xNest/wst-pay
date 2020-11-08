<h3>Something went wrong. Please contact shop team and tell them, you got payment error page.</h3>

<?php if(isset($errors)): ?>
    <?php foreach($errors as $type => $message): ?>

        <p><?php echo $message; ?></p>

    <?php endforeach; ?>
<?php endif; ?>
