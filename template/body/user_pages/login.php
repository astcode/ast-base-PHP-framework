<section id="intro" class="intro-section">
    <div class="container">

        <?php require_once Config::get('site/base_uri').'/includes/validation_handler.php'; ?>

        <form action="" method="post">
            <div class="field">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username">
            </div>

            <div class="field">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password">
            </div>

            <div class="field">
                <label for="remember">
                    <input type="checkbox" name="remember" id="remember"> Remember me
                </label>
            </div>

            <input type="submit" value="Log in">

            <!-- This is to prevent and protect against CSRF Attacks -->
            <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
        </form>

    </div>
</section>