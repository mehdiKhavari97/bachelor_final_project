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


		نام شما : <font color="red">*</font>
			<input type="text" name="flname" autocomplete="off" value="'.$row_admin['flname'].'" maxlength="50">

		تصویر گواهینامه : <font color="red">*</font>
			<input type="file" style="background-color:#fff;" name="image_certificate" dir="ltr">

		کارت ملی یا گذرنامه : <font color="red">*</font>
			<input type="file" style="background-color:#fff;" name="image_melli" dir="ltr">

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
				$update = mysqli_query($dbc, 'update users_sites set 
					flname="'.sql_quote($dbc, $_POST['flname']).'",
					birthday="'.sql_quote($dbc, $_POST['birthday']).'",
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
						$res_p = mysqli_query($dbc, 'select * from users_sites where 
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
									$update = mysqli_query($dbc, 'update users_sites set password="'.$pass_hashed.'" where id='.$row_admin['id'].';');
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