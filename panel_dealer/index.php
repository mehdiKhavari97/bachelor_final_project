<?php
ob_start();
session_start();
error_reporting(0);
include('../dinc/kcnf.php');
include('../dinc/sql_quote.php');
include('../dinc/jdf.php');
include('./dinc/check_login.php');
?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="icon" type="image/png" href="../images/favicon.png" />
<link rel="stylesheet" type="text/css" href="./css/index.css">
<script type="text/javascript" src="./js/jquery.min.js"></script>

	<link rel="stylesheet" type="text/css" href="./js/elmo/elmo.css">
	<script type="text/javascript" src="./js/elmo/elmo.js"></script>

	<script language="javascript">
        function confirmLinkDropDB(theLink)
        {
            var confirmMsg  = 'مطمئنید حذف گردد ؟';
            // ]]>
            // Confirmation is not required in the configuration file
            // or browser is Opera (crappy js implementation)
            if (confirmMsg == '' || typeof(window.opera) != 'undefined') {
                return true;
            }
            var is_confirmed = confirm(confirmMsg);
            if (is_confirmed) {
                theLink.href;
            }
            return is_confirmed;
        }
    </script>
	<title>پنل نمایشگاه</title>
</head>
<body>
<!-- loading -->
<link href="./js/loading/loading.css" rel="stylesheet">
<div id="loading"></div>
<!-- loading -->

	<div id="mainbox">
		<span class="circlebg">&nbsp;</span>

		<!-- elmo menu -->
		<!-- elmo menu -->
		<div id="elmo_menu">

			<div class="topmenu">
				<div class="menu_in_menu">
					<span class="elmo_menu_open">&nbsp;</span>
					<span class="elmo_menu_close">&nbsp;</span>
				</div>
				<span>پنل نمایشگاه</span>
			</div>

			<div class="menubox">
				<a href="./" <?php if(!isset($_GET['action'])) {echo ' class="activemenu"';} ?>>
					داشبورد
				</a>
				<a href="./?action=cars_add" <?php if(isset($_GET['action']) and ($_GET['action']=='cars_add') ) {echo ' class="activemenu"';} ?>>
					ثبت خودرو
				</a>
				<a href="./?action=cars_list" <?php if(isset($_GET['action']) and ($_GET['action']=='cars_list') ) {echo ' class="activemenu"';} ?>>
					لیست خودروها
				</a>
				<a href="./?action=orders" <?php if(isset($_GET['action']) and ($_GET['action']=='orders') ) {echo ' class="activemenu"';} ?>>
					لیست سفارشات
				</a>
				<a href="./?action=profile" <?php if(isset($_GET['action']) and ($_GET['action']=='profile') ) {echo ' class="activemenu"';} ?>>
					ویرایش مشخصات
				</a>
				<a href="./?action=contact" <?php if(isset($_GET['action']) and ($_GET['action']=='contact') ) {echo ' class="activemenu"';} ?>>
					پیام به مدیر 
				</a>
				<a href="./?action=help" <?php if(isset($_GET['action']) and ($_GET['action']=='help') ) {echo ' class="activemenu"';} ?>>
					راهنما
				</a>
			</div>

		</div>
		<!-- elmo menu -->
		<!-- elmo menu -->

		<!-- start left bar -->
		<div id="left_bar" style="min-height: 400px;">
			<div class="topmenu topleft">
				<span class="elmo_menu_open">&nbsp;</span>
				<span class="elmo_menu_close">&nbsp;</span>


				<a href="./login.php?do=logout" class="foat_left"><img src="./images/icons/logout.png" alt="ico"></a>
				<a href="./?action=profile" class="foat_left"><img src="./images/icons/settings.png" alt="ico"></a>
				<a href="../" class="foat_left" target="_blank"><img src="./images/icons/view.png" alt="ico"></a>
				<span class="elmo_menu_span"><?php echo entofa($row_admin['username']); ?></span>

			</div>
			<div class="padding10">


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
			?>


				<?php
				if (isset($_GET['action']))
				{
					if ($_GET['action']=='cars_add')
					{
						include('./actions/cars_add.php');
					}
					elseif ($_GET['action']=='cars_list')
					{
						include('./actions/cars_list.php');
					}
					elseif ($_GET['action']=='orders')
					{
						include('./actions/orders.php');
					}
					elseif ($_GET['action']=='profile')
					{
						include('./actions/profile.php');
					}
					elseif ($_GET['action']=='contact')
					{
						include('./actions/contact.php');
					}
					elseif ($_GET['action']=='help')
					{
						include('./actions/help.php');
					}
				}
				else
				{
					include('actions/home.php');
				}
				?>

			</div>
		</div>
		<!-- end left bar -->


	</div>
	<br><br>

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