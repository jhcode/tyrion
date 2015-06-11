<head>
    <title><?= $title; ?></title>

    <!-- Responsive layout meta tag -->

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href = "<?= site_url();?>" />

    <!-- CSS Includes -->

    <link rel="stylesheet" type="text/css" href='<?= "$bootstrap_css"; ?>'/>  
    <!-- <link rel="stylesheet" type="text/css" href='<?= "$foundation_css"; ?>'/> -->  
    <link rel="stylesheet" type="text/css" href="<?= "$fa_css"; ?>">    
    
    <link rel="stylesheet" type="text/css" href='<?= "$welcome_css"; ?>'/> 

    <link rel="icon" type = "image/png" href = "<?= "$simer_ico"; ?>" />

    <!-- End of CSS Includes -->

    <!-- JS Includes -->

    <script type="text/javascript" src="<?= "$jquery_js"; ?>"></script>         

    <script type="text/javascript" src="<?= "$modernizer_js"; ?>"></script>           

    <script type="text/javascript" src='<?= "$bootstrap_js"; ?>'></script>

    <script type="text/javascript" src='<?= "$foundation_js"; ?>'></script>

    <script type="text/javascript" src='<?= "$bxslider_js"; ?>'></script>

    <script type="text/javascript" src='<?= "$app_js"; ?>'></script>

        <!-- End of JS Includes -->
    </head>
    <body>
        <?= $yield; ?>
    </body>
</html>