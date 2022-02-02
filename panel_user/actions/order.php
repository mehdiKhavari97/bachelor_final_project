<?php include('./dinc/check_login.php'); ?>

<div class="pagetitle">اجاره خودرو</div>

<br>
<?php
if (isset($_GET['car']))
{
	$res_car = mysqli_query($dbc, 'select * from cars where id='.intval($_GET['car']).';');
	$num_car = mysqli_num_rows($res_car);
	if($num_car==1)
	{
		$row_car = mysqli_fetch_array($res_car);

			// dealer
			$res_dealer = mysqli_query($dbc, 'select * from users_dealers where id='.$row_car['dealerid'].';');
			$num_dealer = mysqli_num_rows($res_dealer);
			if($num_dealer==1)
			{
				$row_dealer = mysqli_fetch_array($res_dealer);
			}

		echo '
		<center>
		<a href="'.$url.'/panel_user/?action=order&car='.$row_car['id'].'" class="carbox">';

						// status checking
						$res_status = mysqli_query($dbc, 'select * from orders where carid='.$row_car['id'].' and payment_status=1 and time_expire>'.time().';');
						$num_status = mysqli_num_rows($res_status);
						if($num_status==1 or $row_car['status']!=1)
						{
							echo '<div class="rented">این خودرو در اجاره است</div>';
						}
			// image
			if(strlen($row_car['image'])>5) { $image = $row_car['image']; } else { $image = 'notfound.png'; }
			echo '<img src="'.$url.'/img/th/'.$image.'" alt="'.$row_car['name'].'" />';

			// name
			echo '<span>';
				if ($row_car['cartype']==1)
				{
					echo 'سواری <font>/</font> ';
				}
				elseif ($row_car['cartype']==2)
				{
					echo 'ون <font>/</font> ';
				}
				echo $row_car['name'].' <font>/</font> '.$row_car['color'];
			echo '</span>';
			
			//price
			echo '<p style="padding-top:0;">روزانه '.entofa(number_format($row_car['price'])).' تومان</p>';

		echo '
		</a>
		</center>
		<br>';


			$res_status = mysqli_query($dbc, 'select * from orders where carid='.$row_car['id'].' and payment_status=1 and time_expire>'.time().';');
			$num_status = mysqli_num_rows($res_status);
			if($num_status==1)
			{
				$row_status = mysqli_fetch_array($res_status);
				echo '
				<center>
					<b>این خودرو در اجاره است</b>
					<br>
					<br>
					زمان شروع اجاره  : <div dir="ltr">'.jdate('Y-m-d H:i',$row_status['time_start']).'</div>
					<br>
					زمان پایان اجاره  : <div dir="ltr">'.jdate('Y-m-d H:i',$row_status['time_expire']).'</div>
				</center>';
			}
			else
			{

							// order form
							if ($row_admin['status']==0)
							{
								echo '<div class="msgbox2" style="max-width:380px;">برای اجاره خودرو نیاز به  احراز هویت و تاییدیه مدیر دارید، در صورتیکه مشخصات خود را کامل ننموده اید به بخش پروفایل رفته و آنرا تکمیل نمایید در غیر این صورت منتظر تایید مدیر بمانید.</div>';
							}
							else
							{
								echo '
								<form method="post" action="" class="regform" enctype="multipart/form-data">

									<div class="pagetitle">فرم سفارش</div>

									مدت ( روز ) : <font color="red">*</font>
										<input type="text" name="days" id="days" autocomplete="off" maxlength="3" dir="ltr" style="text-align:center;">

										<div id="totalcost" align="center"></div>

									<div id="delivery_box" style="display:none;">
										نحوه تحویل : <font color="red">*</font>
										<select name="delivery" id="delivery_select">
											<option value="1">حضوری</option>
											<option value="2">تحویل درب  منزل</option>
										</select>
									</div>


													<div id="location_user" style="visibility:hidden; height: 0px; overflow:hidden;">
														موقعیت تحویل روی نقشه : <font color="red">*</font><br>[با حرکت دادن مارکر آبی موقعیت دقیق تحویل را مشخص کنید]
														<div id="MapLocation" style="height: 350px"></div>
															<link rel="stylesheet" href="'.$url.'/js/leaflet/leaflet.css" />
															<script src="'.$url.'/js/leaflet/leaflet.js"></script>
														<input type="hidden" id="Latitude" placeholder="Latitude" name="lat" value="'.$row_admin['lat'].'" />
														<input type="hidden" id="Longitude" placeholder="Longitude" name="lng" value="'.$row_admin['lng'].'" />';
														?>
														<script type="text/javascript">
														$(function() {
														  // use below if you want to specify the path for leaflet's images
														  //L.Icon.Default.imagePath = '@Url.Content("~/Content/img/leaflet")';

														  <?php
														  if(strlen($row_admin['lat'])>5 and strlen($row_admin['lng'])>5)
														  {
														  		echo 'var curLocation = ['.$row_admin['lat'].', '.$row_admin['lng'].'];';
														  }
														  else
														  {
														  		echo 'var curLocation = [0, 0];';
														  }
														  ?>
														  // use below if you have a model
														  // var curLocation = [@Model.Location.Latitude, @Model.Location.Longitude];

														  if (curLocation[0] == 0 && curLocation[1] == 0) {
														    curLocation = [32.17751245743296, 53.2934810113244];
														  }

														  <?php
														  if(strlen($row_admin['lat'])>5 and strlen($row_admin['lng'])>5)
														  {
														  		echo "var map = L.map('MapLocation').setView(curLocation, 16);";
														  }
														  else
														  {
														  		echo "var map = L.map('MapLocation').setView(curLocation, 5);";
														  }
														  ?>
														  

														  L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
														    attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
														  }).addTo(map);

														  map.attributionControl.setPrefix(false);

														  var marker = new L.marker(curLocation, {
														    draggable: 'true'
														  });

														  marker.on('dragend', function(event) {
														    var position = marker.getLatLng();
														    marker.setLatLng(position, {
														      draggable: 'true'
														    }).bindPopup(position).update();
														    $("#Latitude").val(position.lat);
														    $("#Longitude").val(position.lng).keyup();
														  });

														  $("#Latitude, #Longitude").change(function() {
														    var position = [parseInt($("#Latitude").val()), parseInt($("#Longitude").val())];
														    marker.setLatLng(position, {
														      draggable: 'true'
														    }).bindPopup(position).update();
														    map.panTo(position);
														  });

														  map.addLayer(marker);
														})
														</script>
														<br>
														<?php
														echo '

													</div>
										';

										echo '
										<div align="center">
											<input type="submit" value="ثبت سفارش" name="submit_add_car_witouth_pay" style="width:auto; padding-left:9px; display:inline-block;">
											<input type="submit" value="ثبت سفارش و پرداخت" name="submit_add_car" style="width:auto; padding-left:9px; display:inline-block;">
										</div>
								</form>
								';
								?>
								<script type="text/javascript">

									$.fn.digits = function(){ 
									    return this.each(function(){ 
									        $(this).text( $(this).text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") ); 
									    })
									}

									$( "input#days" ).on('input', function() {

										if( $("#delivery_select").val()==2 )
										{
											var delivery_cost = <?php echo $row_dealer['delivery_cost']; ?>;
										}
										else
										{
											var delivery_cost = 0;
										}

										var days = $("input#days").val();
										var day_price = <?php echo $row_car['price']; ?>;

										var totalcost = (days*day_price)+delivery_cost;

										$("#totalcost").html("مبلغ قابل پرداخت : " + totalcost + " تومان").digits();


										if( $("input#days").val().length != 0 )
										{
											$("#delivery_box").show();
										}
										else
										{
											$("#delivery_box").hide();
										}
									});

									$( "#delivery_select" ).on('change', function() {
											if( $("input#delivery_select").val()==2 )
											{
												var delivery_cost = <?php echo $row_dealer['delivery_cost']; ?>;
												var days = $("input#days").val();
												var day_price = <?php echo $row_car['price']; ?>;

												var totalcost = (days*day_price)+delivery_cost;

												$("#totalcost").html("مبلغ قابل پرداخت : " + totalcost + " تومان").digits();
											}
											else
											{
												var days = $("input#days").val();
												var day_price = <?php echo $row_car['price']; ?>;

												var totalcost = (days*day_price);

												$("#totalcost").html("مبلغ قابل پرداخت : " + totalcost + " تومان").digits();
											}
									});


									$( "#delivery_select" ).on('change', function() {
										if( $("#delivery_select").val()==2 )
										{
											var delivery_cost = <?php echo $row_dealer['delivery_cost']; ?>;
											var days = $("input#days").val();
											var day_price = <?php echo $row_car['price']; ?>;

											var totalcost = (days*day_price)+delivery_cost;

											$("#totalcost").html("مبلغ قابل پرداخت : " + totalcost + " تومان").digits();
										}
										else
										{
											var days = $("input#days").val();
											var day_price = <?php echo $row_car['price']; ?>;

											var totalcost = (days*day_price);

											$("#totalcost").html("مبلغ قابل پرداخت : " + totalcost + " تومان").digits();
										}
									});


									$( "#delivery_select" ).on('change', function() {
										if( $("#delivery_select").val()==2 )
										{
											$("#location_user").css("visibility","visible");
											$("#location_user").css("height","auto");
										}
										else
										{
											$("#location_user").css("visibility","hidden");
											$("#location_user").css("height","0px");
										}
									});

								</script>
								<?php

								// insert
								if ( ( isset($_POST['submit_add_car']) or isset($_POST['submit_add_car_witouth_pay']) ) and $_POST['days']>0)
								{
									$time_start = time();
									$time_expire = time()+(86400*$_POST['days']);

									$payment_price = ($row_car['price']*$_POST['days']);

									if($_POST['delivery']==2)
									{
										$payment_price = $payment_price+$row_dealer['delivery_cost'];
									}

									if(strlen($_POST['lat'])==0) { $_POST['lat'] = '0'; }
									if(strlen($_POST['lng'])==0) { $_POST['lng'] = '0'; }

									$insert = mysqli_query($dbc, 'insert into orders 
										(
											carid,
											userid,
											dealerid,
											days,
											delivery,
											lat,
											lng,
											time_start,
											time_expire,
											payment_price
										)
										values
										(
											"'.$row_car['id'].'",
											"'.$row_admin['id'].'",
											"'.$row_car['dealerid'].'",
											"'.sql_quote($dbc, $_POST['days']).'",
											"'.sql_quote($dbc, $_POST['delivery']).'",
											"'.sql_quote($dbc, $_POST['lat']).'",
											"'.sql_quote($dbc, $_POST['lng']).'",
											"'.$time_start.'",
											"'.$time_expire.'",
											"'.intval($payment_price).'"
										);
										');
									if ($insert)
									{
										if( isset($_POST['submit_add_car_witouth_pay']) )
										{
											$_SESSION['msg1'] = 'سفارش با موفقیت ثبت گردید.';
											header("Location: ".$url."/panel_user/?action=orders");
											exit;
										}
										$_SESSION['msg1'] = 'سفارش با موفقیت ثبت گردید. در حال اتصال به درگاه....';
											header("Location: ".$url."/panel_user/?action=orders&pay=".mysqli_insert_id($dbc));
									}
								}
							}
			}
	}
	echo '
		<br>
		<hr>';
}
?>
<br>
<center>
	<br>
		برای انتخاب خودرو بر روی لینک زیر کلیک نمایید.
	<br>
	<br>
	<a href="../" class="a_button_blue" style="font-size: 14px;">انتخاب نمایشگاه و خودرو</a>
</center>

<br>
<br>