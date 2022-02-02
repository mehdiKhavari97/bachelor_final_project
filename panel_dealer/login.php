<?php
ob_start();
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
	unset($_SESSION['paneldealer_pass']);
	unset($_SESSION['paneldealer_user']);
	unset($_SESSION['user_ip']);
	unset($_SESSION['user_ag']);
	@ session_destroy();
		header("Location: ./login");
	exit;
}
//////////////////////////// Log out ...


/////////////////////////////////////////////// Check & Redirect ...
if( isset($_SESSION['paneldealer_user']) and isset($_SESSION['paneldealer_pass']) )
{
	// check user from database
	$res_admin = mysqli_query($dbc, 'select * from users_dealers where 
	sha1(username)=\''.sql_quote($dbc, $_SESSION['paneldealer_user']).'\' and sha1(password)=\''.sql_quote($dbc, $_SESSION['paneldealer_pass']).'\';');
	@ $num_admin = mysqli_num_rows($res_admin);
	if($num_admin==1)
	{
		$row_admin = mysqli_fetch_array($res_admin);
		header("Location: ./");
	}
}
/////////////////////////////////////////////// Check & Redirect ...

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
	<title>پنل کاربری</title>
</head>
<body>

	<br style="clear: both;">




	<div id="content">
		<div class="padding20">
			<div id="tabmenu">
				<a href="./login"<?php if(!isset($_GET['register'])) { echo ' class="active"';} ?>>ورود نمایشگاه</a>
				<a href="./register"<?php if(isset($_GET['register'])) { echo ' class="active"';} ?>>ثبت نام نمایشگاه</a>
			</div>
			<br style="clear: both;">
			<?php
			// msg 1
			if (isset($_SESSION['msg1']) and strlen($_SESSION['msg1'])!=0) {
				echo '<div class="msgbox1"><div>'.$_SESSION['msg1'].'</div></div>';
				unset($_SESSION['msg1']);
			}
			// msg 2
			if (isset($_SESSION['msg2']) and strlen($_SESSION['msg2'])!=0) {
				echo '<div class="msgbox2"><div>'.$_SESSION['msg2'].'</div></div>';
				unset($_SESSION['msg2']);
			}
			?>
							<?php
							if(isset($_GET['msg']) and $_GET['msg']==5)
							{
								echo '<div class="msgbox1">حساب کاربری شما فعال گردید، می توانید وارد سایت شوید</div><br />';
							}
							if(isset($_GET['msg']) and $_GET['msg']==6)
							{
								echo '<div class="msgbox2">همه ی گزینه ها وارد گردد</div><br />';
							}
							if(isset($_GET['msg']) and $_GET['msg']==7)
							{
								echo '<div class="msgbox2">ایمیل را به طور صحیح وارد نمایید</div><br />';
							}
							if(isset($_GET['msg']) and $_GET['msg']==8)
							{
								echo '<div class="msgbox2">رمز عبور بیشتر از 5 حرف باشد</div><br />';
							}
							if(isset($_GET['msg']) and $_GET['msg']==9)
							{
								echo '<div class="msgbox2">تکرار رمز عبور صحیح نیست</div><br />';
							}
							if(isset($_GET['msg']) and $_GET['msg']==10)
							{
								echo '<div class="msgbox2">تصویر امنیتی را صحیح وارد نکرده اید</div><br />';
							}
							if(isset($_GET['msg']) and $_GET['msg']==11)
							{
								echo '<div class="msgbox1">ثبت نام شما با موفقیت انجام شد، میتوانید وارد گردید</div><br />';
							}
							if(isset($_GET['msg']) and $_GET['msg']==12)
							{
								echo '<div class="msgbox1">ثبت نام شما با موفقیت انجام شد [مشکل در ارسال ایمیل فعال سازی]</div><br />';
							}
							if(isset($_GET['msg']) and $_GET['msg']==13)
							{
								echo '<div class="msgbox2">این نام کاربری قبلا ثبت شده است</div><br />';
							}
							?>

