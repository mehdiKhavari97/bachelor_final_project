<?php
// head tags (Default)
$page_title = $row_settings['setting_title'].' - '.$row_settings['setting_hometitle']; // setting_title setting_hometitle
$page_description = $row_settings['site_description']; // site_description
$page_keywords = $row_settings['site_keywords']; // site_keywords

// include (Default)
$include = './actions/home.php';

	if (isset($_GET['action']) and $_GET['action']=='contact')
	{
		$include = ('./actions/contact.php');
		$page_title = 'ارتباط با ما - '.$row_settings['setting_title'];
	}
	elseif (isset($_GET['action']) and $_GET['action']=='terms')
	{
		$include = ('./actions/terms.php');
		$page_title = 'قوانین - '.$row_settings['setting_title'];
	}
	elseif (isset($_GET['action']) and $_GET['action']=='about')
	{
		$include = ('./actions/about.php');
		$page_title = 'درباره ما - '.$row_settings['setting_title'];
	}
	elseif (isset($_GET['action']) and $_GET['action']=='dealer_cars')
	{
		$include = ('./actions/dealer_cars.php');

		$res_dealer = mysqli_query($dbc, 'select * from users_dealers where id="'.intval($_GET['id']).'";');
		$num_dealer = mysqli_num_rows($res_dealer);
		if($num_dealer==1)
		{
			$row_dealer = mysqli_fetch_array($res_dealer);
			$page_title = $row_dealer['dealer_name'].' - '.$row_settings['setting_title'];
		}
		else
		{
			echo 'Not Found';
			exit;
		}
	}
	else
	{
		$include = ('./actions/home.php');
	}