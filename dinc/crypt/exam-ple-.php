<?php 
$cryptinstall="./crypt/cryptographp.fct.php";
include $cryptinstall; 
?>


<html>
<div align="center">
<b>Exemple d'utilisation de Cryptographp v1.4</b><br>
(Cet exemple fonctionne même si les cookies sont désactivées)<br><br>

<form action="" method="post">
<table cellpadding=1>
  <tr><td align="center"><?php dsp_crypt(0,1); ?></td></tr>
  <tr><td align="center">Recopier le code:<br><input type="text" name="code"></td></tr>
  <tr><td align="center"><input type="submit" name="submit" value="Envoyer"></td></tr>
</table>
<br><br><br>
Cryptographp (c) 2006-2007 Sylvain BRISON<br>
http://www.cryptographp.com
</form>

</div>
</html>

<?php
if(isset($_POST['submit']))
{
  if (chk_crypt($_POST['code'])) 
     echo "<a><font color='#009700'>=> Bravo, vous avez saisi le bon code !</font></a>" ;
     else echo "<a><font color='#FF0000'>=> Erreur, le code est incorrect</font></a>" ;
}
?>

