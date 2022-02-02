<?php include('./dinc/check_login.php'); ?>
<div class="pagetitle">پیام ها</div>

<?php
if(@strlen($_GET['read'])!=0)
{
	$res_read = mysqli_query($dbc, 'select * from contacts where id='.intval($_GET['read']).';');
	@ $num_read = mysqli_num_rows($res_read);
	if($num_read==1)
	{
		$row_read = mysqli_fetch_array($res_read);
		if($row_read['read']=='0')
		{
			$update = mysqli_query($dbc, 'update contacts set `read`=1 where id='.$row_read['id'].';');
			if($update){header("Location: ././?action=contacts&read=".$row_read['id']."");}
		}
		echo '
		<table cellpadding="0" cellspacing="0" class="tablelist" width="100%" style="text-align:right; direction:rtl;">
		<tr><th align="left" dir="rtl">
			<div style="float:right;">
				<span style="direction:rtl;">
				متن : <b>'.$row_read['subject'].'</b> 
				</span>  &nbsp; | &nbsp; 
				<span style="direction:rtl;">ارسال کننده : <a href="mailto:'.$row_read['authoremail'].'">'.$row_read['authorname'].'</a>';
				  if(strlen($row_read['authortell'])!=0){echo '&nbsp; | &nbsp; شماره تماس : '.$row_read['authortell'].'';}
				echo '</span>
			</div>
		</th></tr>';
		echo '
		<tr><td align="right"  style="background:#f2f2f2;">'.$row_read['content'].'';
		echo '</td></tr>';
		echo '
		</table>';
		echo '<br />';
	}
}
?>


<?php
/////////////////////// Pages ...
@$page = intval($_GET['page']);
$max = 9;
if(strlen(@$_GET['page'])==0 or @$_GET['page']=='0')
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
<table cellspacing="1" cellspacing="1" width="100%" class="tablelist">
<tr>
<th width="5%" align="center">#</th>
<th width="5%" align="center">وضعیت</th>
<th align="left">عنوان</th>
<th width="25%" align="center">نویسنده</th>
<th align="center" width="5%">حذف</th>
</tr>

<?php
$res_contacts = mysqli_query($dbc, 'select * from contacts order by id desc limit '.$first.','.$max.';');
$num_contacts = mysqli_num_rows($res_contacts);
for($i=0;$i<$num_contacts;$i++)
{
	$row_contacts = mysqli_fetch_array($res_contacts);
	echo '
		<tr';
		if($row_contacts['read']==1)
		{
			echo ' bgcolor="#f6f6f6"';
		}
		echo '>
		<td align="center">'.$row_contacts['id'].'</td>
		<td align="center">';
		if($row_contacts['read']==1)
		{
			echo '<a href="././?action=contacts&read='.$row_contacts['id'].'" style="color:#555;">خوانده&nbsp;شده</a>';
		}
		else
		{
			echo '<a href="././?action=contacts&read='.$row_contacts['id'].'">خوانده&nbsp;نشده</a>';
		}
		echo '</td>
		<td align="right"><a href="././?action=contacts&read='.$row_contacts['id'].'">';
		if($row_contacts['reply']==1){echo '<img src="./images/admin_icon/reply.png" class="png_bg" alt="پاسخ داده شده" border="0" align="absmiddle" /> ';}
		echo ''.$row_contacts['subject'].'</a></td>
		<td align="center"><a href="mailto:'.$row_contacts['authoremail'].'">'.$row_contacts['authorname'].'</a></td>
		<td align="center">
			<a href="././?action=contacts&del='.$row_contacts['id'].'" onclick="return confirmLinkDropDB()" onclick="return confirmLinkDropDB()" style="color:#f00;">
				حذف
			</a>
		</td>
		</tr>';
}
?>

</table><br />
<?php
/////////////////////// Pages ...
$queryall = "select count(id) from `contacts`;";
$resall = mysqli_query($dbc, $queryall);
if(!$resall) echo 'در ارسال اطلاعات به پايگاه داده مشكلي به وجود آمده است';
@ $rowall = mysqli_fetch_array($resall);
$numall = $rowall['count(id)'];
if($numall>$max)
{
	$pages = ceil($numall/$max);
	if($page>4 and $pages>5){echo '<a href="././?action=contacts&page=1" class="pagenum">1</a><div style="float:left; line-height:28px;">&nbsp;...&nbsp;</div>';}
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
		if($p==$page) { echo ' style="color:#ffffff; border:1px solid #555555; background:url(images/bgcurrent.gif) repeat-x #636363;"';}
		echo ' href="././?action=contacts&page='.$p.'" class="pagenum">'.$p.'</a>';
	}
	if(ceil($numall/$max)>6 and $page<(ceil($numall/$max)-2)){echo '<div style="float:left; line-height:28px;">&nbsp;...&nbsp;</div>';}
	if(ceil($numall/$max)>5){
		echo '<a href="././?action=contacts&page='.ceil($numall/$max).'" class="pagenum"';
			if(ceil($numall/$max)==$page) {
			echo ' style="color:#ffffff; border:1px solid #555555; background:url(images/bgcurrent.gif) repeat-x #636363;"';
			}
		echo ' >'.ceil($numall/$max).'</a>';
		}
}
/////////////////////// Pages ...

////////////////////// Delete ...
if(strlen(@$_GET['del'])!=0)
{
		$delete = mysqli_query($dbc, 'delete from contacts where id='.intval($_GET['del']).';');
		if($delete){header("Location: ././?action=contacts&msg=2");}
}
/////////////////////// Delete ...

?>