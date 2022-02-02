<div class="content_box">
	<div class="content_title">تماس با ما</div>
	<div class="padding10">
		<?php
		echo $row_settings['static_contact'];

				echo '
					<br />
					<form method="post" action="" class="regform">
					<div class="content_title">فرم ارتباط</div>
					* نام شما : &nbsp; <input type="text" name="fnamelname" maxlength="50" />
					* ایمیل : <input type="text" name="authoremail" maxlength="80" dir="ltr" />
					شماره تماس : <input type="text" name="authortell" maxlength="15" dir="ltr" />
					* عنوان ارتباط : <input type="text" name="subject" maxlength="150" />
					* متن ارتباط : <textarea name="content" style="height:100px;"></textarea>
					&nbsp;<input type="submit" value="ارسال متن" name="sendnewcontact" />
					</form>';

					if(isset($_POST['sendnewcontact']) and strlen(stristr($_SERVER['HTTP_REFERER'],$url))!=0)
					{
						if(strlen($_POST['fnamelname'])!=0 and strlen($_POST['authoremail'])!=0 and strlen($_POST['subject'])!=0 and strlen($_POST['content'])!=0)
						{
							if(strlen(stristr($_POST['authoremail'],'@'))!=0)
							{
								$insert = mysqli_query($dbc, 'insert into contacts (authorname,authoremail,authortell,subject,content) values 
								(\''.sql_quote($dbc, $_POST['fnamelname']).'\',\''.sql_quote($dbc, $_POST['authoremail']).'\',
								\''.sql_quote($dbc, $_POST['authortell']).'\',\''.sql_quote($dbc, $_POST['subject']).'\',\''.str_ireplace('
					','<br />',sql_quote($dbc, $_POST['content'])).'\');');
								if($insert)
								{
									$_SESSION['msg1'] = 'با موفقیت ارسال گردید.';
									header("Location: ".$_SERVER['HTTP_REFERER']);
								}
							}
							else
							{
								$_SESSION['msg2'] = 'ایمیل اشتباه است.';
								header("Location: ".$_SERVER['HTTP_REFERER']);
							}
						}
						else
						{
							$_SESSION['msg2'] = 'موارد ضروری وارد گردد.';
							header("Location: ".$_SERVER['HTTP_REFERER']);
						}
					}
		?>
		<br>
		<?php
		if(strlen($row_settings['phone'])!=0)
		{
			echo ' 
					» <b>شماره تماس :</b> '.$row_settings['phone'].'<br>';
		}
		if(strlen($row_settings['admin_email'])!=0)
		{
			echo '  
					» <b>پشتیبانی :</b> '.$row_settings['admin_email'].'<br>';
		}
		if(strlen($row_settings['address'])!=0)
		{
			echo '  
					» <b>آدرس :</b> '.$row_settings['address'].'<br>';
		}
		?>
	</div>
</div>

<br>
<br>