<?php
ob_start();
session_start();
error_reporting(0);
include('./dinc/kcnf.php');
include('./dinc/sql_quote.php');
include('./dinc/jdf.php');
include('./dinc/operator.php');
?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="icon" href="<?php echo $url ?>/images/favicon.png" type="image/x-icon" />
<link rel="shortcut icon" href="<?php echo $url ?>/images/favicon.png" type="image/x-icon" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="robots" content="index,follow"/>
<meta name="description" content="<?php echo $page_description; ?>" />
<meta name="keywords" content="<?php echo $page_keywords; ?>" />
<meta property="og:title" content="<?php echo $page_title; ?>" />
<meta property="og:description" content="<?php echo $page_description; ?>" />
<meta property="og:image" content="<?php echo $url ?>/images/favicon.png" />
<?php if(strlen($row_settings['metatags'])>2){echo $row_settings['metatags']."\n";} ?>
<link rel="stylesheet" type="text/css" href="./style.css" />
<script type="text/javascript" src="./js/jquery.min.js"></script>
    <!-- Big Slide Menu -->
	<link rel="stylesheet" href="./js/bigslide/bigslide.css" />
	<script src="./js/bigslide/bigslide.min.js"></script>
	<script>
	    $(document).ready(function() {
		  $('.menu-link').bigSlide();
		    var bigSlideAPI = ($('.menu-link').bigSlide()).bigSlideAPI;
		    $('span.closebutton').click(function() {
		      bigSlideAPI.view.toggleClose();
		    });
	    });
	</script>
    <!-- Big Slide Menu -->
	<title><?php echo $page_title; ?></title>
</head>
<body>
<!-- loading -->
<link href="./js/loading/loading.css" rel="stylesheet">
<div id="loading"></div>
<!-- loading -->


	<!-- topmenu -->
	<div id="topmenuw">
		<div id="topmenu">

			<!-- slide menu -->
			<a href="#menu" class="menu-link ifbignone"><img src="<?php echo $url; ?>/images/menu.png" width="19" height="19" alt="menu" align="absmiddle" /> &nbsp; منو</a>
			<!-- slide menu -->

			<a href="<?php echo $url ?>" class="topmenu_link <?php if( !isset($_GET['action'])){ echo 'active';} ?>">خانه</a>
			<a href="<?php echo $url ?>/?action=terms" class="topmenu_link <?php if( isset($_GET['action']) and $_GET['action']=='terms'){ echo 'active';} ?>">قوانین</a>
			<a href="<?php echo $url ?>/?action=about" class="topmenu_link <?php if( isset($_GET['action']) and $_GET['action']=='about'){ echo 'active';} ?>">درباره ما</a>
			<a href="<?php echo $url ?>/?action=contact" class="topmenu_link <?php if( isset($_GET['action']) and $_GET['action']=='contact'){ echo 'active';} ?>">تماس با ما</a>

			<a href="<?php echo $url ?>/panel_dealer" class="topmenu_left topmenu_left_button" style="background-color: #bf5cb7" target="_blank">پنل نمایشگاه</a>
			<a href="<?php echo $url ?>/panel_user" class="topmenu_left topmenu_left_button" style="background-color: #4f8f4f" target="_blank">پنل اجاره&zwnj;کننده</a>

		</div>
	</div>
	<!-- topmenu -->

					<!-- slide menu -->
					<nav id="menu" class="panel ifbignone" role="navigation">
						<div class="title_slidemenu">منو</div>
						<span class="closebutton">&#215;</span>

						<div style="margin: 10px;">
							<a href="<?php echo $url ?>" class="slidemenulink">خانه</a>
							<a href="<?php echo $url ?>/?action=terms" class="slidemenulink">قوانین</a>
							<a href="<?php echo $url ?>/?action=about" class="slidemenulink">درباره ما</a>
							<a href="<?php echo $url ?>/?action=contact" class="slidemenulink">تماس با ما</a>
						</div>

					</nav>
					<!-- slide menu -->



	<br class="clear ifsmallnone">
	<br class="clear">


	<?php
			// msg 1
			if (isset($_SESSION['msg1']) and strlen($_SESSION['msg1'])!=0) {
				echo '<div class="msgbox1">'.$_SESSION['msg1'].'</div>';
				unset($_SESSION['msg1']);
			}
			// msg 2
			if (isset($_SESSION['msg2']) and strlen($_SESSION['msg2'])!=0) {
				echo '<div class="msgbox2">'.$_SESSION['msg2'].'</div>';
				unset($_SESSION['msg2']);
			}

	include($include);
	?>

	<!-- footer -->
	<div id="footer">

		<?php echo $row_settings['enamad']; ?>

		<br class="clear">

		<div dir="ltr">©<?php echo date('Y') ?> / All rights reserved</div>

		<br class="clear">

	</div>
	<!-- footer -->



<!-- loading -->
<script type="text/javascript">
$(window).load(function(){
	// loading fade
	$('#loading').fadeOut().delay(3000);
});
</script>
<!-- loading -->

</body>
</html>
<?php
mysqli_close($dbc);
?>