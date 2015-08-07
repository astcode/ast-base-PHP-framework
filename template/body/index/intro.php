<section id="intro" class="intro-section">
    <div class="container">

        <?php if($user->isLoggedIn()) { ?>

            <?php require_once Config::get('site/base_uri').'/includes/validation_handler.php'; ?>

                <?php // using the base_url() function in the url_helper.php file ?>
                <p>Hello <a href="<?php echo base_url(); ?>profile.php?user=<?php echo escape($user->data()->username); ?>"><?php echo escape($user->data()->username); ?></a>!</p>
                <p>Your Name : <?php echo escape($user->data()->name); ?></p>
                <p>You Joined: <?php echo escape($user->data()->joined); ?></p>
                <p>Your Group: <?php echo escape($user->data()->group); ?></p>
                <ul>
                    <li><a href="<?php echo base_url('logout.php'); ?>">            Log out</a></li>
                    <li><a href="<?php echo base_url(); ?>changepassword.php">  Change password</a></li>
                    <li><a href="<?php echo base_url(); ?>update.php">          Update details</a></li>
                </ul>

                <?php
                // echo "<pre>";
                // print_r($user);
                // echo "</pre>";

                if($user->hasPermission('admin')) {
                ?>
                    <p>You're also an admin!</p>
                <?php
                }

            } else {

            require_once Config::get('site/base_uri').'/includes/validation_handler.php';
                ?>
                <h1>Welcome to AST FrameWork</h1>
                <?php
                echo 'You need to <a href="'.base_url("login.php").'">log in</a>'.
                ' or <a href="'.base_url("register.php").'">register</a>!';
            }
        ?>
    </div>
</section>