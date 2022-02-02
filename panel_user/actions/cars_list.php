<?php include('./dinc/check_login.php'); ?>
<div class="pagetitle">خودرو ها</div>



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
		<th align="right">عنوان خودرو</th>
		<th align="center" width="3%">تغییر</th>
		<th align="center" width="3%">وضعیت</th>
		<th align="center" width="3%">حذف</th>
	</tr>
	<?php
	$res_list = mysqli_query($dbc, 'select * from cars order by id desc limit '.$first.','.$max.';');
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
				<font style="font-size:11px;">نام خودرو : '.$row_list['name'].'</font>
				<br>
				<font style="font-size:11px;">هزینه هر روز : '.number_format($row_list['price']).' تومان</font>
				<br>';
				if (strlen($row_list['image'])!=0)
				{
					echo '<font style="font-size:11px;"><a href="'.$url.'/img/th/'.$row_list['image'].'" target="_blank">تصویر</a></font> &nbsp;';
				}
				echo '
			</td>
			<td align="center"><a href="./?action=cars_add&edit='.$row_list['id'].'"><img src="./images/icons/edit.png" class="table_icon" /></a></td>
			<td align="center"';
					if ($row_list['status']==1) {echo ' style="background:#deecd9;"';}
					if ($row_list['status']==0) {echo ' style="background:#fcc;"';}
			echo '>
					';
					if ($row_list['status']==1) {echo '<a href="./?action=cars_list&disable='.$row_list['id'].'"><img src="./images/icons/enable.png" class="table_icon" /></a>';}
					if ($row_list['status']==0) {echo '<a href="./?action=cars_list&enable='.$row_list['id'].'"><img src="./images/icons/disable.png" class="table_icon" /></a>';}
			echo '</td>
			<td align="center"><a href="./?action=cars_list&delete='.$row_list['id'].'" onclick="return confirmLinkDropDB()" onclick="return confirmLinkDropDB()"><img src="./images/icons/delete.png" class="table_icon" /></a></td>
		</tr>
		';
	}
	?>
</table>
<?php
/////////////////////// Pages ...
$queryall = 'select count(id) from cars;';
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
		echo '<a href="./?action=cars_list&search='.urlencode($searchtext).'&page=1" class="pagenum">1</a><div style="float:left; line-height:28px;">&nbsp;...&nbsp;</div>';
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
		echo ' href="./?action=cars_list&search='.urlencode($searchtext).'&page='.$p.'" class="pagenum">'.$p.'</a>';
	}
	if(ceil($numall/$max)>6 and $page<(ceil($numall/$max)-2)){echo '<div style="float:left; line-height:28px;">&nbsp;...&nbsp;</div>';}
	if(ceil($numall/$max)>5){
		echo '<a href="./?action=cars_list&search='.urlencode($searchtext).'&page='.ceil($numall/$max).'" class="pagenum"';
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
	$delete = mysqli_query($dbc, 'delete from cars where id='.intval($_GET['delete']).';');
	if ($delete)
	{
		$_SESSION['msg1'] = 'با موفقیت حذف گردید.';
		header("Location: ".$_SERVER['HTTP_REFERER']);
	}
}

// enable
if (isset($_GET['enable']))
{
	$enable = mysqli_query($dbc, 'update `cars` SET status=1 where id='.intval($_GET['enable']).';');
	if ($enable)
	{
		$_SESSION['msg1'] = 'با موفقیت فعال گردید.';
		header("Location: ".$_SERVER['HTTP_REFERER']);
	}
}

// disable
if (isset($_GET['disable']))
{
	$disable = mysqli_query($dbc, 'update `cars` SET status=0 where id='.intval($_GET['disable']).';');
	if ($disable)
	{
		$_SESSION['msg1'] = 'با موفقیت غیر فعال گردید.';
		header("Location: ".$_SERVER['HTTP_REFERER']);
	}
}

?>