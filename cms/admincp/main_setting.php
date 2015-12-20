<?php
//Table main-setting=sname,surl,smail,sdesc,stags, sclose,stextclose,adminmsg

$query=mysql_query("select 
sname,surl,smail,sdesc,stags, sclose,stextclose, sheaderturn,sheader,sfooterturn,sfooter,copyrights 
from main_setting") or die(mysql_error());
$row=mysql_fetch_object($query);


//ALTER TABLE 'main_setting' ADD 'sheaderturn' 
//sheader,sheaderturn,sfooterturn ,sfooter,sfooterturn ,copyrights

$sname      =strip_tags($_POST['sname']);
$surl       =strip_tags($_POST['surl']);
$smail      =strip_tags($_POST['smail']);
$sdesc      =strip_tags($_POST['sdesc']);
$stags      =strip_tags($_POST['stags']);
$sclose     =($_POST['sclose']);
$stclose    =addslashes($_POST['stextclose']);
$shturn     =$_POST['sheaderturn'];
$sh         =addslashes($_POST['sheader']);
$sfturn     =$_POST['sfooterturn'];
$sf         =addslashes($_POST['sfooter']);
$cr         =addslashes($_POST['copyrights']);
if(isset($_POST['do'] )&& $_POST['do']=='edit'){
 $update=mysql_query("update main_setting set sname     ='$sname',
	surl      ='$surl',
	smail     ='$smail',
	sdesc     ='$sdesc',  
	stags     ='$stags',
	sclose    ='$sclose',
	stextclose   ='$stclose',
	sheaderturn  ='$shturn',
	sheader      ='$sh',
	sfooterturn  ='$sfturn ',
	sfooter      ='$sf',
	copyrights   ='$cr'
	
	") or die (mysql_error());
	
	if (isset($update)) {
		die("
		<center>تم حفظ الاعداد</center>
	<meta http_equiv='refresh'  content='2; url=?cpages=main_setting'/>
	");
	}
}


echo"
<form action='?cpages=main_setting' method='post'>
<table align='center' width='100%' cellpadding='0' cellspacing='0'>
  <tr>
       <td class ='tbl' colspan='2'>الاعدادت الرئيسية</td>
  </tr>
  
  <tr>
    <td class='tbl2'>اسم الموقع </td>
	<td class ='tbl2'><input type='text' name='sname' value=' ".$row->sname." '/></td>
  </tr>
  
  <tr>
    <td class='tbl3'>رابط الموقع </td>
	<td class ='tbl3'><input type='text' name='surl' value=' ".$row->surl." '/></td>
  </tr>
  
  <tr>
    <td class='tbl2'>بريد الموقع </td>
	<td class ='tbl2'><input type='text' name='smail' value=' ".$row->smail." '/></td>
  </tr>
  
  
  <tr>
    <td class='tbl3'>وصف الموقع  </td>
	<td class ='tbl3'><textarea name='sdesc' rows='5' cols='40'> ".$row->sdesc." </textarea></td>
  </tr>
  
   <tr>
    <td class='tbl2'>الكلمات الدليليه </td>
	<td class ='tbl2'><textarea name='stags' rows='5' cols='40'> ".$row->stags." </textarea></td>
  </tr>
  
  
  <tr>
    <td class='tbl3'>حالة الموقع </td>
	<td class ='tbl3'>
	<select name='sclose'>";
	
	if($row->sclose==1) { 
		echo"
		<option value='1'>مفتوح الزوار</option>
		<option value='2'>مغلق لزوار</option>
		";
	}else{
		echo"
		<option value='2'>مغلق لزوار</option>
		<option value='1'>مفتوح الزوار</option>
		";
	}
	echo" 
	</select>
	</td>
	</tr>
	   <td class='tbl2'>رسالة اغلاق</td>
	   <td class='tdl2'> <textarea name='stextclose'  rows='5' cols='40'>".stripslashes($row->stextclose)."</textarea></td>
	   </tr>
	   <br />
	   <tr>
	   
	   
	       <td class='tbl' colspan='2'>اعدادات الراس والتذييل</td>
	   </tr>
	  
<tr>
	      <td class='tbl2'>تشغيل رأس التصفحة</td>
		  <td class='tbl2' >
		  <select name='sheaderturn'>";
		  
		  if($row->sheaderturn==1){
			  echo"
			  <option value='1'>مفعل </option>
		  <option value='2'>غير مفعل</option>
			  
			  ";
		 }else{
			 echo"  
		  <option value='2'>غير مفعل</option>
		  <option value='1'>مفعل </option>
			 ";}
		 
		echo" 
		  </select>
		  </td>
	   </tr>
	    <tr>
	      <td class='tbl3'>محتوى رأس الصفحة</td>
		  <td class='tbl3'>
		  <textarea name='sheader'  rows='5' cols='40'>".stripslashes($row->sheader)."</textarea>
		  </td>
	   </tr>
	    <tr>
	      <td class='tbl2'>تشغيل حاشية الموقع </td>
		  <td class='tbl2'>
		  <select name='sfooterturn'>";
		  
		 if($row->sfooterturn==1){
			 echo"
			 <option value='1'>مفعل </option>
		  <option value='2'>غير مفعل</option>
			"; 
		 }else{
			 echo"
		  <option value='2'>غير مفعل</option>
		   <option value='1'>مفعل </option> 
			 ";
			 }
		 
		 echo"
		  </select>
		  </td>
	   </tr>
	    <tr>
	      <td class='tbl3'>محتوى التذييل</td>
		  <td class='tbl3'>
		   <textarea name='sfooter'  rows='5' cols='40'>".stripslashes($row->sfooter)."</textarea>
		  </td>
	   </tr>
	   <tr>
	      <td class='tbl2'>حقوق الموقع </td>
		  <td class='tbl2'>
		   <textarea name='copyrights'  rows='5' cols='40'>".stripslashes($row->copyrights)."</textarea>
		  </td>
	   </tr>
	   
	<td class='tbl3' align='center' colspan='2'> <input class='bottons' type='submit' value='حفظ العمل'/></td>
	</tr>
	</table>
<input type='hidden' name='do' value='edit'/>

	</form>
	";
  
	 


 