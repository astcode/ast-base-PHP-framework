<section id="intro" class="intro-section">
    <div class="container">

        <?php require_once Config::get('site/base_uri').'/includes/validation_handler.php'; ?>

        <form action="" method="post">

            <div class="field">
                <label for="username">Choose a username</label>
                <input type="text" name="username" id="username" value="<?php echo escape(Input::get('username')); ?>">
            </div>

            <div class="field">
                <label for="password">Choose a password</label>
                <input type="password" name="password" id="password">
            </div>

            <div class="field">
                <label for="password_again">Enter your password again</label>
                <input type="password" name="password_again" id="password_again">
            </div>

            <div class="field">
                <label for="name">Your name</label>
                <input type="text" name="name" id="name" value="<?php echo escape(Input::get('name')); ?>">
            </div>

            <input type="submit" value="Register">

            <!-- This is to prevent and protect against CSRF Attacks -->
            <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
        </form>

    </div>
</section>