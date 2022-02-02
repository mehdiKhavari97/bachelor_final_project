<?php include('./dinc/check_login.php'); ?>
<div class="pagetitle">تنظیمات درگاه</div>


<!-- general settings -->
<?php if( !isset($_GET['do']) ) { ?>

    <?php
	echo '<form method="post" action="" class="regform">';

	echo 'مرچنت درگاه آنلاین: 
		<input type="text" name="ipg_merchant" value="'.$row_settings['ipg_merchant'].'" size="30" maxlength="150" autocomplete="off" />';

	echo ' &nbsp; <input type="submit" name="submiteditsitesettings" value="ثبت تغییرات" /><br>';
	echo '</form>';
	if(isset($_POST['submiteditsitesettings']))
	{
		$update = mysqli_query($dbc, 'update settings set 
		ipg_merchant=\''.sql_quote($dbc, $_POST['ipg_merchant']).'\'
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
