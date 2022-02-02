<?php
ob_start();
session_name("session2");
session_start();
error_reporting(0);
include('../dinc/kcnf.php');
include('../dinc/sql_quote.php');
include('../dinc/jdf.php');

		/*//////////// check www...
					function curPageURL() {
					 $pageURL = 'http';
					 if (@ $_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
					 $pageURL .= "://";
					 if ($_SERVER["SERVER_PORT"] != "80") {
					  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
					 } else {
					  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
					 }
					 return $pageURL;
					}
				if(strlen(stristr(curPageURL(),$url))==0)
				{
					header('Location: '.$url.$_SERVER["REQUEST_URI"].'');
				}
		/////////////  www... */
		
//////////////////////////// Log out ...
if(@ $_GET['do']=='logout')
{
	unset($_SESSION['adminpass']);
	unset($_SESSION['adminuser']);
	unset($_SESSION['user_ip']);
	unset($_SESSION['user_ag']);
	@ session_destroy();
		header("Location: ./login.php");
	exit;
}
//////////////////////////// Log out ...
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="robots" content="index,follow" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=2.0, user-scalable=yes" />
<link rel="icon" type="image/png" href="../images/favicon.png" />
<link rel="stylesheet" type="text/css" href="./css/login.css" />
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
	<title>Login</title>
</head>
<body>

	<br style="clear: both;">

			<?php
			// msg 1
			if (isset($_SESSION['msg1']) and strlen($_SESSION['msg1'])!=0) {
				echo '<div class="msgbox1"><div style="padding:10px;">'.$_SESSION['msg1'].'</div></div>';
				unset($_SESSION['msg1']);
			}
			// msg 2
			if (isset($_SESSION['msg2']) and strlen($_SESSION['msg2'])!=0) {
				echo '<div class="msgbox2"><div style="padding:10px;">'.$_SESSION['msg2'].'</div></div>';
				unset($_SESSION['msg2']);
			}
			?>


	<div id="content">
		<div class="padding20">



	<form action="" method="post" class="loginform">
		<b style="display: block; padding: 10px; border-radius: 10px; background-color: #eee; margin-bottom: 10px; text-align: center;">مدیریت</b>
		<input type="text" placeholder="Username" name="useradmin" dir="ltr">
		<input type="password" placeholder="Password" name="passwordadmin" dir="ltr">
		<input type="submit" value="لاگین در مدیریت" name="submitloginbox">
	</form>
	<br style="clear: both;">

	<?php
	//////////////////////////// Submit ...
	if(isset($_POST['submitloginbox']) and strlen(stristr($_SERVER['HTTP_REFERER'],$url))!=0)
	{
		$res_p = mysqli_query($dbc, 'select * from users_admins where 
		username=\''.sql_quote($dbc, $_POST['useradmin']).'\';');
		@ $num_p = mysqli_num_rows($res_p);
		if($num_p==1)
		{
			$row_p = mysqli_fetch_array($res_p);
			if( password_verify($_POST['passwordadmin'],$row_p['password']) )
			{
				// ok ok ok ok
				// ok ok ok ok
				// ok ok ok ok
				$_SESSION['adminuser'] = sha1($row_p['username']);
				$_SESSION['adminpass'] = sha1($row_p['password']);
				$_SESSION['user_ip'] = $_SERVER['REMOTE_ADDR'];
				$_SESSION['user_ag'] = $_SERVER['HTTP_USER_AGENT'];
				header("Location: ./");
				exit;
				// ok ok ok ok
				// ok ok ok ok
				// ok ok ok ok
			}
			else
			{
				echo '<div style="text-align:center; padding: 20px; padding-bottom:0; color:#c00;">نام کاربری یا رمز عبور را اشتباه وارد کرده اید.</div>';
			}
		}
		else
		{
			echo '<div style="text-align:center; padding: 20px; padding-bottom:0; color:#c00;">نام کاربری یا رمز عبور را اشتباه وارد کرده اید..</div>';
		}
	}
	//////////////////////////// Submit ...
	?>

		</div>
	</div>
	<br style="clear: both;">
	<br style="clear: both;">


<script type="text/javascript" src="./js/jquery.min.js"></script>

</body>
</html>