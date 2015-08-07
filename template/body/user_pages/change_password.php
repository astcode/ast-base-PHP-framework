<section id="intro" class="intro-section">
    <div class="container">

        <?php require_once Config::get('site/base_uri').'/includes/validation_handler.php'; ?>

        <form action="" method="post">
            <div class="field">
                <label for="password_current">Current password:</label>
                <input type="password" name="password_current" id="password_current">
            </div>

            <div class="field">
            <label for="password_new">New password:</label>
                <input type="password" name="password_new" id="password_new">
            </div>

            <div class="field">
                <label for="password_new_again">New password again:</label>
                <input type="password" name="password_new_again" id="password_new_again">
            </div>

            <input type="submit" value="Change">

            <!-- This is to prevent and protect against CSRF Attacks -->
            <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
        </form>
    </div>
</section>