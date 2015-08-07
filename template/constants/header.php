<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <!-- core CSS -->
    <!-- include BOOTSTRAP min CSS files -->
    <?php IncludeFiles::includedFiles('includes/css/', 'css', ['bootstrap.min'], false) ?>

    <!-- include main CSS files -->
    <?php IncludeFiles::includedFiles('includes/css/', 'css', ['main'], false) ?>

    <!-- include font-awesome min CSS files -->
    <?php IncludeFiles::includedFiles('includes/css/', 'css', ['font-awesome.min'], false) ?>

    <!-- include responsive CSS files -->
    <?php IncludeFiles::includedFiles('includes/css/', 'css', ['responsive'], false) ?>

    <!-- include styled-elements CSS files -->
    <?php IncludeFiles::includedFiles('includes/css/', 'css', ['styled-elements'], false) ?>

    <!-- include main CSS files -->
    <?php IncludeFiles::includedFiles('includes/css/', 'css', ['scrolling-nav'], false) ?>

    <!--[if lt IE 9]>
    <script src="includes/js/html5shiv.js"></script>
    <script src="includes/js/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="includes/images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="includes/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="includes/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="includes/images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="includes/images/ico/apple-touch-icon-57-precomposed.png">

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
    <!-- include responsive CSS files -->
    <?php IncludeFiles::includedFiles('includes/js/', 'js', ['scrolling-nav'], false) ?>
</head>
<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">