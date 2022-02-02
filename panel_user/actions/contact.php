<?php include('./dinc/check_login.php'); ?>

<div class="pagetitle">پیام به مدیر</div>


		<?php

				echo '
					<br />
					<form method="post" action="" class="regform">
					* نام شما : &nbsp; <input type="text" name="fnamelname" value="'.$row_admin['flname'].'" maxlength="50" />
					* ایمیل : <input type="text" name="authoremail" value="'.$row_admin['address'].'" maxlength="80" dir="ltr" />
					شماره تماس : <input type="text" name="authortell" maxlength="15" dir="ltr" />
					* عنوان ارتباط : <input type="text" name="subject" maxlength="150" />
					* متن ارتباط : <textarea name="content" style="height:100px;"></textarea>
					&nbsp;<input type="submit" value="ارسال پیام" name="sendnewcontact" />
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
		<br>