<?php include('./dinc/check_login.php'); ?>

<div class="pagetitle">داشبورد</div>

به مدیریت سایت خوش آمدید.

<br>
<br>
<?php

//orders_1
$res_count_orders_1 = mysqli_query($dbc, 'select count(id) from orders where payment_status=1;');
@ $row_count_orders_1 = mysqli_fetch_row($res_count_orders_1);

//orders_0
$res_count_orders_0 = mysqli_query($dbc, 'select count(id) from orders where payment_status=0;');
@ $row_count_orders_0 = mysqli_fetch_row($res_count_orders_0);

?>
<table cellpadding="1" cellspacing="1" class="tablelist" width="100%" style="max-width: 300px; margin-left: auto; margin-right: auto;">
	<tr>
		<td colspan="2" align="center">آمار</td>
	</tr>	<tr>
		<th align="right">عنوان</th>
		<th align="center" width="5%">مقدار</th>
	</tr>
	<tr>
		<td align="right">نمایشگاه ها</td>
		<td align="center">
			<?php
			$res_count_users = mysqli_query($dbc, 'select count(id) from users_dealers;');
			@ $row_count_users = mysqli_fetch_row($res_count_users);
			echo entofa(number_format($row_count_users[0]));
			?>
		</td>
	</tr>
	<tr>
		<td align="right">خودرو ها</td>
		<td align="center">
			<?php
			$res_count_users = mysqli_query($dbc, 'select count(id) from cars;');
			@ $row_count_users = mysqli_fetch_row($res_count_users);
			echo entofa(number_format($row_count_users[0]));
			?>
		</td>
	</tr>
	<tr>
		<td align="right">اجاره کنندگان</td>
		<td align="center">
			<?php
			$res_count_users = mysqli_query($dbc, 'select count(id) from users_sites;');
			@ $row_count_users = mysqli_fetch_row($res_count_users);
			echo entofa(number_format($row_count_users[0]));
			?>
		</td>
	</tr>
	<tr>
		<td align="right">سفارشات پرداخت شده</td>
		<td align="center">
			<?php
			echo entofa(number_format($row_count_orders_1[0]));
			?>
		</td>
	</tr>
	<tr>
		<td align="right">سفارشات پرداخت نشده</td>
		<td align="center">
			<?php
			echo entofa(number_format($row_count_orders_0[0]));
			?>
		</td>
	</tr>
</table>
<br>
<br>