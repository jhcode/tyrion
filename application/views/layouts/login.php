<!DOCTYPE html>
<html lang="en">
    <head>
		<title><?= $title; ?></title>
		
		<!-- Css Includes -->
		<link rel="stylesheet" type="text/css" href='<?= "$login_css"; ?>'/>		
		<link rel="icon" type = "image/png" href = "<?= "$simer_ico"; ?>" />

		<!-- End Css Includes -->
		<!-- JS Includes -->

	    <script type="text/javascript" src="<?= "$jquery_js"; ?>"></script>     
		<script src='<?= "$login_js"; ?>'></script>		

		<!-- End JS Includes -->
			
    </head>

    <body>
		<?= $yield; ?>
		<div id="bottom_clouds"></div>
    </body>
</html>