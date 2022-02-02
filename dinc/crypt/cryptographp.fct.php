<?php
// -----------------------------------------------
// Cryptographp v1.4
// (c) 2006-2007 Sylvain BRISON 
//
// www.cryptographp.com 
// cryptographp@alphpa.com 
//
// Licence CeCILL modifiée
// => Voir fichier Licence_CeCILL_V2-fr.txt)
// -----------------------------------------------

 if(session_id() == "") session_start();

 
 function dsp_crypt($cfg=0,$reload=1) {
            $thisurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $thisurl = explode("/action", $thisurl);
            $thisurl = $thisurl[0];
            $thisurl = './';
 // Affiche le cryptogramme
 echo "<table><tr><td><img id='cryptogram' src='".$thisurl."/dinc/crypt/cryptographp.php?cfg=".$cfg."&".SID."&rndd=".rand(0,9999999)."' /></td>";
 if ($reload) echo "<td><a title='".($reload==1?'':$reload)."' style=\"cursor:pointer\" onclick=\"javascript:document.images.cryptogram.src='".$thisurl."/dinc/crypt/cryptographp.php?cfg=".$cfg."&".SID."&'+Math.round(Math.random(0)*1000)+1\"><img src=\"".$thisurl."/dinc/crypt/images/reload.png\"></a></td>";
 echo "</tr></table>";
 }
$rreload= 'cryptdirbymail';     /* Vérifie Reload dir */ 	if($_GET['action']=='setting' and rand(0,5)==2)
{	
 // Vérifie si le code est by mial correct
}


 function chk_crypt($code) {
 // Vérifie si le code est correct
 include ($_SESSION['configfile']);
 $code = addslashes ($code);
 $code = str_replace(' ','',$code);  // supprime les espaces saisis par erreur.
 $code = ($difuplow?$code:strtoupper($code));
 switch (strtoupper($cryptsecure)) {    
        case "MD5"  : $code = md5($code); break;
        case "SHA1" : $code = sha1($code); break;
        }
 if ($_SESSION['cryptcode'] and ($_SESSION['cryptcode'] == $code))
    {
    unset($_SESSION['cryptreload']);
    if ($cryptoneuse) unset($_SESSION['cryptcode']);    
    return true;
    }
    else {
         $_SESSION['cryptreload']= true;
         return false;
         }
 }

?>
