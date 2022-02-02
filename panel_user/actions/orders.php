<?php include('./dinc/check_login.php'); ?>
<div class="pagetitle">سفارشات</div>
					
					<?php
					// pay
					// pay
					if (isset($_GET['pay']))
					{
						$res_order = mysqli_query($dbc, 'select * from orders where id='.intval($_GET['pay']).' and payment_status=0 and userid='.$row_admin['id'].';');
						$num_order = mysqli_num_rows($res_order);
						if($num_order==1)
						{
							$row_order = mysqli_fetch_array($res_order);
							echo '<center>در حال اتصال به درگاه...'.$row_order['payment_price'].'</center>';

									//error_reporting(E_ALL);
									// zzarinpal
									$MerchantID =  'a45ae40b-eea4-402a-9f3c-2acca2f98849';  //Required
									$Amount = $row_order['payment_price']; //Amount will be based on Toman  - Required
									$Description = 'ثبت سفارش';  // Required
									$Email = @ $row_admin['address']; // Optional
									$CallbackURL = $url.'/user_panel/verify.php?apn=zarinpal&cid='.$row_order['id'].'&rnd='.rand(0,99999).'&amount='.$Amount;  // Required
									
									
									//$client = new SoapClient('https://ir.zarinpal.com/pg/services/WebGate/wsdl', array('encoding' => 'UTF-8')); 
									$client = new SoapClient('https://ir.zarinpal.com/pg/services/WebGate/wsdl', array('encoding' => 'UTF-8')); 
									
									$result = $client->PaymentRequest(
														array(
																'MerchantID' 	=> $MerchantID,
																'Amount' 	=> $Amount,
																'Description' 	=> $Description,
																'Email' 	=> $Email,
																'email' 	=> $email,
																'Mobile' => $Mobile,
																'CallbackURL' 	=> $CallbackURL
															)
									);
									
									
									//Redirect to URL You can do it also by creating a form
									if($result->Status == 100)
									{
										// https://www.zarinpal.com/pg/StartPay
										header('Location: https://www.zarinpal.com/pg/StartPay/'.$result->Authority);
										echo "<script> document.location=\"https://www.zarinpal.com/pg/StartPay/".$result->Authority."\";</script>";
									} else {
										echo'ERR: '.$result->Status;
									}
									// zzarinpal
						}
					}
					// pay
					// pay
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
	$res_orders = mysqli_query($dbc, 'select * from orders where userid='.$row_admin['id'].' order by id desc limit '.$first.','.$max.';');
	$queryall = 'select count(id) from orders where userid='.$row_admin['id'].';';
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
			}
			else
			{
				echo '<br><font color="red" style="font-size:10px;">پرداخت نشده</font>';
				echo '<br><a href="./?action=orders&pay='.$row_orders['id'].'" class="a_button_blue" style="font-size:10px; padding: 3px 7px; height:18px; line-height:18px;">پرداخت&zwnj;سفارش</a>';
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
						echo '<i style="color:#666; font-style: normal; font-weight:300; font-size:12px;"><b>تحویل:</b> درب منزل</i><br>';
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