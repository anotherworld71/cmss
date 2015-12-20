<?php

// TABLE pages_comm = pc_id,pc_name,pc_mail,pc_ip,pc_date,pc_text,pc_active,page_id,pc_from 

//tablepage=page_id,page_name,page_content,page_act,page_count ,page_comm_act

$gid= intval($_GET['pc_id']);
//////////////////////////////////// delete////////////////
if($_REQUEST['delete'] == 'pc'){
   $deletepc=mysql_query("DELETE FROM pages_comm WHERE pc_id='".$gid."'")or die (mysql_error());
   if(isset($deletepc)){
	   die(" 
	   <center>تم الحذف بنجاح</center>
	   <meta http-equiv='refresh' content='2; url=?cpages=pages_comm' />
      ");
   }
   }
   
$pcid   =$_POST['pc_id']; 
$pcname =$_POST['pc_name']; 
$pcmail =$_POST['pc_mail']; 
$pcip   =$_POST['pc_ip']; 
$pcdate =$_POST['pc_date']; 
$pctxt  =$_POST['pc_text']; 
$pcact  =$_POST['pc_active']; 
$pageid =$_POST['pc_id']; 
$pcfrom =$_POST['pc_from']; 

if(isset($_POST['update']) and $_POST['update'] == 'pc'){
	 $updatepc=mysql_query("UPDATE pages_comm SET 
	 pc_name  ='$pcname',
	 pc_mail  ='$pcmail',
	 pc_ip    ='$pcip',
	 pc_date  ='$pcdate',
	 pc_text  ='$pctxt',
	 pc_active='$pcact',
	 page_id  ='$pageid',
	 pc_from  ='$pcfrom'
	  WHERE pc_id='".$pcid."'")or die (mysql_error());
	  
	  if(isset($updatepc)){
		  die(" 
	   <center>تم تعديل بنجاح</center>
	   <meta http-equiv='refresh' content='2; url=?cpages=pages_comm' />
      ");
		  
		  
	  }
	
}
   
///////////////////////////////end delete//////////////////////

///////////////////////////////update//////////////////////

// TABLE pages_comm = pc_id,pc_name,pc_mail,pc_ip,pc_date,pc_text,pc_active,page_id,pc_from
$show2edit=mysql_query("SELECT * FROM pages_comm WHERE pc_id='".$gid."'")or die (mysql_error());
$rows2e=mysql_fetch_object($show2edit);

if($_REQUEST['edit'] == 'pc'){
echo"
<form action='?cpages=pages_comm' method='post'>
<table width='100%' align='center' cellpadding='0' cellspacing='0'>
<tr>
    <td colspan='2' class='tbl' align='center'>تعديل التعليق</td>
</tr>
<tr>
    <td width='20%' class='tbl2'>اسم المعلق</td>
	<td width='80%' class='tbl2'>
	<input type='text' name='pc_name' value='".$rows2e->pc_name."' />
	</td>
</tr>
<tr>
    <td width='20%' class='tbl3'>البريد الالكتروني</td>
	<td width='80%' class='tbl3'>
	<input type='text' name='pc_mail' value='".$rows2e->pc_mail."' />
	</td>
</tr>
<tr>
    <td width='20%' class='tbl2'>الدولة</td>
	<td width='80%' class='tbl2'>
	<input type='text' name='pc_from' value='".$rows2e->pc_from."' />
	</td>
</tr>
<tr>
    <td width='20%' class='tbl3'>التعليق</td>
	<td width='80%' class='tbl3'>
	<textarea name='pc_text' rows='8' cols='45'>".$rows2e->pc_text."</textarea>
	</td>
</tr>
<tr>
    <td width='20%' class='tbl2'>حاله التعليقات</td>
	<td width='80%' class='tbl2'>
	<select name='pc_active'>";
	
if($rows2e->pc_active==2){
	echo"
	    <option value='1'>مفعل</option>
		<option value='2'>غير مفعل</option>
	    ";
}else{
	echo"
	    <option value='2'>غير مفعل</option>
	    <option value='1'>مفعل</option>
	    ";
}
	
echo"
	</select>
	</td>
</tr>
<tr>
    <td align='center' colspan='2' class='tbl3'>
	<input class='buttons' type='submit' value='حفظ التعديلات' />
	</td>
</tr>
</table>
<input type='hidden' name='pc_id' value='".$gid."' />
<input type='hidden' name='pc_ip' value='".$rows2e->pc_ip."' />
<input type='hidden' name='page_id' value='".$rows2e->page_id."' />
<input type='hidden' name='pc_date' value='".$rows2e->pc_date."' />
<input type='hidden' name='update' value='pc' />

</form>
";
}

// TABLE pages_comm = pc_id,pc_name,pc_mail,pc_ip,pc_date,pc_text,pc_active,page_id,pc_from 




////////////////////////////////////////////////////////////////



$showpagescomm=mysql_query("SELECT * FROM pages_comm INNER JOIN pages
    ON pages_comm.page_id=pages.page_id ORDER BY pages_comm.pc_id DESC" )
    or die ("<center><h3>MYSQL Error</h3></center>");// طريقه عمل انضمام عبر الربط بين جدولين

echo"
<table width='100%' align='center' cellspacing='0' cellpadding='0'>
  <tr>
    <td align='center' colspan='4' class='tbl'>التعليقات المتوفر</td>
  </tr>
  <tr>
   <td width='20%' class='tbl3'>المعلق</td>
   <td width='40%' class='tbl3'>جزء من التعليق</td>
   <td width='20%' class='tbl3'>علق على الصفحه</td>
   <td width='20%' class='tbl3'>الخيارات</td>
  </tr>
 ";
while($rowpc=mysql_fetch_object($showpagescomm)){
echo"
 <tr>
    <td width='20%' class='tbl2'>".$rowpc->pc_name."</td>
   <td width='40%' class='tbl2'>".mb_substr($rowpc->pc_text, 0, 30, "UTF-8")." ....</td>
   <td width='20%' class='tbl2'><a href='../page.php?page_id=".$rowpc->page_id."' target='_blank'>".$rowpc->page_name."</a></td><!-- target='_blank' اي افتح في صفحه جديده -->
   <td width='20%' class='tbl2'>
   <a href='?cpages=pages_comm&delete=pc&pc_id=".$rowpc->pc_id."'>حذف</a> - 
   <a href='?cpages=pages_comm&edit=pc&pc_id=".$rowpc->pc_id."'> التعديل</a>
   </td>
</tr>
 ";
	
}

echo"</table> ";


?>