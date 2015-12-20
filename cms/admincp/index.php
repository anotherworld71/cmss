<?php 

require_once"../inc/conf.php";?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>لوحة التحكم </title>
<link href="styles/admincp.css" rel="stylesheet" type="text/css" />
</head>


	
<body >

<table align="center" width="100%" cellpadding="5" cellspacing="5">
<tr>
    <td><div  id="header"> مرحبابك في لوحة التحكم </div></td>
</tr>
</table>

<table align="center" width="100%" cellpadding="5" cellspacing="5">
<tr>
    <td valign="top" class='rpanel' width="15%">
    <div class="head">الاعدادات العامة</div>
    <div class="bodypanel">
	<a href="index.php">الرئيسية</a><br />
    <a target='_blank'  href="../index.php">معاينة الموقع</a><br />
	<a href="?cpages=main_setting">الرئيسية الاعدادات</a><br />
	<a href="?cpages=temp">القوالب</a><br />
    </div>
    <div  class="head">التحكم بالقوائم</div>
    <div class="bodypanel">
	<a href="?cpages=blocks">القوائم الجنوبية</a><br />
	<a href="?cpages=main_setting">الرئيسية الاعدادات</a><br />
	<a href="?cpages=temp">المحررين </a><br />
	</div>
     <div valign="top" class="head"> نظام الصفحات الخاصه</div>
    <div class="bodypanel">
	<a href="?cpages=custom_pages"> اعدادات الصفحات</a><br />
	<a href="?cpages=pages_comm"> تعليقات الصفحات </a><br />

    </td></div>
	<td class="cpanel" width="85%">
<?php

#اعدادات حفظ الملاحظة

$amsg=strip_tags($_POST['adminmsg']);

if(isset($_POST['do']) and $_POST['do']=='update'){
	
$update=mysql_query("update main_setting set adminmsg='$amsg'")or die(mysql_error());
if(isset($update)){
	die("<center>تم حفظ الملاحظه</center>
	<meta http-equiv='refresh' content='2; url=index.php'/>
	");
}
}
$query=mysql_query("select adminmsg from main_setting")or die(mysql_error());
$row=mysql_fetch_object($query);

#الصفحه المطلوبه 
 $page= $_GET['cpages'];
  if(isset($page)) {
	$url=$page.".php";
	   if(file_exists($url)) { 	   
	
	      include $url;
	}else {
	echo "لا توجد هذه الصفحه من الاساس";
   }

  }else{
	  echo"
	  
	  <div class='imp'>مرحباً بك في لوحه التحكم يا </div>
	  <br />
	   
	  <form action='index.php' method='post'> 
	 <table align='center' width='100%'cellpadding='2'cellspacing='2'>
	   <tr>
	       <td class='tbl'>ملاحظات المدير العام</td>
	   </tr>
	   <tr>
	       <td align='center' class='tbl2'><textarea name='adminmsg'rows='6' cols='80'>".$row->adminmsg."</textarea></td>
	   </tr>
	   <tr>
	       <td align='center' class='tbl2'><input type='submit' class='bottons' value='حفظ الملاحظه'/></td>
	   </tr>
	   </table>
	   <input type='hidden' name='do' value='update'/>
	   </form>
	   <br />
	   
	   
	   <table align='center' width='100%'cellpadding='0'cellspacing='0'>
	   <tr>
	      <td class='tbl' colspan='2'>معلومات البرنامج</td>
	   </tr>
	   <tr>
	      <td class='tbl2'>اسم البرنامج :ادارة المحتوى</td>
	      <td class='tbl3'>المبرمج :سمية الكينعي</td>
	   </tr>
	   <tr>
	      <td class='tbl3'>الاصدار:1</td>
	      <td class='tbl2'>اصدار البي ابش بي:5</td>
	   </tr>
	   
	   </table>
	  
	    
	  ";
	  }
?>	
	</td>
</tr>
</table>
<table align="center" width="100%" cellpadding="0" cellspacing="0">
<tr>
   <td><div id="footer">جميع الحقوق محفوظة لنا</div></td>
</tr>
</body>
</html>