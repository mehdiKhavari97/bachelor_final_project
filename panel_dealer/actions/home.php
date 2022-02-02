<?php include('./dinc/check_login.php'); ?>

<div class="pagetitle">داشبورد</div>

<br>

<center>
	<br>
	<?php echo $row_admin['flname'] ?> عزیز، خوش آمدید.
	<br>
	<br>
	<a href="./?action=cars_add" class="a_button_blue" style="font-size: 14px;">ثبت خودرو</a>
</center>

<br>
<?php
if(strlen($row_settings['text_dashboard'])>20)
{
?>
<br>
<div class="calculate" style="max-width: 400px; margin-left: auto; margin-right: auto;">
	<?php echo $row_settings['text_dashboard']; ?>
</div>
<br>
<?php
}
?>