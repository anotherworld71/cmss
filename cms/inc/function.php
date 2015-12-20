<?php
require_once"inc/conf.php"; 

$site_info=mysql_query("select * from main_setting") or die(mysql_error());
$site=mysql_fetch_object($site_info);

#الاعدادت العامه للموقع 

$sname    =$site->sname;
$surl     =$site->surl;
$smail    =$site->smail;
$sdesc    =$site->sdesc;
$stags    =$site->stags;
$sclose   =$site->sclose;
$stclose  =stripslashes($site->stextclose);
$shturn   =$site->sheaderturn;
$sh       =stripslashes($site->sheader);
$sfturn   =$site->sfooterurn;
$sf       =stripslashes($site->sfooter);
$cr       =stripslashes($site->copyrights);




if($sclose==2){
  die("
  <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
  <title>الموقع مغلق::".$sname."</title>
  <center>".$stclose."</center>");	//فكره عمل اغلاق للموقع وترك رساله توضيحه
}


?>