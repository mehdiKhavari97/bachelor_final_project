<?php include('./dinc/check_login.php'); ?>
<div class="pagetitle">نمایشگاه ها</div>


	
	<!-- search -->
	<?php

	$saltsearch = '';
	if(isset($_GET['search']) and strlen($_GET['search'])>0)
		{ $searchtext = urldecode($_GET['search']); $saltsearch = ' where (flname LIKE "%'.sql_quote($dbc, $searchtext).'%" or username LIKE "%'.sql_quote($dbc, $searchtext).'%")'; }
		else{ $searchtext = ""; }

	if(isset($_GET['page']))
		{ $page = $_GET['page']; }
		else{ $page = ""; }

	?>
	<form action="" method="get">
		<input type="hidden" name="action" value="<?php echo $_GET['action']; ?>">
		<input type="hidden" name="page" value="<?php echo $page; ?>">
		<input type="text" name="search" value="<?php echo $searchtext; ?>" placeholder="جستجوی نمایشگاه..." class="input_small" style="width: 200px; float: right;">
		<input type="submit" value="جستجو" class="input_small_submit" style="margin-right:5px;">
	</form>
	<!-- search -->

	
<!--<a href="./?action=users_dealers&addnew" style="float: left; margin-right: 10px;" class="a_button_blue"> + اضافه نمودن نمایشگاه جدید</a>-->

