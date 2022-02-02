<?php
ob_start();
session_start();
error_reporting(0);
include('../dinc/kcnf.php');
include('../dinc/sql_quote.php');
include('../dinc/jdf.php');
include('./dinc/check_login.php');
?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="icon" type="image/png" href="../images/favicon.png" />
<link rel="stylesheet" type="text/css" href="./css/index.css">
<script type="text/javascript" src="./js/jquery.min.js"></script>

	<link rel="stylesheet" type="text/css" href="./js/elmo/elmo.css">
	<script type="text/javascript" src="./js/elmo/elmo.js"></script>

	<script language="javascript">
        function confirmLinkDropDB(theLink)
        {
            var confirmMsg  = 'مطمئنید حذف گردد ؟';
            // ]]>
            // Confirmation is not required in the configuration file
            // or browser is Opera (crappy js implementation)
            if (confirmMsg == '' || typeof(window.opera) != 'undefined') {
                return true;
            }
            var is_confirmed = confirm(confirmMsg);
            if (is_confirmed) {
                theLink.href;
            }
            return is_confirmed;
        }
    </script>
	<title>برگشت از بانک...</title>
</head>
<body>
<?php
				// zarinpal
				// zarinpal
				// zarinpal
						echo '<div class="backbox">';
							$MerchantID = '42f0f06d-b5dc-4782-bcb4-841ddd4b0d4d';  //Required
							$Amount = $_GET['amount']; //Amount will be based on Toman
							$Authority = $_GET['Authority'];
							
							if($_GET['Status'] == 'OK'){
								// URL also Can be https://ir.zarinpal.com/pg/services/WebGate/wsdl
								$client = new SoapClient('https://ir.zarinpal.com/pg/services/WebGate/wsdl', array('encoding' => 'UTF-8')); 
								
								$result = $client->PaymentVerification(
													array(
															'MerchantID'	 => $MerchantID,
															'Authority' 	 => $Authority,
															'Amount'	 => $Amount
														)
								);
								if($result->Status == 100)
								{

										// update orders
										$update = mysqli_query($dbc, '
											update payments set 
												status=1,
												details="Zarinpal پیگیری '.sql_quote($dbc, $result->RefID).'"
										 	where id='.intval($_GET['cid']).' and userid='.$row_admin['id'].';
										 	');
										if($update)
										{
											$_SESSION['msg1'] = 'پرداخت با موفقیت انجام گردید';
											header("Location: ".$url."/panel_user/?action=orders&msg=1111");
										}
										else
										{
											$_SESSION['msg1'] = 'Err 41585';
											header("Location: ".$url."/panel_user/?action=orders&msg=2222");
										}
										

								} else {
									echo 'Transation failed. Status:'. $result->Status;
								}
						
							} else {
								$_SESSION['msg1'] = 'پرداخت توسط کاربر کنسل گردید';
								header("Location: ".$url."/panel_user/?action=orders&msg=2222");
							}
				// zarinpal
				// zarinpal
				// zarinpal



mysqli_close($dbc);
?>
</body>
</html>