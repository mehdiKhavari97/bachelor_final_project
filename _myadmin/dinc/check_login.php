<?php
/////////////////////////////////////////////// Check ...
if( isset($_SESSION['adminuser']) and isset($_SESSION['adminpass']) )
{

	// check user from database
	$res_admin = mysqli_query($dbc, 'select * from users_admins where 
	sha1(username)=\''.sql_quote($dbc, $_SESSION['adminuser']).'\' and sha1(password)=\''.sql_quote($dbc, $_SESSION['adminpass']).'\';');
	@ $num_admin = mysqli_num_rows($res_admin);
	if($num_admin==1)
	{
		$row_admin = mysqli_fetch_array($res_admin);
	}
	else
	{
		unset($_SESSION['adminpass']);
		unset($_SESSION['adminuser']);
		unset($_SESSION['user_ip']);
		unset($_SESSION['user_ag']);
		session_destroy();
		session_start();
		header("Location: ./login.php?check1");
		exit;
	}

	// check ip and user agent
	if( ($_SESSION['user_ag']!=$_SERVER['HTTP_USER_AGENT']) OR ($_SESSION['user_ip']!=$_SERVER['REMOTE_ADDR']) )
	{
		unset($_SESSION['adminpass']);
		unset($_SESSION['adminuser']);
		unset($_SESSION['user_ip']);
		unset($_SESSION['user_ag']);
		@ session_destroy();
			header("Location: ./login.php?check2");
		exit;
	}

}
else
{
	unset($_SESSION['adminpass']);
	unset($_SESSION['adminuser']);
	unset($_SESSION['user_ip']);
	unset($_SESSION['user_ag']);
	session_destroy();
	session_start();
	header("Location: ./login.php?check3");
	exit;
}
/////////////////////////////////////////////// Check ...
////////////////////////////////////////////// permission ...
if( isset($_GET['action']) and $row_admin['id']!=1 and strlen( stristr($row_admin['permission'], '^'.$_GET['action'].'^') )==0 )
{
	$_SESSION['msg2'] = 'دسترسی وجود ندارد.';
	header("Location: ./?errpermission");
}
////////////////////////////////////////////// permission ...