<?php
// add new 
if (isset($_GET['addnew']))
{
	echo '
	<br style="clear:both;">
	<br style="clear:both;">
	<br style="clear:both;">
	<form method="post" class="regform" action="">
		<div class="pagetitle">اضافه نمودن نمایشگاه جدید</div>
		<input type="text" name="flname" placeholder="نام و نام خانوادگی نمایشگاه" autocomplete="off" />
		<input type="text" name="username" placeholder="Username..." dir="ltr" autocomplete="off" />
		<input type="text" name="password" placeholder="Password" dir="ltr" autocomplete="off" />
		<input type="submit" name="addnewsubmit" value="ثبت نمایشگاه جدید" />
	</form>
	<br style="clear:both;">
	<br style="clear:both;">
	';
	if (isset($_POST['addnewsubmit']) and strlen($_POST['flname'])!=0 and strlen($_POST['username'])!=0 and strlen($_POST['password'])!=0)
	{
		$insert = mysqli_query($dbc, 'insert into users_dealers (flname,username,password) values
			(
				"'.sql_quote($dbc, $_POST['flname']).'",
				"'.sql_quote($dbc, $_POST['username']).'",
				"'.password_hash($_POST['password'], PASSWORD_BCRYPT, array('cost'=>12)).'"
			)');
		if ($insert)
		{
			$_SESSION['msg1'] = 'با موفقیت ثبت گردید.';
			header("Location: ".$_SERVER['HTTP_REFERER']);
		}
		else
		{
			$_SESSION['msg2'] = 'نام کاربری تکراری است.';
			header("Location: ".$_SERVER['HTTP_REFERER']);
		}
	}
}
// add new

// edit
if (isset($_GET['edit']))
{
	$res_edit = mysqli_query($dbc, 'select * from users_dealers where id='.intval($_GET['edit']).';');
	$num_edit = mysqli_num_rows($res_edit);
	if ($num_edit==1) {
		$row_edit = mysqli_fetch_array($res_edit);
		echo '
		<br style="clear:both;">
		<br style="clear:both;">
		<br style="clear:both;">
		<form method="post" class="regform" action="">
			<div class="pagetitle">ویرایش نمایشگاه</div>
			<input type="text" name="flname" placeholder="نام و نام خانوادگی نمایشگاه" value="'.$row_edit['flname'].'" autocomplete="off" />
			<input type="text" name="username" placeholder="Username..." value="'.$row_edit['username'].'" dir="ltr" autocomplete="off" />
			<input type="submit" name="addnewsubmit" value="ویرایش نمایشگاه" />
		</form>
		<br style="clear:both;">
		<br style="clear:both;">
		';
		if (isset($_POST['addnewsubmit']) and strlen($_POST['flname'])!=0 and strlen($_POST['username'])!=0)
		{
			$update = mysqli_query($dbc, 'update users_dealers set
					flname="'.sql_quote($dbc, $_POST['flname']).'",
					username="'.sql_quote($dbc, $_POST['username']).'"
				where id='.$row_edit['id'].';');
			if ($update)
			{
				$_SESSION['msg1'] = 'با موفقیت ویرایش گردید.';
				header("Location: ".$_SERVER['HTTP_REFERER']);
			}
			else
			{
				$_SESSION['msg2'] = 'نام کاربری تکراری است.';
				header("Location: ".$_SERVER['HTTP_REFERER']);
			}
		}
	}
}
// edit

// change pass
if (isset($_GET['pass'])) {
	$res_pass = mysqli_query($dbc, 'select * from users_dealers where id='.intval($_GET['pass']).';');
	$num_pass = mysqli_num_rows($res_pass);
	if ($num_pass==1) {
		$row_pass = mysqli_fetch_array($res_pass);
		echo '
		<br style="clear:both;">
		<br style="clear:both;">
		<br style="clear:both;">
		<form method="post" class="regform" action="">
			<div class="pagetitle">تغییر رمز نمایشگاه</div>
			<input type="text" name="flname" placeholder="نام و نام خانوادگی نمایشگاه" value="'.$row_pass['flname'].'" autocomplete="off" disabled />
			<input type="text" name="username" placeholder="Username..." value="'.$row_pass['username'].'" dir="ltr" autocomplete="off" disabled />
			<input type="text" name="password" placeholder="Password" dir="ltr" autocomplete="off" />
			<input type="submit" name="addnewsubmit" value="تغییر رمز" />
		</form>
		<br style="clear:both;">
		<br style="clear:both;">
		';
		if (isset($_POST['addnewsubmit']) and strlen($_POST['password'])!=0)
		{
			$update = mysqli_query($dbc, 'update users_dealers set
					password="'.password_hash($_POST['password'], PASSWORD_BCRYPT, array('cost'=>12)).'"
				where id='.$row_pass['id'].';');
			if ($update)
			{
				$_SESSION['msg1'] = 'رمز با موفقیت تغییر داده شد.';
				header("Location: ".$_SERVER['HTTP_REFERER']);
			}
		}
	}
}
// change pass
?>


<?php
/////////////////////// Pages ...
@ $page = intval($_GET['page']);
$max = 30;
if(@ strlen($_GET['page'])==0 or @ $_GET['page']=='0')
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

<table class="tablelist" cellpadding="1" cellspacing="1" style="width: 100%;">
	<tr>
		<th align="center" width="3%">#</th>
		<th align="right">عنوان نمایشگاه</th>
		<th align="center" width="3%">لینک</th>
		<th align="center" width="3%">رمز</th>
		<th align="center" width="3%">ویرایش</th>
		<th align="center" width="3%">وضعیت</th>
		<th align="center" width="3%">حذف</th>
	</tr>
	<?php
	$res_list = mysqli_query($dbc, 'select * from users_dealers '.$saltsearch.' order by id desc limit '.$first.','.$max.';');
	$num_list = mysqli_num_rows($res_list);
	if ($num_list==0) {
		echo '<tr><td colspan="7" align="center">نتیجه ای یافت نشد</td></tr>';
	}
	for ($i=0; $i < $num_list; $i++) {
		$row_list = mysqli_fetch_array($res_list);

		echo '
		<tr>
			<td align="center">'.$row_list['id'].'</td>
			<td align="right" style="line-height:18px;">
				<b>کاربر : '.$row_list['flname'].'</b>
				<br>
				<font style="font-size:11px;">نام نمایشگاه : '.$row_list['dealer_name'].'</font>
				<br>
				<font style="font-size:11px;">نام کاربری : '.$row_list['username'].'</font>
				<br>';
				if (strlen($row_list['address'])!=0)
				{
					echo '<font style="font-size:11px;">ایمیل : '.$row_list['address'].'</font> &nbsp;<br>';
				}
				if(strlen($row_list['dealer_address'])!=0) { echo 'آدرس : '.($row_list['dealer_address']).'<br>'; }
				if(strlen($row_list['dealer_tell'])!=0) { echo 'شماره تماس : '.($row_list['dealer_tell']).'<br>'; }
				echo '
				<font style="font-size:11px;">شماره حساب : '.$row_list['bank_number'].'</font>
				<br>';
				if (strlen($row_list['image_profile'])!=0)
				{
					echo '<font style="font-size:11px;"><a href="'.$url.'/img/'.$row_list['image_profile'].'" target="_blank">پروفایل</a></font> &nbsp;';
				}
				if (strlen($row_list['image_melli'])!=0)
				{
					echo '<font style="font-size:11px;"><a href="'.$url.'/img/'.$row_list['image_melli'].'" target="_blank">کارت ملی</a></font> &nbsp;';
				}
				if (strlen($row_list['image_certificate'])!=0)
				{
					echo '<font style="font-size:11px;"><a href="'.$url.'/img/'.$row_list['image_certificate'].'" target="_blank">مجوز</a></font> &nbsp;';
				}
				echo '
			</td>
			<td align="center"><a href="../?action=dealer_cars&id='.$row_list['id'].'"target="_blank"><img src="./images/icons/64x64/row2/3.png" class="table_icon" /></a></td>
			<td align="center"><a href="./?action=users_dealers&page='.@$_GET['page'].'&pass='.$row_list['id'].'"><img src="./images/icons/password.png" class="table_icon" /></a></td>
			<td align="center"><a href="./?action=users_dealers&page='.@$_GET['page'].'&edit='.$row_list['id'].'"><img src="./images/icons/edit.png" class="table_icon" /></a></td>
			<td align="center"';
					if ($row_list['status']==1) {echo ' style="background:#deecd9;"';}
					if ($row_list['status']==0) {echo ' style="background:#fcc;"';}
			echo '>
					';
					if ($row_list['status']==1) {echo '<a href="./?action=users_dealers&disable='.$row_list['id'].'"><img src="./images/icons/enable.png" class="table_icon" /></a>';}
					if ($row_list['status']==0) {echo '<a href="./?action=users_dealers&enable='.$row_list['id'].'"><img src="./images/icons/disable.png" class="table_icon" /></a>';}
			echo '</td>
			<td align="center"><a href="./?action=users_dealers&delete='.$row_list['id'].'" onclick="return confirmLinkDropDB()" onclick="return confirmLinkDropDB()"><img src="./images/icons/delete.png" class="table_icon" /></a></td>
		</tr>
		';
	}
	?>
</table>
<?php
/////////////////////// Pages ...
$queryall = 'select count(id) from users_dealers '.$saltsearch.';';
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
		echo '<a href="./?action=users_dealers&search='.urlencode($searchtext).'&page=1" class="pagenum">1</a><div style="float:left; line-height:28px;">&nbsp;...&nbsp;</div>';
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
		echo ' href="./?action=users_dealers&search='.urlencode($searchtext).'&page='.$p.'" class="pagenum">'.$p.'</a>';
	}
	if(ceil($numall/$max)>6 and $page<(ceil($numall/$max)-2)){echo '<div style="float:left; line-height:28px;">&nbsp;...&nbsp;</div>';}
	if(ceil($numall/$max)>5){
		echo '<a href="./?action=users_dealers&search='.urlencode($searchtext).'&page='.ceil($numall/$max).'" class="pagenum"';
			if(ceil($numall/$max)==$page) {
			echo ' style="color:#ffffff; border:1px solid #555555; background: #636363;"';
			}
		echo ' >'.ceil($numall/$max).'</a>';
		}
	echo '<br style="clear:both;" /></div>';
}
/////////////////////// Pages ...
?>



<?php

// delete
if (isset($_GET['delete']))
{
	$delete = mysqli_query($dbc, 'delete from users_dealers where id='.intval($_GET['delete']).';');
	if ($delete)
	{
		$_SESSION['msg1'] = 'با موفقیت حذف گردید.';
		header("Location: ".$_SERVER['HTTP_REFERER']);
	}
}

// enable
if (isset($_GET['enable']))
{
	$enable = mysqli_query($dbc, 'update `users_dealers` SET status=1 where id='.intval($_GET['enable']).';');
	if ($enable)
	{
		$_SESSION['msg1'] = 'با موفقیت فعال گردید.';
		header("Location: ".$_SERVER['HTTP_REFERER']);
	}
}

// disable
if (isset($_GET['disable']))
{
	$disable = mysqli_query($dbc, 'update `users_dealers` SET status=0 where id='.intval($_GET['disable']).';');
	if ($disable)
	{
		$_SESSION['msg1'] = 'با موفقیت غیر فعال گردید.';
		header("Location: ".$_SERVER['HTTP_REFERER']);
	}
}


// enablevip
if (isset($_GET['enablevip']))
{
	$enablevip = mysqli_query($dbc, 'update `users_dealers` SET vip=1 where id='.intval($_GET['enablevip']).';');
	if ($enablevip)
	{
		$_SESSION['msg1'] = 'با موفقیت فعال گردید.';
		header("Location: ".$_SERVER['HTTP_REFERER']);
	}
}

// disablevip
if (isset($_GET['disablevip']))
{
	$disablevip = mysqli_query($dbc, 'update `users_dealers` SET vip=0 where id='.intval($_GET['disablevip']).';');
	if ($disablevip)
	{
		$_SESSION['msg1'] = 'با موفقیت غیر فعال گردید.';
		header("Location: ".$_SERVER['HTTP_REFERER']);
	}
}


?>