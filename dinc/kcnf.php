<?php
date_default_timezone_set("Asia/Tehran");
// connect to database
$localhost = 'localhost';
$db = 'khodroyab';
$userdb = 'root';
$passdb = '';
$url = 'http://localhost/khodroyab'; // bedoone slashe akhar
$dbc = mysqli_connect($localhost,$userdb,$passdb,$db);
if(!$dbc)
{
	echo 'Can not Connect to Database';
	exit;
}
mysqli_query($dbc, "SET NAMES 'utf8'");
// settings
$res_settings = mysqli_query($dbc, 'select * from settings where id=1;');
$num_settings = mysqli_num_rows($res_settings);
if($num_settings==0)
{
	mysqli_query($dbc, 'insert into settings (id) values (1);');
	echo 'Can not Connect to Database settings';
	exit;
}
$row_settings = mysqli_fetch_array($res_settings);
// settings
?>