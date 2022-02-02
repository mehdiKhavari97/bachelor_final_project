<?php include('./dinc/check_login.php'); ?>
<div class="pagetitle">تنظیمات عمومی</div>

<br>


<div class="tabsbox tabs_titles">

	<a href="./?action=settings_general" <?php if(!isset($_GET['do'])) { echo  'class="activetab"'; } ?>>تنظیمات عمومی</a>

	<a href="./?action=settings_general&do=static_about" <?php if(isset($_GET['do']) and $_GET['do']=='static_about') { echo  'class="activetab"'; } ?>>متن درباره ما</a>

	<a href="./?action=settings_general&do=static_help" <?php if(isset($_GET['do']) and $_GET['do']=='static_help') { echo  'class="activetab"'; } ?>>متن قوانین</a>

	<a href="./?action=settings_general&do=static_contact" <?php if(isset($_GET['do']) and $_GET['do']=='static_contact') { echo  'class="activetab"'; } ?>>متن تماس با ما</a>

	<a href="./?action=settings_general&do=help_pardakht" <?php if(isset($_GET['do']) and $_GET['do']=='help_pardakht') { echo  'class="activetab"'; } ?>>متن کوتاه هیدر</a>

	<a href="./?action=settings_general&do=text_dashboard" <?php if(isset($_GET['do']) and $_GET['do']=='text_dashboard') { echo  'class="activetab"'; } ?>>راهنمای اجاره کننده</a>
	<a href="./?action=settings_general&do=text_dashboard2" <?php if(isset($_GET['do']) and $_GET['do']=='text_dashboard2') { echo  'class="activetab"'; } ?>>راهنمای نمایشگاه</a>

</div>



