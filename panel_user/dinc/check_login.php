<?php
/////////////////////////////////////////////// Check ...
if( isset($_SESSION['panel_user']) and isset($_SESSION['panel_pass']) )
{

	// check user from database
	$res_admin = mysqli_query($dbc, 'select * from users_sites where 
	sha1(username)=\''.sql_quote($dbc, $_SESSION['panel_user']).'\' and sha1(password)=\''.sql_quote($dbc, $_SESSION['panel_pass']).'\';');
	@ $num_admin = mysqli_num_rows($res_admin);
	if($num_admin==1)
	{
		$row_admin = mysqli_fetch_array($res_admin);
	}
	else
	{
		unset($_SESSION['panel_pass']);
		unset($_SESSION['panel_user']);
		//unset($_SESSION['user_ip']);
		//unset($_SESSION['user_ag']);
		//session_destroy();
		//session_start();
		header("Location: ./login.php?check1");
		exit;
	}

	// check ip and user agent
	if( ($_SESSION['user_ag']!=$_SERVER['HTTP_USER_AGENT']) OR ($_SESSION['user_ip']!=$_SERVER['REMOTE_ADDR']) )
	{
		unset($_SESSION['panel_pass']);
		unset($_SESSION['panel_user']);
		//unset($_SESSION['user_ip']);
		//unset($_SESSION['user_ag']);
		//@ session_destroy();
			header("Location: ./login.php?check2");
		exit;
	}

}
else
{
	unset($_SESSION['panel_pass']);
	unset($_SESSION['panel_user']);
	//unset($_SESSION['user_ip']);
	//unset($_SESSION['user_ag']);
	//session_destroy();
	//session_start();
	//$_SESSION['msg2'] = 'برای انجام این عملیات باید وارد شوید.';
	header("Location: ./login.php?check3");
	exit;
}
/////////////////////////////////////////////// Check ...

if (@$_GET['action']!='profile')
{
	if(strlen($row_admin['image_melli'])<5 or strlen($row_admin['image_certificate'])<5 or strlen($row_admin['flname'])<5 )
	{
		$_SESSION['msg2'] = 'مشخصات ستاره دار را کامل نمایید.';
		header("Location: ".$url."/panel_user/?action=profile");
		exit;
	}
}