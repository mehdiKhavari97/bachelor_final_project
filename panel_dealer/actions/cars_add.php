<?php include('./dinc/check_login.php'); ?>
<div class="pagetitle">ثبت خودرو</div>
<?php

$res_edit = mysqli_query($dbc, 'select * from cars where id='.intval($_GET['edit']).' and dealerid="'.$row_admin['id'].'";');
$num_edit = mysqli_num_rows($res_edit);
if($num_edit==1)
{
	$row_edit = mysqli_fetch_array($res_edit);
}


echo '
<form method="post" action="" class="regform" enctype="multipart/form-data">

	نوع خودرو : <font color="red">*</font>
	<select name="cartype">
		<option value="1"';
		if($row_edit['cartype']==1) { echo ' selected'; }
		echo '>سواری</option>
		<option value="2"';
		if($row_edit['cartype']==2) { echo ' selected'; }
		echo '>ون</option>
	</select>

	نام خودرو : <font color="red">*</font>
		<input type="text" name="name" autocomplete="off" value="'.@$row_edit['name'].'" maxlength="50">

	رنگ خودرو : <font color="red">*</font>
		<input type="text" name="color" autocomplete="off" value="'.@$row_edit['color'].'" maxlength="50">

	قیمت به ازای هر روز : <font color="red">*</font>
		<input type="text" name="price" autocomplete="off" value="'.@$row_edit['price'].'" maxlength="50" dir="ltr">

	تصویر خودرو :
		<input type="file" style="background-color:#fff;" name="image">
	';
	if($num_edit==1)
	{
		echo '
		<input type="submit" value="ویرایش خودرو" name="submit_edit_car">';
	}
	else
	{
		echo '
		<input type="submit" value="ثبت خودرو" name="submit_add_car">';
	}

echo '
</form>';

