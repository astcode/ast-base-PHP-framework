<section id="intro" class="intro-section">
    <div class="container">

        <?php require_once Config::get('site/base_uri').'/includes/validation_handler.php'; ?>

        <h3><?php echo escape($data->username); ?></h3>
        <p>Full name : <?php echo escape($data->name); ?></p>
        <p>You Joined: <?php echo escape($data->joined); ?></p>
        <p>In Group #: <?php echo escape($data->group); ?></p>

    </div>
</section>