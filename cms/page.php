<?php
session_start();
echo"
   <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />";

include "inc/function.php"; 

//tablepage=page_id,page_name,page_content,page_act,page_count ,page_comm_act
#=======================================================================#
$gid= intval($_GET['page_id']);

$action = htmlspecialchars($_SERVER["PHP_SELF"]);
if(isset($_SERVER["QUERY_STRING"])){
	 $action.="?".htmlspecialchars($_SERVER["QUERY_STRING"]);
	
}
#===========================================================
//$_SERVER["QUERY_STRING"]// اي عندما يكون في بحث عشان المعلق ما يكون فيه تكرار في المشاهده 

// TABLE pages_comm = pc_id,pc_name,pc_mail,pc_ip,pc_date,pc_text,pc_active,page_id,pc_from 
$pcname    =strip_tags($_POST['pc_name']);
$pcmail    =trim(strip_tags($_POST['pc_mail']));
$pcip      =$_POST['pc_ip'];
$pcdate    =$_POST['pc_date'];
$pctxt     =strip_tags($_POST['pc_text']);
$pcact     =$_POST['pc_active'];
$pcp_id    =$_POST['page_id'];
$pcfrom    =strip_tags($_POST['pc_from']);

#=======================================================================#

if(isset($_POST['add']) && $_POST['add'] =='comm'){
	
	if($_SESSION['commnetpage'] > time() -60){
		include"inc/okhead.php";
		echo"<div class='txt'> لا يمكن ارسال استعلام الا بعد 30 ثانيه</div>
		<meta http-equiv='refresh' content='2; url=".$_SERVER["PHP_SELF"]."?page_id=".$gid."' />
		";
		include"inc/okfoot.php";
		exit();
		
	}
	
	

	if ($_POST['captcha'] == '' || $_POST['captcha'] !=$_SESSION['code']){//شرط الcaptcha مهم
		 include"inc/okhead.php";
		echo"<div class='txt'> الرمز الامني غير صحيح</div>";
		include"inc/okfoot.php";
		exit();
	}else if(empty($pcname)){
		include"inc/okhead.php";
		echo"<div class='txt'>اكتب اسمك لو سمحت</div>";
		include"inc/okfoot.php";
		exit();
	
	}else if(empty($pctxt)){
		include"inc/okhead.php";
		echo"<div class='txt'>اكتب التعليق لو سمحت</div>";
		include"inc/okfoot.php";
		exit();
	
	}else if(strlen($pcname) > 30 or strlen($pcname) < 3){
		include"inc/okhead.php";
		echo"<div class='txt'> يجب يكون اسمك اكبر من ثلاثه حروف وقل من ثلاثين حرف</div>";
		include"inc/okfoot.php";
		exit();
		
	}else if(empty($pcmail)){
		include"inc/okhead.php";
		echo"<div class='txt'> اكتب البريد الالكتروني</div>";
		include"inc/okfoot.php";
		exit();
		
	}else if(!preg_match("/^[A-Z0-9_.-]{1,40}+@([A-Z0-9_-]){2,30}+\.([A-Z0-9]){2,20}$/i",$pcmail)){// تحقق من البريد الالكتروني
		include"inc/okhead.php";
		echo"<div class='txt'> البريد الالكتروني غير صحيح</div>";
		include"inc/okfoot.php";
		exit();
	

	}else{
	$_SESSION['commnetpage']=time();//اي بعد تحقق شروط اعمل وحدد وقت الجلسه اي باي وقت طرح التعليق	
	$addcomm=mysql_query("INSERT INTO pages_comm 
	(pc_name,pc_mail,pc_ip,pc_date,pc_text,pc_active,page_id,pc_from) 
	 VALUES 
	('$pcname','$pcmail','$pcip','$pcdate','$pctxt','$pcact','$pcp_id','$pcfrom ')") or die("<center><h3>MYSQL ERROR</h3></center>");
	 if (isset($_SERVER["QUERY_STRING"])){
	
		include"inc/okhead.php";
		echo"<div class='txt'>تم اضافه التعليق بنجاح</div>
		<meta http-equiv='refresh' content='2; url=".$_SERVER["PHP_SELF"]."?page_id=".$gid."' />
		";
		include"inc/okfoot.php";
		exit();
	}		
	}
}

#=======================================================================#

$showpage=mysql_query("SELECT * FROM pages where page_id='".$gid."'") or die ("<center><h3>MYSQL Error</h3></center>");
$rowshoepage=mysql_fetch_object($showpage);
include "inc/header.php";
if(!$gid){
    echo"
	<td valign='top' width='60%'>
	<div class='head'>رساله الموقع </div>
	<div class='bodypanel'><center>الصفحه المطلوبه غير موجوده </center></div>
	</td>
	";	
}else if(mysql_num_rows($showpage) < 1){
	 echo"
	<td valign='top' width='60%'>
	<div class='head'>رساله الموقع </div>
	<div class='bodypanel'><center>رقم الصفحه ".$gid." لم يستعلم عنه او لم يوجد في  القاعدة</center></div>
	</td>
	";	
}else if(isset($gid)){
	$addziara=mysql_query("update pages set page_count=page_count+1 where page_id='$gid'") or die ("<center><h3>error</h3></center>");
	 if($rowshoepage->page_act==1){

 	
#######################################################################3
#فورم التعليق

	echo"

	<td valign='top' width='60%'>
	<div class='head'>".$rowshoepage->page_name."</div>
	<div class='bodypanel'>".$rowshoepage->page_content."</div>
";

//////////////////////////loop commnets///////////////////////
// TABLE pages_comm = pc_id,pc_name,pc_mail,pc_ip,pc_date,pc_text,pc_active,page_id,pc_from 

$showcommntes=mysql_query("SELECT pc_id,pc_name,pc_mail,pc_date,pc_text,pc_active,page_id,pc_from 
FROM pages_comm WHERE page_id='".$gid."' AND pc_active='2' ORDER BY pc_id DESC")//عمل وير من اجل ربط التعليق بصفحه المراده وليس لجميع الصفحات andاي اذا الصفحه منشطه اضهر التعليقات
    or die("<center><h3>Mysql error</h3></center>");

if(mysql_num_rows($showcommntes) > 0){
echo"
<div class='head'>التعليقات</div>
<div class='bodypanel'>
<table width='100%' align='center' cellpadding='2' cellspacing='3'>
";

while ($rowcomm=mysql_fetch_object($showcommntes)){
echo"
<tr>
   <td class='tbl headcom'>كتبت بواسطه[".$rowcomm->pc_name."]-بتاريخ(".$rowcomm->pc_date." )-الدوله [".$rowcomm->pc_from."] </td>
</tr>
<tr>
<td class='tbl2 combody'>[التعليق]<h4>".$rowcomm->pc_text."</h4></td>
</tr>
	";
}

echo"</table></div>";
}
//////////////////////////end loopcommnets////////////////////////

//////////////////////form////////////////////////
if($rowshoepage->page_comm_act == 1){
echo"
<!-- comm form-->
<div class='head'>اضافه تعليق</div>
<div class='bodypanel'>
<form action='".$action."' method='post'>
<table width='100%' align='center' cellpadding='0' cellspacing='0'>
<tr>
    <td width='20%' class='tbl'>اسم المعلق</td>
	<td width='80%' class='tbl'><input type='text' name='pc_name' /></td>
</tr>
<tr>
    <td width='20%' class='tbl2'>بريدك الالكتروني</td>
	<td width='80%' class='tbl2'><input type='text' name='pc_mail' /></td>
</tr>
<tr>
    <td width='20%' class='tbl'>الدواله</td>
	<td width='80%' class='tbl'>";
	
	include "inc/country.php";// لتضمين ملف قائمه الدول
	
	echo"
	</td>
</tr>
<tr>
    <td width='20%' class='tbl2'>التعليق</td>
	<td width='80%' class='tbl2'>
	<textarea name='pc_text' rows='8' cols='48'></textarea>
	</td>
</tr>
<tr>
    <td width='20%' class='tbl'>الرمز الامني</td>
	<td width='80%' class='tbl'><input type='text' name='captcha' /> -  <img src='inc/captcha.php' alt= ' ' /></td>
</tr>
<tr>
	<td width='80%' colspan='2' align='center' class='tbl2'>
	<input class='bottons' type='submit' value='اضافه التعليق' />
	</td>
</tr>
</table>
<input type='hidden' name='pc_ip' value'".$_SERVER["REMOTE_ADDR"]."'/><!--يعمل استداع على حسب الIP تبعك كا value'127.0.0.1 فائده SERVER -->
<input type='hidden' name='pc_active' value='2' /><!--2 اي غير مفعل من اجل اقوم بتفعيله انا من لوحه التحكم بعد الاطلاع على التعليق --> 
<input type='hidden' name='page_id' value='".$gid."' /><!--من اجل تحديد ان التعليق على الصفحه المطلوبه وليس على كل الصفحات -->
<input type='hidden' name='pc_date' value='".date("d m Y-h : i :s")."' />
<input type='hidden' name='add' value='comm' />
</form>
</div>
";
}
//////////////////////end form/////////////////////////////////////////
    echo"
	</td>
	";
	
	 }else{
		  echo"
	<td valign='top' width='60%'>
	<div class='head'>رساله الموقع </div>
	<div class='bodypanel'><center> الصفحه الحاليه غير متوفره</center></div>
	</td>";
		 }
}
 include "inc/footer.php" ; 
 
 ?>
