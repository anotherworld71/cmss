<?php

//tablepage=page_id,page_name,page_content,page_act,page_count ,page_comm_act

$p_name       =strip_tags($_POST['page_name']);
$p_content    =addslashes($_POST['page_content']);
$p_act        =$_POST['page_act'];
$p_comm_act   =$_POST['page_comm_act'];
$p_count      =$_POST['page_count'];
$page_id      =$_POST['page_id'];
$gpageid      = intval($_GET['page_id']);
##########################################################

if(isset($_POST[add]) and $_POST['add'] == 'newpage'){
	 
	$addnewpage=mysql_query("insert into pages
	(page_name,page_content,page_act,page_count ,page_comm_act)
	values 
	('$p_name','$p_content','$p_act ','$p_count','$p_comm_act')$rowpages->page_id") or die(mysql_error());
	
	if(isset($addnewpage)){
	die("
	<center> تم اضافه الصفحه بنجاح</center>
	
	");
}
}
########################################
#تعديل 

if(isset($_POST['edit']) and $_POST['edit'] == 'page'){

   $updatpages = mysql_query("update pages set 
   page_name='$p_name',
   page_content='$p_content',
   page_act='$p_act ',
   page_count='$p_count',
   page_comm_act='$p_comm_act'
   where page_id='$page_id'
   ") or die (mysql_error());
   
   if(isset($updatpages)){
	die("
	<center>  تم التعديل بنجاح</center>
	<meta http-equiv='refresh' content='2; url=?cpages=custom_pages' />
	");
}
   	
}

###########################################
// الحدف
if($_REQUEST['delete']=='page'){
	$delpage=mysql_query("delete from pages where page_id='$gpageid' ")or die (mysql_error());
	
	 if(isset($delpage)){
	die("
	<center> تم حذف الصفحه بنحاح</center>
	<meta http-equiv='refresh' content='2; url=?cpages=custom_pages' />
	");
}
}

##########################################
// لتفعيل الصفحه

if($_REQUEST['activepage']=='active'){
	$actpage=mysql_query("update pages set page_act='1' where page_id='$gpageid'")or die(mysql_error());
	
	 if(isset($actpage)){
	die("
	<center> تم تفعيل الصفحه بنجاح</center>
	<meta http-equiv='refresh' content='2; url=?cpages=custom_pages' />
	");
}
	}
###############################################
// الفاء التفعيل
if($_REQUEST['activepage']=='notactive'){
	$actnotpage=mysql_query("update pages set page_act='2' where page_id='$gpageid'")or die(mysql_error());
	
	 if(isset($actnotpage)){
	die("
	<center> تم الغاء تفعيل الصفحه بنجاح</center>
	<meta http-equiv='refresh' content='2; url=?cpages=custom_pages' />
	");
}
}

#################################################
// لتفعيل  التعليقات
if($_REQUEST['commactive']=='active'){
	$comact=mysql_query("update pages set page_comm_act='1' where page_id='$gpageid'")or die(mysql_error());
	 if(isset($comact)){
	die("
	<center>  تم تفعيل التعليقات لهذي الصفحه</center>
	<meta http-equiv='refresh' content='2; url=?cpages=custom_pages' />
	");
}
	
	}
	
###############################3
//لالغاء تفعيل التعليقات

if($_REQUEST['commactive']=='notactive'){
	$comnotact=mysql_query("update pages set page_comm_act='2' where page_id='$gpageid'")or die(mysql_error());
	 if(isset($comnotact)){
	die("
	<center> تم الغاء تفعيل التعليقات بهذه الصفحه</center>
	<meta http-equiv='refresh' content='2; url=?cpages=custom_pages' />
	");
}
	
	}




echo"<a href='?cpages=custom_pages&add=pages'><center><h3>اضافه قائمه جديده</h3></center></a><br />";

if($_REQUEST['add'] == 'pages'){
echo"
<form action='?cpages=custom_pages' method='post'>
<table width='100%' align='center' cellpadding='0' cellspacing='0'>
<tr>
    <td colspan='2'  class='tbl'> اضافه صفحه جديدة</td>
</tr>
<tr>
    <td class='tbl2' width='20%'> اسم الصفحه</td>
    <td class='tbl2' width='80%'><input type='text' name='page_name' /></td>
</tr>
<tr>
    <td class='tbl3' width='20%'>محتوى الصفحه</td>
    <td class='tbl3' width='80%'>
    <textarea name='page_content' rows='8' cols'40'></textarea>
    </td>
</tr>
<tr>
    <td class='tbl2' width='20%'>الصفحه ضهور حاله</td>
    <td class='tbl2' width='80%'>
     <select name='page_act'>
            <option value='1'> مفعله لزوار</option>
            <option value='2'>غير ظاهر لزور</option>
     </select>
    </td>
</tr>
<tr>
    <td class='tbl3' width='20%'>تعليقات على الصفحه </td>
    <td class='tbl3' width='80%'>
    <select name='page_comm_act'>
            <option value='1'> مفعله </option>
            <option value='2'> غير مفعله</option>
     </select>
    
   </td>
   </tr>
   <tr>
    <td  class='tbl2' colspan='2' align='center' width='20%'>
    <input  type='submit' class='tbl bottons ' value=' اضافه الصفحه'/>
    </td> 
</tr>
</table>
<input type='hidden' name='page_count' value='0' />
<input type='hidden' name='add' value='newpage' />
</form>

";
}

#===================================================================#
#فورم التعديل 



$showpagetoedit = mysql_query("select * from pages where page_id='$gpageid'") or die (mysql_error());
$rowpageedit = mysql_fetch_object($showpagetoedit);
if($_REQUEST['edit'] == 'pages'){
	
	echo"
<form action='?cpages=custom_pages' method='post'>
<table width='100%' align='center' cellpadding='0' cellspacing='0'>
<tr>
    <td colspan='2'  class='tbl'> تعديل الصفحه</td>
</tr>
<tr>
    <td class='tbl2' width='20%'> اسم الصفحه</td>
    <td class='tbl2' width='80%'><input type='text' name='page_name' value='".$rowpageedit->page_name."' /></td>
</tr>
<tr>
    <td class='tbl3' width='20%'>محتوى الصفحه</td>
    <td class='tbl3' width='80%'>
    <textarea name='page_content' rows='8' cols'40' > ".$rowpageedit->page_content."</textarea>
    </td>
</tr>
<tr>
    <td class='tbl2' width='20%'>الصفحه ضهور حاله</td>
    <td class='tbl2' width='80%'>
     <select name='page_act'>";
	 
if($rowpageedit->page_act == 1){
	echo"	 
<option value='1'> مفعله لزوار</option>
<option value='2'>غير ظاهر لزور</option>
	";
}else{
	echo"
	<option value='2'>غير ظاهر لزور</option>
	<option value='1'> مفعله لزوار</option>
	";
}
 echo"
     </select>
    </td>
</tr>
<tr>
    <td class='tbl3' width='20%'>تعليقات على الصفحه </td>
    <td class='tbl3' width='80%'>
    <select name='page_comm_act'>
          ";
      
	  if($rowpageedit->page_comm_act == 1){
	echo"	 
<option value='1'> التعليقات مفعله</option>
<option value='2'> التعليقات غير مفعله</option>
	";
}else{
	echo"
	<option value='2'> التعليقات غير مفعله </option>
	<option value='1'> التعليقات مفعله</option>
	";
}
	  
	  
	echo"     
     </select>
    
   </td>
   </tr>
   <tr>
    <td  class='tbl2' colspan='2' align='center' width='20%'>
    <input  type='submit' class='tbl bottons ' value=' حفظ التعديلات'/>
    </td> 
</tr>
</table>
<input type='hidden' name='page_count' value='".$rowpageedit->page_count."' />// لان لما نعديل المفروض تضل المشاهدات كماهي ولا تعدل اي تعكمل وهو مخفي
<input type='hidden' name='edit' value='page' />
<input type='hidden' name='page_id' value='".$rowpageedit->page_id."' />
</form>

	
	";
	
}



#==============================================================#
//عرض البيانات

$showpages=mysql_query("select * from pages order by page_id asc") or die(mysql_error());


echo"

<table width='100%' align='center' cellpadding='0' cellspacing='0'>
<tr>
    <td colspan='4' align='center' class='tbl'>الصفحات الموجودة</td>
</tr>

<tr>
    <td class='tbl2' width='35%'>اسم الصفحه</td>
	<td class='tbl2' width='5%'> الريارات</td>
	<td class='tbl2' width='30%'>رابط الصفحه</td>
	<td class='tbl2' width='30%'>الخيارات</td>
</tr>";

while ($rowpages=mysql_fetch_object($showpages))
{
	echo"
  <tr>
    <td class='tbl2' width='35%'>".$rowpages->page_name."</td>
	<td class='tbl2' width='5%'>".$rowpages->page_count." </td>
	<td class='tbl2' width='30%'><a href='../page.php?page_id=".$rowpages->page_id."'>مشاهده رابط الصفحه</a></td>
	<td class='tbl2' width='30%'>
	  <a href='?cpages=custom_pages&edit=pages&page_id=".$rowpages->page_id."'>تعديل</a> -
	  <a href='?cpages=custom_pages&delete=page&page_id=".$rowpages->page_id."'>حذف</a> -";
	 
	 if($rowpages->page_act==2){
		echo" <a href='?cpages=custom_pages&activepage=active&page_id=".$rowpages->page_id."'> تفعيل الصفحه</a> -"; 
	 }else{
		echo" <a href='?cpages=custom_pages&activepage=notactive&page_id=".$rowpages->page_id."'> الغاء تفعيل الصفحه</a> -"; 
	 }
	
	if($rowpages->page_comm_act==2){
		 echo"<a href='?cpages=custom_pages&commactive=active&page_id=".$rowpages->page_id."'>تفعيل التعليقات</a>";
	}else{
		 echo"<a href='?cpages=custom_pages&commactive=notactive&page_id=".$rowpages->page_id."'>الغاء تفعيل التعليقات</a>";
	
		}
	echo"
    </td>
  </tr>";

	
}

echo"
</table>
";




?>
