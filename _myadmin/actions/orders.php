<?php include('./dinc/check_login.php'); ?>
<div class="pagetitle">سفارشات</div>
					
					<?php
					// settlement_pay
					// settlement_pay
					if (isset($_GET['settlement_pay']))
					{
						$res_order = mysqli_query($dbc, 'select * from orders where 
							id='.intval($_GET['settlement_pay']).'
							and settlement=1
							and payment_status=1;');
						$num_order = mysqli_num_rows($res_order);
						if($num_order==1)
						{
							$row_order = mysqli_fetch_array($res_order);

								// update
								$update = mysqli_query($dbc, 'update orders set settlement=2 where id='.$row_order['id'].';');
								if ($update)
								{
									$_SESSION['msg1'] = 'تسویه حساب با موفقیت ثبت گردید';
									header("Location: ".$_SERVER['HTTP_REFERER']);
								}
						}
					}
					// settlement_pay
					// settlement_pay
					?>




<?php 
/////////////////////// Pages ...
@ $page = intval($_GET['p']);
$max = 30;
if(@ strlen($_GET['p'])==0 or @ $_GET['p']=='0')
{
	$first = 0;
	$page = 1;
}
else
{
	$first = $page*$max-$max;
}
/////////////////////// Pages ...
?>
<br>
<table cellpadding="1" cellspacing="1" class="tablelist" width="90%" style="margin-right: auto; margin-left: auto;">
	<tr>
		<th width="10%">وضعیت</th>
		<th align="right">شرح&nbsp;سفارش</th>
		<th width="10%">تاریخ</th>
	</tr>
	<?php
	$res_orders = mysqli_query($dbc, 'select * from orders order by id desc limit '.$first.','.$max.';');
	$queryall = 'select count(id) from orders;';
	$num_orders = mysqli_num_rows($res_orders);
	if($num_orders==0)
	{
		echo '
		<tr>
			<td colspan="3" align="center">تراکنشی وجود ندارد</td>
		</tr>';
	}
	for ($i=0; $i < $num_orders; $i++) { 
		$row_orders = mysqli_fetch_array($res_orders);
		echo '
		<tr>
			<td align="center">
			#'.$row_orders['id'].'<br>
			'.entofa(number_format($row_orders['payment_price'])).'ت';
			if ($row_orders['payment_status']==1)
			{
				echo '<br><font color="green" style="font-size:10px;">پرداخت&zwnj;شده</font>';
				if($row_orders['settlement']==1)
				{
					echo '<br>
					<a href="./?action=orders&settlement_pay='.$row_orders['id'].'" class="a_button_blue" style="font-size:10px; padding: 3px 7px; height:18px; line-height:18px;">ثبت&zwnj;تسویه</a>';
				}
				elseif($row_orders['settlement']==2)
				{
					echo '<br><font color="green" style="font-size:10px;">تسویه&zwnj;شده</font>';
				}
			}
			else
			{
				echo '<br><font color="red" style="font-size:10px;">پرداخت&zwnj;نشده</font>';
			}
			echo '
			</td>
			<td align="right">';
					$num_u = 0;
					if ($row_orders['userid']!=0) {
						$res_u = mysqli_query($dbc, 'select * from users_sites where id='.$row_orders['userid'].';');
						@$num_u = mysqli_num_rows($res_u);
						if($num_u==1) 
						{							
							@ $row_u = mysqli_fetch_array($res_u);
							echo '<i style="color:#666; font-style: normal; font-weight:300; font-size:12px;"><b>اجاره کننده:</b> '.$row_u['flname'].'('.$row_u['username'].')</i><br>';
						}
					}

					$num_car = 0;
					if ($row_orders['userid']!=0) {
						$res_car = mysqli_query($dbc, 'select * from cars where id='.$row_orders['carid'].';');
						@$num_car = mysqli_num_rows($res_car);
						if($num_car==1) 
						{							
							@ $row_car = mysqli_fetch_array($res_car);
							echo '<i style="color:#666; font-style: normal; font-weight:300; font-size:12px;"><b>خودرو:</b> '.$row_car['name'].'/'.$row_car['color'].'</i><br>';
						}
					}

					$num_d = 0;
					if ($row_orders['userid']!=0) {
						$res_d = mysqli_query($dbc, 'select * from users_dealers where id='.$row_orders['dealerid'].';');
						@$num_d = mysqli_num_rows($res_d);
						if($num_d==1) 
						{							
							@ $row_d = mysqli_fetch_array($res_d);
							echo '<i style="color:#666; font-style: normal; font-weight:300; font-size:12px;"><b>نمایشگاه:</b> '.$row_d['dealer_name'].'('.$row_d['username'].')</i><br>';
						}
					}
					if ($row_orders['delivery']==1) {
						echo '<i style="color:#666; font-style: normal; font-weight:300; font-size:12px;"><b>تحویل:</b> حضوری</i><br>';
					}
					if ($row_orders['delivery']==2) {
						echo '<i style="color:#666; font-style: normal; font-weight:300; font-size:12px;"><b>تحویل:</b> درب منزل';
						if( strlen($row_orders['lat'])>4 )
						{
							echo ' » <a href="https://www.google.com/maps/search/?api=1&query='.$row_orders['lat'].','.$row_orders['lng'].'" target="_blank">لوکیشن</a>';
						}
						echo '</i><br>';
					}

					if ( strlen($row_orders['payment_details'])!=0 )
					{
						echo '<i style="color:#666; font-style: normal; font-weight:300; font-size:12px;"><b>شرح پرداخت:</b> '.$row_orders['payment_details'].'</i><br>';
					}
					echo '
					</td>
			<td align="center">
			شروع:
				<div dir="ltr">'.jdate('Y-m-d/H:i', $row_orders['time_start']).'</div>
			پایان:
				<div dir="ltr">'.jdate('Y-m-d/H:i', $row_orders['time_expire']).'</div>
			</td>
		</tr>';
	}
	?>
</table>

<?php
/////////////////////// Pages ...
$resall = mysqli_query($dbc, $queryall);
if(!$resall) echo 'Database Error page Numbers';
@ $rowall = mysqli_fetch_array($resall);
$numall = $rowall['count(id)'];
if($numall>$max)
{
	echo '<div style="margin-top:7px;"><div style="float:left; padding-top:8px; padding-left:10px;" dir="ltr">Pages : &nbsp;</div>';
	$pages = ceil($numall/$max);
	if($page>4 and $pages>5)
	{
		echo '<a href="./?action=orders&p=1" class="pagenum">1</a><div style="float:left; line-height:28px;">&nbsp;...&nbsp;</div>';
	}
	if(ceil($numall/$max)>4){$num=5;}else{$num=ceil($numall/$max);}
	for($i=0;$i<$num;$i++)
	{
		$p = $i+1;
		if($page>4 and $pages>5){$p=$i+$page-2;}
		if($page>4 and $pages>5 and $page==(ceil($numall/$max)-2)){$p=$i+$page-3;}
		if($page>4 and $pages>5 and $page==(ceil($numall/$max)-1)){$p=$i+$page-4;}
		if($page>4 and $pages>5 and $page==(ceil($numall/$max)-0)){$p=$i+$page-5;}
		if(strlen($page)==0){$page=1;}
		echo '<a';
		if($p==$page) { echo ' style="color:#ffffff; border:1px solid #555555; background: #636363;"';}
		echo ' href="./?action=orders&p='.$p.'" class="pagenum">'.$p.'</a>';
	}
	if(ceil($numall/$max)>6 and $page<(ceil($numall/$max)-2)){echo '<div style="float:left; line-height:28px;">&nbsp;...&nbsp;</div>';}
	if(ceil($numall/$max)>5){
		echo '<a href="./?action=orders&p='.ceil($numall/$max).'" class="pagenum"';
			if(ceil($numall/$max)==$page) {
			echo ' style="color:#ffffff; border:1px solid #555555; background: #636363;"';
			}
		echo ' >'.ceil($numall/$max).'</a>';
		}
	echo '<br style="clear:both;" /></div>';
}
/////////////////////// Pages ...
echo '<br style="clear:both;" />';
?>
<br>