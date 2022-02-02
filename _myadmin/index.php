<?php
ob_start();
session_name("session2");
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
	<title>مدیریت سایت</title>
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
				<span>مدیریت سیستم</span>
			</div>

			<div class="menubox">
				<span class="titlemenu">میز کار</span>
				<a href="./" <?php if(!isset($_GET['action'])) {echo ' class="activemenu"';} ?>>داشبورد</a>
			</div>

			<div class="menubox">
				<span class="titlemenu">عملیات</span>
				<a href="./?action=orders" <?php if(isset($_GET['action']) and $_GET['action']=='orders' ) {echo ' class="activemenu"';} ?>>لیست سفارشات</a>
				<a href="./?action=users_sites" <?php if(isset($_GET['action']) and $_GET['action']=='users_sites') {echo ' class="activemenu"';} ?>>اجاره کنندگان</a>
				<a href="./?action=users_dealers" <?php if(isset($_GET['action']) and $_GET['action']=='users_dealers') {echo ' class="activemenu"';} ?>>نمایشگاه ها</a>
			</div>

			<div class="menubox">
				<span class="titlemenu">تنظیمات</span>
				<a href="./?action=settings_general" <?php if(isset($_GET['action']) and $_GET['action']=='settings_general') {echo ' class="activemenu"';} ?>>تنظیمات عمومی سایت</a>
				<a href="./?action=users_admins" <?php if(isset($_GET['action']) and $_GET['action']=='users_admins') {echo ' class="activemenu"';} ?>>مدیران سیستم</a>
				<a href="./?action=settings_ipg" <?php if(isset($_GET['action']) and $_GET['action']=='settings_ipg') {echo ' class="activemenu"';} ?>>تنظیمات درگاه بانکی</a>
				<a href="./?action=contacts" <?php if(isset($_GET['action']) and $_GET['action']=='contacts') {echo ' class="activemenu"';} ?>>پیام ها</a>
			</div>

		</div>
		<!-- elmo menu -->
		<!-- elmo menu -->

		<!-- start left bar -->
		<div id="left_bar">
			<div class="topmenu topleft">
				<span class="elmo_menu_open">&nbsp;</span>
				<span class="elmo_menu_close">&nbsp;</span>

				<a href="./login.php?do=logout" class="foat_left"><img src="./images/icons/logout.png" alt="ico"></a>
				<a href="./?action=settings_general" class="foat_left"><img src="./images/icons/settings.png" alt="ico"></a>
				<a href="../" class="foat_left" target="_blank"><img src="./images/icons/view.png" alt="ico"></a>
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
					if ($_GET['action']=='settings_general')
					{
						include('./actions/settings_general.php');
					}
					elseif ($_GET['action']=='settings_ipg')
					{
						include('./actions/settings_ipg.php');
					}
					elseif ($_GET['action']=='users_admins')
					{
						include('./actions/users_admins.php');
					}
					elseif ($_GET['action']=='users_sites')
					{
						include('./actions/users_sites.php');
					}
					elseif ($_GET['action']=='users_dealers')
					{
						include('./actions/users_dealers.php');
					}
					elseif ($_GET['action']=='orders')
					{
						include('./actions/orders.php');
					}
					elseif ($_GET['action']=='contacts')
					{
						include('./actions/contacts.php');
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