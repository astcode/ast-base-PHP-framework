<!-- Navigation -->
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand page-scroll" href="<?php echo base_url(); ?>index.php">AST FrameWork</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav">
                <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                <!-- <li class="hidden">
                    <a class="page-scroll" href="<?php echo base_url(); ?>changepassword.php">Change Password</a>
                </li> -->
                <?php if ($user->isLoggedIn()): ?>
                    <li>
                        <a class="page-scroll" href="<?php echo base_url(); ?>update.php">Update User</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="<?php echo base_url(); ?>changepassword.php">Change Password</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="<?php echo base_url(); ?>profile.php?user=<?php echo escape($user->data()->username); ?>">View Your Profile</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="<?php echo base_url(); ?>logout.php">Log Out</a>
                    </li>
                <?php else: ?>
                    <li>
                        <a class="page-scroll" href="<?php echo base_url(); ?>login.php">Log In</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="<?php echo base_url(); ?>register.php">Register</a>
                    </li>

                <?php endif; ?>





            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
