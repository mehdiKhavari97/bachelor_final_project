<?php include('./dinc/check_login.php'); ?>

<?php
// Change profile
// Change profile
	if ($num_admin==1) {
		echo '
		<div style="padding:10px; background:#f7f7f7; border-radius:10px; border:1px solid #ddd;">
			<div class="pagetitle">ویرایش مشخصات</div>';
		echo '
		<br>
		<form method="post" action="" class="regform" enctype="multipart/form-data">
		موبایل شما (نام کاربری):
			<input type="text" name="username" autocomplete="off" value="'.$row_admin['username'].'" style="direction:ltr;" maxlength="11" disabled>

		نام نمایشگاه : <font color="red">*</font>
			<input type="text" name="dealer_name" autocomplete="off" value="'.$row_admin['dealer_name'].'" maxlength="50">

		شماره تماس نمایشگاه : <font color="red">*</font>
			<input type="text" name="dealer_tell" autocomplete="off" value="'.$row_admin['dealer_tell'].'" maxlength="12" dir="ltr">

		آدرس نمایشگاه : <font color="red">*</font>
			<input type="text" name="dealer_address" autocomplete="off" value="'.$row_admin['dealer_address'].'" maxlength="110">

		موقعیت نمایشگاه روی نقشه : <font color="red">*</font><br>[با حرکت دادن مارکر آبی موقعیت دقیق نمایشگاه را مشخص کنید]
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
		شماره حساب بانکی : <font color="red">*</font>
			<input type="text" name="bank_number" autocomplete="off" value="'.$row_admin['bank_number'].'" maxlength="50" dir="ltr">

		تصویر مجوز نمایشگاه : <font color="red">*</font>
			<input type="file" style="background-color:#fff;" name="image_certificate" dir="ltr">

		کارت ملی یا گذرنامه : <font color="red">*</font>
			<input type="file" style="background-color:#fff;" name="image_melli" dir="ltr">

		هزینه تحویل خودرو درب منزل : <font color="red">*</font>
			<input type="text" name="delivery_cost" autocomplete="off" value="'.$row_admin['delivery_cost'].'" maxlength="12" dir="ltr">

		نام شما : <font color="red">*</font>
			<input type="text" name="flname" autocomplete="off" value="'.$row_admin['flname'].'" maxlength="50">

		تصویر پروفایل :
			<input type="file" style="background-color:#fff;" name="image_profile" dir="ltr">

		پست الکترونیکی : 
			<input type="text" name="address" autocomplete="off" value="'.$row_admin['address'].'" style="direction:ltr;">

		تاریخ تولد : 
			<input type="text" name="birthday" autocomplete="off" value="'.$row_admin['birthday'].'" maxlength="10" placeholder="YYYY-MM-DD" dir="ltr">

			<input type="submit" value="بروزرسانی مشخصات" name="changeinfo">
		</form>
		<br>';
		echo '
		</div>
		<br>
		';

		if(isset($_POST['changeinfo']))
		{
				// image_profile
				// image_profile
				// image_profile
				if(strlen($_FILES['image_profile']['name'])!=0)
				{
					$picpfile = $_FILES['image_profile']['tmp_name'];
					$picpfile_name = time().'_'.rand(0,9999999).'.jpg';
					$filename = "../img/$picpfile_name";
					// cont type
					list($width, $height) = getimagesize($picpfile);
						// Real Size
						$realsize = getimagesize($picpfile);
						$image_p = imagecreatetruecolor($realsize[0], $realsize[1]);

							$exploded = explode('.',$_FILES['image_profile']['name']);
						    $ext = $exploded[count($exploded) - 1]; 
						    if (preg_match('/jpg|jpeg/i',$ext)){$image=imagecreatefromjpeg($picpfile);}
						    else if (preg_match('/png/i',$ext)){$image=imagecreatefrompng($picpfile);}
						    else if (preg_match('/gif/i',$ext)){$image=imagecreatefromgif($picpfile);}
						    else if (preg_match('/bmp/i',$ext)){$image=imagecreatefrombmp($picpfile);}
						    else{echo 'Not Found Image Type'; exit;}
						    
						imagecopyresampled($image_p, $image, 0, 0, 0, 0, $realsize[0], $realsize[1], $width, $height);
						imagejpeg($image_p,"../img/$picpfile_name", 90);
					$res_edit = mysqli_query($dbc, 'update pages_articles set image=\''.$picpfile_name.'\' where id='.sql_quote($dbc,$_GET['edit']).';');

					$image_profile = $picpfile_name;
				}
				else
				{
					$image_profile = $row_admin['image_profile'];
				}
				// image_profile
				// image_profile
				// image_profile

				// image_melli
				// image_melli
				// image_melli
				if(strlen($_FILES['image_melli']['name'])!=0)
				{
					$picpfile = $_FILES['image_melli']['tmp_name'];
					$picpfile_name = time().'_'.rand(0,9999999).'.jpg';
					$filename = "../img/$picpfile_name";
					// cont type
					list($width, $height) = getimagesize($picpfile);
						// Real Size
						$realsize = getimagesize($picpfile);
						$image_p = imagecreatetruecolor($realsize[0], $realsize[1]);

							$exploded = explode('.',$_FILES['image_melli']['name']);
						    $ext = $exploded[count($exploded) - 1]; 
						    if (preg_match('/jpg|jpeg/i',$ext)){$image=imagecreatefromjpeg($picpfile);}
						    else if (preg_match('/png/i',$ext)){$image=imagecreatefrompng($picpfile);}
						    else if (preg_match('/gif/i',$ext)){$image=imagecreatefromgif($picpfile);}
						    else if (preg_match('/bmp/i',$ext)){$image=imagecreatefrombmp($picpfile);}
						    else{echo 'Not Found Image Type'; exit;}
						    
						imagecopyresampled($image_p, $image, 0, 0, 0, 0, $realsize[0], $realsize[1], $width, $height);
						imagejpeg($image_p,"../img/$picpfile_name", 90);
					$res_edit = mysqli_query($dbc, 'update pages_articles set image=\''.$picpfile_name.'\' where id='.sql_quote($dbc,$_GET['edit']).';');

					$image_melli = $picpfile_name;
				}
				else
				{
					$image_melli = $row_admin['image_melli'];
				}
				// image_melli
				// image_melli
				// image_melli

				// image_certificate
				// image_certificate
				// image_certificate
				if(strlen($_FILES['image_certificate']['name'])!=0)
				{
					$picpfile = $_FILES['image_certificate']['tmp_name'];
					$picpfile_name = time().'_'.rand(0,9999999).'.jpg';
					$filename = "../img/$picpfile_name";
					// cont type
					list($width, $height) = getimagesize($picpfile);
						// Real Size
						$realsize = getimagesize($picpfile);
						$image_p = imagecreatetruecolor($realsize[0], $realsize[1]);

							$exploded = explode('.',$_FILES['image_certificate']['name']);
						    $ext = $exploded[count($exploded) - 1]; 
						    if (preg_match('/jpg|jpeg/i',$ext)){$image=imagecreatefromjpeg($picpfile);}
						    else if (preg_match('/png/i',$ext)){$image=imagecreatefrompng($picpfile);}
						    else if (preg_match('/gif/i',$ext)){$image=imagecreatefromgif($picpfile);}
						    else if (preg_match('/bmp/i',$ext)){$image=imagecreatefrombmp($picpfile);}
						    else{echo 'Not Found Image Type'; exit;}
						    
						imagecopyresampled($image_p, $image, 0, 0, 0, 0, $realsize[0], $realsize[1], $width, $height);
						imagejpeg($image_p,"../img/$picpfile_name", 90);
					$res_edit = mysqli_query($dbc, 'update pages_articles set image=\''.$picpfile_name.'\' where id='.sql_quote($dbc,$_GET['edit']).';');

					$image_certificate = $picpfile_name;
				}
				else
				{
					$image_certificate = $row_admin['image_certificate'];
				}
				// image_certificate
				// image_certificate
				// image_certificate

			if( strlen($_POST['flname'])>0 /*and strlen($_POST['username'])==11*/ )
			{
				$update = mysqli_query($dbc, 'update users_dealers set 
					flname="'.sql_quote($dbc, $_POST['flname']).'",
					dealer_name="'.sql_quote($dbc, $_POST['dealer_name']).'",
					dealer_address="'.sql_quote($dbc, $_POST['dealer_address']).'",
					dealer_tell="'.sql_quote($dbc, $_POST['dealer_tell']).'",
					bank_number="'.sql_quote($dbc, $_POST['bank_number']).'",
					delivery_cost="'.sql_quote($dbc, $_POST['delivery_cost']).'",
					birthday="'.sql_quote($dbc, $_POST['birthday']).'",
					lat="'.sql_quote($dbc, $_POST['lat']).'",
					lng="'.sql_quote($dbc, $_POST['lng']).'",
					image_profile="'.sql_quote($dbc, $image_profile).'",
					image_melli="'.sql_quote($dbc, $image_melli).'",
					image_certificate="'.sql_quote($dbc, $image_certificate).'",
					address="'.sql_quote($dbc, $_POST['address']).'"
					 where id='.$row_admin['id'].';');

				if ($update)
				{
					$_SESSION['msg1'] = 'با موفقیت ویرایش گردید';
					header("Location: ./?action=profile&msg=41485");
				}
			}
			else
			{
				echo '<font color="red">گزینه ها را صحیح وارد نمایید.</font><br><br>';
			}
		}


		echo '
		<div style="padding:10px; background:#f7f7f7; border-radius:10px; border:1px solid #ddd;">
			<div class="pagetitle">تغییر رمز</div>';
		echo '
		<br>
		<form method="post" action="" class="regform">
		رمز عبور فعلی : 
			<input type="password" autocomplete="off" name="oldpassword" placeholder="رمز عبور فعلی" style="direction:ltr;">
		رمز عبور جدید :
			<input type="password" autocomplete="off" name="newpassword" placeholder="رمز عبور جدید" style="direction:ltr;">
			<input type="submit" value="تغییر رمز" name="yesandchange" />
		</form>
		<br>
		</div>
		<br>
		';

		if(isset($_POST['yesandchange']))
		{
						$res_p = mysqli_query($dbc, 'select * from users_dealers where 
						username=\''.sql_quote($dbc, $row_admin['username']).'\';');
						@ $num_p = mysqli_num_rows($res_p);
						if($num_p==1)
						{
							$row_p = mysqli_fetch_array($res_p);
							if( password_verify($_POST['oldpassword'],$row_p['password']) )
							{
								if(strlen($_POST['newpassword'])>5)
								{
									$pass_hashed = password_hash(fatoen($_POST['newpassword']), PASSWORD_BCRYPT, array('cost'=>12));
									$update = mysqli_query($dbc, 'update users_dealers set password="'.$pass_hashed.'" where id='.$row_admin['id'].';');
									if($update)
									{
										$_SESSION['msg1'] = 'با موفقیت ویرایش گردید';
										header("Location: ./?action=profile&msg=6551");
									}
									else
									{
										echo 'Ann Error';
									}
								}
								else
								{
									$_SESSION['msg2'] = 'رمز عبور جدید باید حد اقل 6 حرف باشد.';
									header("Location: ./?action=profile&msg=671");
								}
							}
							else
							{
								$_SESSION['msg2'] = 'رمز فعلی اشتباه است.';
								header("Location: ./?action=profile&msg=61");
							}
						}
		}

	}
// Change profile
// Change profile
?>