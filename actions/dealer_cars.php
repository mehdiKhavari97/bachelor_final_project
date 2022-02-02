<div class="content_box" style="max-width: 1170px;">
	<div class="content_title">
		<?php
		echo entofa($row_dealer['dealer_name']);
		echo '<br>';
		echo '<font style="font-size:12px; font-weight:300; color:#ccc;">';
		if(strlen($row_dealer['dealer_address'])!=0) { echo 'آدرس : '.entofa($row_dealer['dealer_address']); }
		echo '<br>';
		if(strlen($row_dealer['dealer_tell'])!=0) { echo 'شماره تماس : '.entofa($row_dealer['dealer_tell']); }
		echo '</font>';
		?>		
	</div>
	<div class="padding10" align="center">
		<?php
		$res_cars = mysqli_query($dbc, 'select * from cars where dealerid='.$row_dealer['id'].';');
		$num_cars = mysqli_num_rows($res_cars);
		if ($num_cars==0)
		{
			echo '<center><br><br><i>در حال حاضر خودرویی برای این نمایشگاه ثبت نگردیده است.</i><br><br><br></center>';
		}
		for ($i=0; $i < $num_cars; $i++) {
			$row_cars = mysqli_fetch_array($res_cars);
			echo '<a href="'.$url.'/panel_user/?action=order&car='.$row_cars['id'].'" class="carbox">';

						// status checking
						$res_status = mysqli_query($dbc, 'select * from orders where carid='.$row_cars['id'].' and payment_status=1 and time_expire>'.time().';');
						$num_status = mysqli_num_rows($res_status);
						if($num_status==1 or $row_cars['status']==0)
						{
							echo '<div class="rented">این خودرو در اجاره است</div>';
						}

				// image
				if(strlen($row_cars['image'])>5) { $image = $row_cars['image']; } else { $image = 'notfound.png'; }
				echo '<img src="'.$url.'/img/th/'.$image.'" alt="'.$row_cars['name'].'" />';

				// name
				echo '<span>';
					if ($row_cars['cartype']==1)
					{
						echo 'سواری <font>/</font> ';
					}
					elseif ($row_cars['cartype']==2)
					{
						echo 'ون <font>/</font> ';
					}
					echo $row_cars['name'].' <font>/</font> '.$row_cars['color'];
				echo '</span>';
				
				//price
				echo '<p style="padding-top:0;">روزانه '.entofa(number_format($row_cars['price'])).' تومان</p>';

			echo '
			</a>';
		}
		?>
	</div>
</div>

<br>
<br>