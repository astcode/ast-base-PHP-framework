<section id="intro" class="intro-section">
    <div class="container">

        <?php require_once Config::get('site/base_uri').'/includes/validation_handler.php'; ?>

        <form action="" method="post">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" value="<?php echo escape($user->data()->name); ?>">
            <br>
            <input type="submit" value="Update">

            <!-- This is to prevent and protect against CSRF Attacks -->
            <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
        </form>

    </div>
</section>