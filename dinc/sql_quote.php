<?php

function sql_quote($dbc, $value )
{
    
    if( get_magic_quotes_gpc() )
    {

       $value = stripslashes( $value );

    }
    $value = mysqli_real_escape_string( $dbc, $value );

    return $value;
}



function tikekon_harf($matne_harf, $l_harf ,$return=1 ) {
    $matne_harf = str_ireplace("&nbsp;", ' ', $matne_harf);
    if ( strlen($matne_harf) > $l_harf){
    $end='...';
    }else{
    $end='';
    }
    $matne_harf = mb_strcut ( $matne_harf, 0 , $l_harf , "UTF-8");
    $text=''.$matne_harf.''.$end.'';
    if ( $return == 1){
    return $text;
    }else{
    print $text;
     }
}


function rabourlcode($urladdress) {
	$urladdress = str_ireplace('/','-',$urladdress);
	$urladdress = urlencode($urladdress);
	$urladdress = str_ireplace('+','-',$urladdress);
	return $urladdress;
}



function toString($num, $b=62) {
  $base='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $r = $num  % $b ;
  $res = $base[$r];
  $q = floor($num/$b);
  while ($q) {
    $r = $q % $b;
    $q =floor($q/$b);
    $res = $base[$r].$res;
  }
  return $res;
}
function toNumber( $num, $b=62) {
  $base='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $limit = strlen($num);
  $res=strpos($base,$num[0]);
  for($i=1;$i<$limit;$i++) {
    $res = $b * $res + strpos($base,$num[$i]);
  }
  return $res;
}



function fatoen($string) {
    return strtr($string, array('۰'=>'0', '۱'=>'1', '۲'=>'2', '۳'=>'3', '۴'=>'4', '۵'=>'5', '۶'=>'6', '۷'=>'7', '۸'=>'8', '۹'=>'9', '٠'=>'0', '١'=>'1', '٢'=>'2', '٣'=>'3', '٤'=>'4', '٥'=>'5', '٦'=>'6', '٧'=>'7', '٨'=>'8', '٩'=>'9'));
}
function entofa($string) {
    return strtr($string, array('0'=>'۰','1'=>'۱','2'=>'۲','3'=>'۳','4'=>'۴','5'=>'۵','6'=>'۶','7'=>'۷','8'=>'۸','9'=>'۹'));
}



function secondsToWords($seconds)
{
  $ret = "";

  if($seconds<120)
  {
    $ret = 'لحظاتی پیش';
  }
  elseif($seconds<3600)
  {
    $ret = 'دقایقی پیش';
  }
  elseif($seconds<86400)
  {
    $hours = floor($seconds / 3600);
    $ret = $hours.' ساعت پیش';
  }
  elseif($seconds<604800)
  {
    $days = floor($seconds / 86400);
    $ret = $days.' روز پیش ';
  }
  elseif($seconds<2592000)
  {
    $weeks = floor($seconds / 604800);
    $ret = $weeks.' هفته پیش ';
  }
  elseif($seconds<31536000)
  {
    $weeks = floor($seconds / 2592000);
    $ret = $weeks.' ماه پیش ';
  }
  else
  {
    $weeks = floor($seconds / 31536000);
    $ret = $weeks.' سال پیش ';
  }

  return $ret;
}

function encodep($string)
{
  $string = str_replace('1', 'F$de',$string);
  $string = str_replace('2', 'd%e',$string);
  $string = str_replace('3', 'Y+*e',$string);
  $string = str_replace('4', ')$e',$string);
  $string = str_replace('5', '&u*e',$string);
  $string = str_replace('6', 'RR&f',$string);
  $string = str_replace('a', 'l@g^',$string);
  $string = str_replace('m', 'w-(o',$string);
  $string = str_replace('s', 'p#ru',$string);
  $string = base64_encode($string);
  $string = str_replace('1', 'F$de',$string);
  $string = str_replace('2', 'd%e',$string);
  $string = str_replace('3', 'Y+*e',$string);
  $string = str_replace('4', ')$e',$string);
  $string = str_replace('5', '&u*e',$string);
  $string = str_replace('6', 'RR&f',$string);
  $string = str_replace('a', 'l@g^',$string);
  $string = str_replace('m', 'w-(o',$string);
  $string = str_replace('s', 'p#ru',$string);
  return $string;
}
function decodep($string)
{
  $string = str_replace('F$de', '1',$string);
  $string = str_replace('d%e', '2',$string);
  $string = str_replace('Y+*e', '3',$string);
  $string = str_replace(')$e', '4',$string);
  $string = str_replace('&u*e', '5',$string);
  $string = str_replace('RR&f', '6',$string);
  $string = str_replace('l@g^', 'a',$string);
  $string = str_replace('w-(o', 'm',$string);
  $string = str_replace('p#ru', 's',$string);
  $string = base64_decode($string);
  $string = str_replace('F$de', '1',$string);
  $string = str_replace('d%e', '2',$string);
  $string = str_replace('Y+*e', '3',$string);
  $string = str_replace(')$e', '4',$string);
  $string = str_replace('&u*e', '5',$string);
  $string = str_replace('RR&f', '6',$string);
  $string = str_replace('l@g^', 'a',$string);
  $string = str_replace('w-(o', 'm',$string);
  $string = str_replace('p#ru', 's',$string);
  return $string;
}