<!-- general settings -->
<?php if( !isset($_GET['do']) ) { ?>

    <?php
	echo '<form method="post" action="" class="regform">';

	echo 'نام سایت : 
		<input type="text" name="setting_title" value="'.$row_settings['setting_title'].'" size="30" maxlength="150" autocomplete="off" />';

	echo 'عنوان صفحه اصلی : 
		<input type="text" name="setting_hometitle" value="'.$row_settings['setting_hometitle'].'" size="30" maxlength="150" autocomplete="off" />';

	echo 'دیسکریپشن گوگل : 
		<input type="text" name="site_description" value="'.$row_settings['site_description'].'" size="30" autocomplete="off" />';

	echo 'واژه های کلیدی ( جهت گوگل ) : 
		<input type="text" name="site_keywords" value="'.$row_settings['site_keywords'].'" size="30" autocomplete="off" />';


	echo 'متاتگ های اضافی : 
		<textarea name="metatags" dir="ltr">'.$row_settings['metatags'].'</textarea>';
		
	echo 'آدرس : 
		<input type="text" name="address" value="'.$row_settings['address'].'" size="30" dir="rtl" maxlength="150" autocomplete="off" />';
		
	echo 'شماره تماس : 
		<input type="text" name="phone" value="'.$row_settings['phone'].'" size="30" dir="ltr" maxlength="150" autocomplete="off" />';
		
	//echo 'شماره واتساپ : 
		//<input type="text" name="whatsapp" value="'.$row_settings['whatsapp'].'" size="30" dir="ltr" maxlength="150" autocomplete="off" />';
		
	echo 'ایمیل اصلی سایت : 
		<input type="text" name="admin_email" value="'.$row_settings['admin_email'].'" size="30" dir="ltr" maxlength="150" autocomplete="off" />';
		
	echo 'اینماد و ساماندهی : 
		<textarea name="enamad" dir="ltr">'.$row_settings['enamad'].'</textarea>';

	echo ' &nbsp; <input type="submit" name="submiteditsitesettings" value="ثبت تغییرات" /><br>';
	echo '</form>';
	if(isset($_POST['submiteditsitesettings']))
	{
		$update = mysqli_query($dbc, 'update settings set 
		setting_title=\''.sql_quote($dbc, $_POST['setting_title']).'\',
		setting_hometitle=\''.sql_quote($dbc, $_POST['setting_hometitle']).'\',
		site_description=\''.sql_quote($dbc, $_POST['site_description']).'\',
		site_keywords=\''.sql_quote($dbc, $_POST['site_keywords']).'\',
		metatags=\''.sql_quote($dbc, $_POST['metatags']).'\',
		address=\''.sql_quote($dbc, $_POST['address']).'\',
		phone=\''.sql_quote($dbc, $_POST['phone']).'\',
		whatsapp=\''.sql_quote($dbc, $_POST['whatsapp']).'\',
		admin_email=\''.sql_quote($dbc, $_POST['admin_email']).'\',
		enamad=\''.sql_quote($dbc, $_POST['enamad']).'\'
		where id=1;');
		if($update)
		{
			$_SESSION['msg1'] = 'ویرایش تنظیمات انجام گردید';
			header("Location:".$_SERVER['HTTP_REFERER']);
		}
	}
	?>

<?php } ?>
<!-- general settings -->



<!-- static_about -->
<?php if(isset($_GET['do']) and $_GET['do']=='static_about') { ?>
	<form method="post" action="" class="regform"><br>
		<!-- editor -->
		<link rel='stylesheet' href='<?php echo $url; ?>/js/qleditor/quill.snow.css'>
		<link rel="stylesheet" href="<?php echo $url; ?>/js/qleditor/style.css">
		<!-- partial:index.partial.html -->
		<div id="form-container" class="container" style="direction: rtl; text-align: right;">
				<input name="content" type="hidden">
					<div id="editor-container"><?php echo $row_settings['static_about']; ?></div>
		</div>
		<!-- partial -->
		<script src='<?php echo $url; ?>/js/qleditor/jquery.min.js'></script>
		<script src='<?php echo $url; ?>/js/qleditor/quill.min.js'></script>
		<script  src="<?php echo $url; ?>/js/qleditor/script.js"></script>
		<!-- editor -->
		<input type="submit" value="اعمال تغییرات" name="submit_static_about">
	</form>
	<?php
	if (isset($_POST['submit_static_about']))
	{
		$update = mysqli_query($dbc, 'update settings set 
		static_about=\''.sql_quote($dbc, $_POST['content']).'\'
		where id=1;');
		if($update)
		{
			$_SESSION['msg1'] = 'ویرایش تنظیمات انجام گردید';
			header("Location:".$_SERVER['HTTP_REFERER']);
		}
	}
	?>
<?php } ?>
<!-- static_about -->



<!-- static_help -->
<?php if(isset($_GET['do']) and $_GET['do']=='static_help') { ?>
	<form method="post" action="" class="regform"><br>
		<!-- editor -->
		<link rel='stylesheet' href='<?php echo $url; ?>/js/qleditor/quill.snow.css'>
		<link rel="stylesheet" href="<?php echo $url; ?>/js/qleditor/style.css">
		<!-- partial:index.partial.html -->
		<div id="form-container" class="container" style="direction: rtl; text-align: right;">
				<input name="content" type="hidden">
					<div id="editor-container"><?php echo $row_settings['static_help']; ?></div>
		</div>
		<!-- partial -->
		<script src='<?php echo $url; ?>/js/qleditor/jquery.min.js'></script>
		<script src='<?php echo $url; ?>/js/qleditor/quill.min.js'></script>
		<script  src="<?php echo $url; ?>/js/qleditor/script.js"></script>
		<!-- editor -->
		<input type="submit" value="اعمال تغییرات" name="submit_static_help">
	</form>
	<?php
	if (isset($_POST['submit_static_help']))
	{
		$update = mysqli_query($dbc, 'update settings set 
		static_help=\''.sql_quote($dbc, $_POST['content']).'\'
		where id=1;');
		if($update)
		{
			$_SESSION['msg1'] = 'ویرایش تنظیمات انجام گردید';
			header("Location:".$_SERVER['HTTP_REFERER']);
		}
	}
	?>
<?php } ?>
<!-- static_help -->




<!-- static_contact -->
<?php if(isset($_GET['do']) and $_GET['do']=='static_contact') { ?>
	<form method="post" action="" class="regform"><br>
		<!-- editor -->
		<link rel='stylesheet' href='<?php echo $url; ?>/js/qleditor/quill.snow.css'>
		<link rel="stylesheet" href="<?php echo $url; ?>/js/qleditor/style.css">
		<!-- partial:index.partial.html -->
		<div id="form-container" class="container" style="direction: rtl; text-align: right;">
				<input name="content" type="hidden">
					<div id="editor-container"><?php echo $row_settings['static_contact']; ?></div>
		</div>
		<!-- partial -->
		<script src='<?php echo $url; ?>/js/qleditor/jquery.min.js'></script>
		<script src='<?php echo $url; ?>/js/qleditor/quill.min.js'></script>
		<script  src="<?php echo $url; ?>/js/qleditor/script.js"></script>
		<!-- editor -->
		<input type="submit" value="اعمال تغییرات" name="submit_static_contact">
	</form>
	<?php
	if (isset($_POST['submit_static_contact']))
	{
		$update = mysqli_query($dbc, 'update settings set 
		static_contact=\''.sql_quote($dbc, $_POST['content']).'\'
		where id=1;');
		if($update)
		{
			$_SESSION['msg1'] = 'ویرایش تنظیمات انجام گردید';
			header("Location:".$_SERVER['HTTP_REFERER']);
		}
	}
	?>
<?php } ?>
<!-- static_contact -->




<!-- help_pardakht -->
<?php if(isset($_GET['do']) and $_GET['do']=='help_pardakht') { ?>
	<form method="post" action="" class="regform"><br>
		<div >
			<textarea name="content"><?php echo $row_settings['help_pardakht']; ?></textarea>
		</div>
		<input type="submit" value="اعمال تغییرات" name="submit_help_pardakht">
	</form>
	<?php
	if (isset($_POST['submit_help_pardakht']))
	{
		$update = mysqli_query($dbc, 'update settings set 
		help_pardakht=\''.sql_quote($dbc, $_POST['content']).'\'
		where id=1;');
		if($update)
		{
			$_SESSION['msg1'] = 'ویرایش تنظیمات انجام گردید';
			header("Location:".$_SERVER['HTTP_REFERER']);
		}
	}
	?>
<?php } ?>
<!-- help_pardakht -->



<!-- text_dashboard -->
<?php if(isset($_GET['do']) and $_GET['do']=='text_dashboard') { ?>
	<form method="post" action="" class="regform"><br>
		<!-- editor -->
		<link rel='stylesheet' href='<?php echo $url; ?>/js/qleditor/quill.snow.css'>
		<link rel="stylesheet" href="<?php echo $url; ?>/js/qleditor/style.css">
		<!-- partial:index.partial.html -->
		<div id="form-container" class="container" style="direction: rtl; text-align: right;">
				<input name="content" type="hidden">
					<div id="editor-container"><?php echo $row_settings['text_dashboard']; ?></div>
		</div>
		<!-- partial -->
		<script src='<?php echo $url; ?>/js/qleditor/jquery.min.js'></script>
		<script src='<?php echo $url; ?>/js/qleditor/quill.min.js'></script>
		<script  src="<?php echo $url; ?>/js/qleditor/script.js"></script>
		<!-- editor -->
		<input type="submit" value="اعمال تغییرات" name="submit_text_dashboard">
	</form>
	<?php
	if (isset($_POST['submit_text_dashboard']))
	{
		$update = mysqli_query($dbc, 'update settings set 
		text_dashboard=\''.sql_quote($dbc, $_POST['content']).'\'
		where id=1;');
		if($update)
		{
			$_SESSION['msg1'] = 'ویرایش تنظیمات انجام گردید';
			header("Location:".$_SERVER['HTTP_REFERER']);
		}
	}
	?>
<?php } ?>
<!-- text_dashboard -->




<!-- text_dashboard2 -->
<?php if(isset($_GET['do']) and $_GET['do']=='text_dashboard2') { ?>
	<form method="post" action="" class="regform"><br>
		<!-- editor -->
		<link rel='stylesheet' href='<?php echo $url; ?>/js/qleditor/quill.snow.css'>
		<link rel="stylesheet" href="<?php echo $url; ?>/js/qleditor/style.css">
		<!-- partial:index.partial.html -->
		<div id="form-container" class="container" style="direction: rtl; text-align: right;">
				<input name="content" type="hidden">
					<div id="editor-container"><?php echo $row_settings['text_dashboard2']; ?></div>
		</div>
		<!-- partial -->
		<script src='<?php echo $url; ?>/js/qleditor/jquery.min.js'></script>
		<script src='<?php echo $url; ?>/js/qleditor/quill.min.js'></script>
		<script  src="<?php echo $url; ?>/js/qleditor/script.js"></script>
		<!-- editor -->
		<input type="submit" value="اعمال تغییرات" name="submit_text_dashboard2">
	</form>
	<?php
	if (isset($_POST['submit_text_dashboard2']))
	{
		$update = mysqli_query($dbc, 'update settings set 
		text_dashboard2=\''.sql_quote($dbc, $_POST['content']).'\'
		where id=1;');
		if($update)
		{
			$_SESSION['msg1'] = 'ویرایش تنظیمات انجام گردید';
			header("Location:".$_SERVER['HTTP_REFERER']);
		}
	}
	?>
<?php } ?>
<!-- text_dashboard2 -->




<!-- excel -->
<?php if(isset($_GET['do']) and $_GET['do']=='excel') { ?>
	<br>
	<br>
	<center><a href="./excel_products.php">دانلود پشتیبان اکسل</a></center>

	<br style="clear:both;">
	<br style="clear:both;">
	<form method="post" class="regform" action="./dinc/ExportToExcel.class.php" enctype="multipart/form-data">
		آپلود پشتیبان محصولات:
		<input type="file" name="up_file_1" placeholder="" dir="ltr" autocomplete="off" />
		<input type="submit" name="addnewsubmit" value="ایمپورت " />
	</form>
	<br style="clear:both;">

<?php } ?>
<!-- excel -->