// insert
if (isset($_POST['submit_add_car']) and strlen($_POST['name'])!=0)
{
				// image
				// image
				// image
				if(strlen($_FILES['image']['name'])!=0)
				{
					$picpfile = $_FILES['image']['tmp_name'];
					$picpfile_name = time().'_'.rand(0,9999999).'.jpg';
					$filename = "../img/$picpfile_name";
					// cont type
					list($width, $height) = getimagesize($picpfile);
					$new_width = 450;
					$new_height = 450;
					$image_p = imagecreatetruecolor($new_width, $new_height);

							$exploded = explode('.',$_FILES['image']['name']);
						    $ext = $exploded[count($exploded) - 1]; 
						    if (preg_match('/jpg|jpeg/i',$ext)){$image=imagecreatefromjpeg($picpfile);}
						    else if (preg_match('/png/i',$ext)){$image=imagecreatefrompng($picpfile);}
						    else if (preg_match('/gif/i',$ext)){$image=imagecreatefromgif($picpfile);}
						    else if (preg_match('/bmp/i',$ext)){$image=imagecreatefrombmp($picpfile);}
						    else{echo 'Not Found Image Type'; exit;}

					imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
					imagejpeg($image_p,"../img/th/$picpfile_name", 90);
						// Real Size
						$realsize = getimagesize($picpfile);
						$image_p = imagecreatetruecolor($realsize[0], $realsize[1]);

							$exploded = explode('.',$_FILES['image']['name']);
						    $ext = $exploded[count($exploded) - 1]; 
						    if (preg_match('/jpg|jpeg/i',$ext)){$image=imagecreatefromjpeg($picpfile);}
						    else if (preg_match('/png/i',$ext)){$image=imagecreatefrompng($picpfile);}
						    else if (preg_match('/gif/i',$ext)){$image=imagecreatefromgif($picpfile);}
						    else if (preg_match('/bmp/i',$ext)){$image=imagecreatefrombmp($picpfile);}
						    else{echo 'Not Found Image Type'; exit;}
						    
						imagecopyresampled($image_p, $image, 0, 0, 0, 0, $realsize[0], $realsize[1], $width, $height);
						imagejpeg($image_p,"../img/$picpfile_name", 100);

					$image = $picpfile_name;
				}
				else
				{
					$image = '';
				}
				// image
				// image
				// image

	$insert = mysqli_query($dbc, 'insert into cars 
		(dealerid,name,price,image,cartype,color)
		values
		(
			"'.$row_admin['id'].'",
			"'.sql_quote($dbc, $_POST['name']).'",
			"'.intval($_POST['price']).'",
			"'.sql_quote($dbc, $image).'",
			"'.sql_quote($dbc, $_POST['cartype']).'",
			"'.sql_quote($dbc, $_POST['color']).'"
		);
		');
	if ($insert)
	{
		$_SESSION['msg1'] = 'با موفقیت ثبت گردید';
		header("Location: ".$_SERVER['HTTP_REFERER']);
	}
}

// update
if (isset($_POST['submit_edit_car']) and strlen($_POST['name'])!=0)
{
				// image
				// image
				// image
				if(strlen($_FILES['image']['name'])!=0)
				{
					$picpfile = $_FILES['image']['tmp_name'];
					$picpfile_name = time().'_'.rand(0,9999999).'.jpg';
					$filename = "../img/$picpfile_name";
					// cont type
					list($width, $height) = getimagesize($picpfile);
					$new_width = 450;
					$new_height = 450;
					$image_p = imagecreatetruecolor($new_width, $new_height);

							$exploded = explode('.',$_FILES['image']['name']);
						    $ext = $exploded[count($exploded) - 1]; 
						    if (preg_match('/jpg|jpeg/i',$ext)){$image=imagecreatefromjpeg($picpfile);}
						    else if (preg_match('/png/i',$ext)){$image=imagecreatefrompng($picpfile);}
						    else if (preg_match('/gif/i',$ext)){$image=imagecreatefromgif($picpfile);}
						    else if (preg_match('/bmp/i',$ext)){$image=imagecreatefrombmp($picpfile);}
						    else{echo 'Not Found Image Type'; exit;}

					imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
					imagejpeg($image_p,"../img/th/$picpfile_name", 90);
						// Real Size
						$realsize = getimagesize($picpfile);
						$image_p = imagecreatetruecolor($realsize[0], $realsize[1]);

							$exploded = explode('.',$_FILES['image']['name']);
						    $ext = $exploded[count($exploded) - 1]; 
						    if (preg_match('/jpg|jpeg/i',$ext)){$image=imagecreatefromjpeg($picpfile);}
						    else if (preg_match('/png/i',$ext)){$image=imagecreatefrompng($picpfile);}
						    else if (preg_match('/gif/i',$ext)){$image=imagecreatefromgif($picpfile);}
						    else if (preg_match('/bmp/i',$ext)){$image=imagecreatefrombmp($picpfile);}
						    else{echo 'Not Found Image Type'; exit;}
						    
						imagecopyresampled($image_p, $image, 0, 0, 0, 0, $realsize[0], $realsize[1], $width, $height);
						imagejpeg($image_p,"../img/$picpfile_name", 100);

					$image = $picpfile_name;
				}
				else
				{
					$image = $row_edit['image'];
				}
				// image
				// image
				// image

	$insert = mysqli_query($dbc, 'update cars set 
			name="'.sql_quote($dbc, $_POST['name']).'",
			price="'.intval($_POST['price']).'",
			image="'.sql_quote($dbc, $image).'",
			cartype="'.sql_quote($dbc, $_POST['cartype']).'",
			color="'.sql_quote($dbc, $_POST['color']).'"
		where id='.intval($_GET['edit']).' and dealerid="'.$row_admin['id'].'";
		');
	if ($insert)
	{
		$_SESSION['msg1'] = 'با موفقیت ثبت گردید';
		header("Location: ".$_SERVER['HTTP_REFERER']);
	}
}