<?php
if(isset($_GET['register']))
{
	// register
	// register
?>


					<form action="" method="post" class="loginform" style="padding-top: 9px;">
						موبایل (نام کاربری) :
						<input type="text" placeholder="Mobile" name="username" maxlength="11" dir="ltr">
						نام شما :
						<input type="text" placeholder="Your Name" name="fnamelname" dir="rtl">
						ایمیل :
						<input type="text" placeholder="Email" name="address" dir="ltr">
						رمز عبور :
						<input type="password" placeholder="Password" name="password" dir="ltr">
						تکرار رمز عبور :
						<input type="password" placeholder="Repeat Password" name="re_password" dir="ltr">

						<br>
						<br>
   						<script src="https://www.google.com/recaptcha/api.js" async defer></script>
   						<div class="g-recaptcha" data-sitekey="6Lf09PEZAAAAALytAYkilvll-xpu1WIwmnQKLwzi"></div>
   						<br>
						<input type="submit" value="ثبت نام" name="registersubmit">
					</form>
					<br style="clear: both;">

					<?php
					//////////////////////////// Submit ...
					if(isset($_POST['registersubmit']) and strlen(stristr($_SERVER['HTTP_REFERER'],$url))!=0)
					{
						// captcha
						// captcha
						// captcha						
							//handle captcha response
							$captcha = $_REQUEST['g-recaptcha-response'];
							$handle = curl_init('https://www.google.com/recaptcha/api/siteverify');
							curl_setopt($handle, CURLOPT_POST, true);
							curl_setopt($handle, CURLOPT_POSTFIELDS, "secret=6Lf09PEZAAAAABFy30TmDYEjW2K966dnlCrBGWLe&response=$captcha");
							curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
							$response = curl_exec($handle);
							$explodedArr = explode(",",$response);
							$doubleExplodedArr = explode(":",$explodedArr[0]);
							$captchaConfirmation = end($doubleExplodedArr);
							print_r($doubleExplodedArr);
							if ( trim($captchaConfirmation) != "true" ) {
								$_SESSION['msg2'] = 'کپچا را صحیح وارد نمایید.';
								header('Location: ./register');
								exit;
							}
						// captcha
						// captcha
						// captcha


						if(strlen($_POST['password'])==0 or strlen($_POST['re_password'])==0 or strlen($_POST['fnamelname'])==0 or strlen($_POST['username'])==0)
						{
							header('Location: ./register?msg=6');
						}
						else
						{
								if(strlen($_POST['password'])<5)
								{
									header('Location: ./register?msg=8');
								}
								else
								{
									if(!($_POST['password']===$_POST['re_password']))
									{
										header('Location: ./register?msg=9');
									}
									else
									{
											////////////////////////// Random Code 
												$characters = array(
												"A","B","C","D","E","F","G","H","J","K","L","M",
												"N","P","Q","R","S","T","U","V","W","X","Y","Z",
												"1","2","3","4","5","6","7","8","9");
												
												$keys = array();
												
												while(count($keys) < 15) {
													$x = mt_rand(0, count($characters)-1);
													if(!in_array($x, $keys)) {
													   $keys[] = $x;
													}
												}
												
												foreach($keys as $key){
												   $random_chars .= $characters[$key];
												}
											////////////////////////// Random Code
												$pass_hashed = password_hash(fatoen($_POST['password']), PASSWORD_BCRYPT, array('cost'=>12));
												$rand_hashed = password_hash(fatoen($random_chars), PASSWORD_BCRYPT, array('cost'=>12));
												$activeuser = sha1($random_chars.'sdc&^%$#');



											$insert = mysqli_query($dbc, 'insert into users_dealers 
											(
												username,
												address,
												password,
												approvecode,
												activeuser,
												flname,
												status
											)
											values 
											(
												\''.sql_quote($dbc,	$_POST['username']).'\',
												\''.sql_quote($dbc,	$_POST['address']).'\',
												\''.$pass_hashed.'\',
												\''.$rand_hashed.'\',
												\''.$activeuser.'\',
												\''.sql_quote($dbc, $_POST['fnamelname']).'\',
												\'1\'
											);');
													if($insert)
													{
														header('Location: ./login?msg=11');
													}
													else
													{
															header('Location: ./register?msg=13');
													}

									}
								}
						}
					}
					//////////////////////////// Submit ...
					?>

<?php
	// register
	// register
}
else
{
	// login
	// login
?>


					<form action="" method="post" class="loginform" style="padding-top: 9px;">
						<b>موبایل</b> :
						<input type="text" placeholder="Username" name="username" dir="ltr">
						<b>رمز عبور</b> :
						<input type="password" placeholder="Password" name="passwordpanel" dir="ltr">
						<br>
						<br>
						<input type="submit" value="ورود به پنل نمایشگاه" name="submitloginbox">
					</form>
					<br style="clear: both;">

					<?php
					//////////////////////////// Submit ...
					if(isset($_POST['submitloginbox']) and strlen(stristr($_SERVER['HTTP_REFERER'],$url))!=0)
					{
						$res_p = mysqli_query($dbc, 'select * from users_dealers where 
						username=\''.sql_quote($dbc, $_POST['username']).'\';');
						@ $num_p = mysqli_num_rows($res_p);
						if($num_p==1)
						{
							$row_p = mysqli_fetch_array($res_p);
							if( password_verify($_POST['passwordpanel'],$row_p['password']) )
							{
								// ok ok ok ok
								// ok ok ok ok
								// ok ok ok ok
								$_SESSION['paneldealer_user'] = sha1($row_p['username']);
								$_SESSION['paneldealer_pass'] = sha1($row_p['password']);
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

<?php
	// login
	// login
}
?>
		</div>
	</div>
	<br style="clear: both;">
	<br style="clear: both;">

<script type="text/javascript" src="./js/jquery.min.js"></script>
</body>
</html>