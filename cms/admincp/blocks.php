<?php

//Table blocks=b_id,b_dir,b_order,b_name,b_content,b_active

$b_dir     =strip_tags($_POST['b_dir']);
$b_ord     =$_POST['b_order'];
$b_name    =strip_tags($_POST['b_name']);
$b_con     =addslashes($_POST['b_content']);
$b_act     =$_POST['b_active'];
$pid       =$_POST['b_id'];
$getblockid= intval($_GET['b_id']);# جلب الايدي


if(isset($_POST['add']) and $_POST['add']=='block') {

   if(empty($b_ord)){
       echo"<center>يرجى اجخال ترتيب البلوك </center>";
       }else if(empty($b_name)){
       echo"<center>ادخل اسم اللقائمة لو سمحت </center>";
       }else if(empty($b_con)){
       echo"<center>ادخل محتوى للقائمه </center>";
       }else{
       $addblock =mysql_query("insert into blocks 
       (b_id,b_dir,b_order,b_name,b_content,b_active)
        values
        (0,'$b_dir','$b_ord','$b_name','$b_con','$b_act')") or die (myspl_error());
       
        if(isset($addblock)){
       die("
        <center>تم اضافة القائمة بنجاح</center>
        <mete http-equiv='refresh' content='2; url=?cpages=blocks' />
        ");
       }
    }
}

#==============================#


if(isset($_POST['edit']) and $_POST['edit'] == 'blocks') {

$updateblocks=mysql_query("update blocks set

b_dir       ='$b_dir',
b_order     ='$b_ord',
b_name      ='$b_name',
b_content   ='$b_con',
b_active    ='$b_act' 
where b_id  ='$pid'") or die (mysql_error());	

if(isset($updateblocks)){
die("
<center>تم حفظ التعديلات على القائمة</center>
<meta http-equiv='refresh' content='2; url=?cpages=blocks' />
");	
}
 
}


if($_REQUEST['delete']=='block'){
	$deleteblock=mysql_query("delete from blocks where b_id='$getblockid'")or die(mysql_error());

if(isset($deleteblock)){ 
	
	die("
<center>تم حذف القائمه</center>
<meta http-equiv='refresh' content='2; url=?cpages=blocks' />
");	
	}
}

if($_REQUEST['active']=='block'){
	$activeblock=mysql_query("update blocks set b_active='1' where b_id='$getblockid'")or die(mysql_error());
	
	if(isset($activeblock)){ 
	
	die("
<center>تم تفعيل ضهور القائمه</center>
<meta http-equiv='refresh' content='2; url=?cpages=blocks' />
");	
	}
}
#==============================#
echo"<br /><center><h3><a href='?cpages=blocks&add=newblock'>اضف قائمة جديده</a></h3></center><br />";

if($_REQUEST['add']=='newblock'){



echo"
<form action='?cpages=blocks' method='post'>

<table align='center' width='100%'  cellspacing='0' cellpadding='0'>
  <tr>
    <td class='tbl' align='center' width='100%' colspan='2' >قائمة اضافة</td>
  </tr>
  <tr>
    <td class='tbl2'width='20%'>القائمة اسم</td>
    <td class='tbl2'width='80%'><input type='text' name='b_name' /></td>
  </tr>
 <tr>
    <td class='tbl3'width='20%'>ترتيب القائمة</td>
    <td class='tbl3'width='80%'><input size='4' type='text' name='b_order' /></td>
   </tr>
 <tr>
    <td class='tbl2'width='20%'>مكان القائمة</td>
    <td class='tbl2' width='80%'>
    <select name='b_dir'>
        <option value='1'>يمين</option>
         <option value='2'>اعلى المنتصف</option>
          <option value='3'>اسفل المنتصف</option>
           <option value='4'>يسار</option>
     </select>      
    </td>
  </tr>
  <tr>
    <td class='tbl3'width='20%'>محتوى القائمه</td>
    <td class='tbl3'width='80%'><textarea row='8' cols='40' name='b_content'></textarea></td>
  </tr>
  <tr>
    <td class='tbl2' width='20%'>ضهور حاله القائمه</td>
    <td class='tbl2' width='80%'>
    <select name='b_active'>
       <option value='1'>مفعلة</option>
        <option value='2'>غير مفعله</option>
    </select>    
    </td>
  </tr>
  <tr>
    <td align='center' width='100' colspan='2' class='tb3'>
       <input class='bottons' type='submit' value='حفظ القائمة'/>
    </td>
  </tr>
</table>
<input type='hidden' name='add' value='block' />

</form>

";
}


#=======================================#


$showblocktoedit=mysql_query("select * from blocks where b_id ='$getblockid'")or die (mysql_error());
$rowblocktoedit=mysql_fetch_object($showblocktoedit);

#=======================================#

#ريكوست التعديل
if($_REQUEST['edit']== 'block'){
echo"
<form action='?cpages=blocks' method='post'>

<table align='center' width='100%'  cellspacing='0' cellpadding='0'>
  <tr>
    <td class='tbl' align='center' width='100%' colspan='2' >تعديل القائمه</td>
  </tr>
  <tr>
    <td class='tbl2'width='20%'>القائمة اسم</td>
    <td class='tbl2'width='80%'><input type='text' name='b_name' value='".$rowblocktoedit->b_name."' /></td>
  </tr>
 <tr>
    <td class='tbl3'width='20%'>ترتيب القائمة</td>
    <td class='tbl3'width='80%'><input size='4' type='text' name='b_order' value='".$rowblocktoedit->b_order."' /></td>
  </tr>
 <tr>
    <td class='tbl2'width='20%'>مكان القائمة</td>
    <td class='tbl2' width='80%'>
    <select name='b_dir'>
        ";
		
if($rowblocktoedit->b_dir==1){
echo"
<option value='1'>يمين</option>
         <option value='2'>اعلى المنتصف</option>
          <option value='3'>اسفل المنتصف</option>
           <option value='4'>يسار</option>
";
	
}else if($rowblocktoedit->b_dir==2){
	echo"
        <option value='2'>اعلى المنتصف</option>
		 <option value='1'>يمين</option>
          <option value='3'>اسفل المنتصف</option>
           <option value='4'>يسار</option>
";
	
}else if($rowblocktoedit->b_dir==3){
	echo"
       <option value='3'>اسفل المنتصف</option>
         <option value='2'>اعلى المنتصف</option>
		  <option value='1'>يمين</option>
           <option value='4'>يسار</option>
";
}else{
	echo"
       <option value='4'>يسار</option>
         <option value='2'>اعلى المنتصف</option>
          <option value='3'>اسفل المنتصف</option>
		    <option value='1'>يمين</option>
";
	
	
}
		
		echo"
     </select>      
    </td>
  </tr>
  <tr>
    <td class='tbl3'width='20%'>محتوى القائمه</td>
    <td class='tbl3'width='80%'><textarea row='8' cols='40' name='b_content'>".$rowblocktoedit->b_content."</textarea></td>
  </tr>
  <tr>
    <td class='tbl2' width='20%'>ضهور حاله القائمه</td>
    <td class='tbl2' width='80%'>
    <select name='b_active'>
 ";

if($rowblocktoedit->b_active==1){
	echo"
	 <option value='1'>مفعلة</option>
        <option value='2'>غير مفعله</option>
";
}else{
	echo"
        <option value='2'>غير مفعله</option>
		 <option value='1'>مفعلة</option>
";
}
 
 echo"
    </select>    
    </td>
  </tr>
  <tr>
    <td align='center' width='100' colspan='2' class='tb3'>
       <input class='bottons' type='submit' value='حفظ القائمة'/>
    </td>
  </tr>
</table>
<input type='hidden' name='edit' value='blocks' />
<input type='hidden' name='b_id' value='b_id' value='".$rowblocktoedit->b_id."' />;

</form>

";		
}


echo"<br />";

echo"
<table align='center' width='100%'  cellspacing='0' cellpadding='0'>
<tr>
    <td class='tbl' align='center' width='100%' colspan='4' >القوائم المتوفره</td>
</tr>
<tr>
    <td class='tbl2'>ترتيب القائمة</td>
    <td class='tbl3'>اسم القائمه</td>
    <td class='tbl3'>الخيارات</td>
</tr>";

//عرض القائم هاليمني
$right_block=mysql_query("select b_id,b_dir,b_order,b_name,b_active from blocks where b_dir='1' order by b_order asc ")or die (mysql_error());
$right_block_num=mysql_num_rows($right_block);

if($right_block_num > 0){
echo"
<tr>
     <td class='tbl2' width='100%' colspan='3'>محتويات القائمه اليمنى</td>
</tr>
";
while($row_right_block=mysql_fetch_object($right_block)){
echo"
<tr>
    <td class='tbl3'>".$row_right_block->b_order."</td>
    <td class='tbl3'>".$row_right_block->b_name."</td>
    <td class='tbl3'><a href='?cpages=blocks&edit=block&b_id=".$row_right_block->b_id."'>التعديل</a> - 
	<a href='?cpages=blocks&delete=block&b_id=".$row_right_block->b_id."'>حذف</a>- 
	<a href='?cpages=blocks&active=block&b_id=".$row_right_block->b_id."'>التفعيل</a></td>
</tr>
";
}

//عرض القائمه اليسرى
$left_block=mysql_query("select b_id,b_dir,b_order,b_name,b_active from blocks where b_dir='4' order by b_order asc ")or die (mysql_error());
$left_block_num=mysql_num_rows($left_block);

if($left_block_num > 0){
echo"
<tr>
     <td class='tbl2' width='100%' colspan='3'>محتويات القائمه اليسرى</td>
</tr>
";
while($row_left_block=mysql_fetch_object($left_block)){
echo"


<tr>
    <td class='tbl3'>".$row_left_block->b_order."</td>
    <td class='tbl3'>".$row_left_block->b_name."</td>
    <td class='tbl3'><a href='?cpages=blocks&edit=block&b_id=".$row_left_block->b_id."'>التعديل</a> -
	 <a href='?cpages=blocks&delete=block&b_id=".$row_left_block->b_id ."'>حذف</a> - <a href=''>التفعيل</a></td>
</tr>
";
}
}

//عرض محتويات القائمه العلويه

$up_block=mysql_query("select b_id,b_dir,b_order,b_name,b_active from blocks where b_dir='2' order by b_order asc ")or die (mysql_error());
$up_block_num=mysql_num_rows($up_block);

if($up_block_num > 0){
echo"
<tr>
     <td class='tbl2' width='100%' colspan='3'>محتويات القائمه اعلى الوسط </td>
</tr>
";

while($row_up_block=mysql_fetch_object($up_block)){
echo"


<tr>
    <td class='tbl3'>".$row_up_block->b_order."</td>
    <td class='tbl3'>".$row_up_block->b_name."</td>
    <td class='tbl3'><a href='?cpages=blocks&edit=block&b_id=".$row_up_block->b_id."'>التعديل</a> - <a href='?cpages=blocks&delete=block&b_id=".$row_up_block->b_id ."'>حذف</a> - <a href=''>التفعيل</a></td>
</tr>
";
}
}

//عرض محتويات القائمه اسفل
$down_block=mysql_query("select b_id,b_dir,b_order,b_name,b_active from blocks where b_dir='3' order by b_order asc ")or die (mysql_error());
$down_block_num=mysql_num_rows($down_block);

if($down_block_num > 0){
echo"
<tr>
     <td class='tbl2' width='100%' colspan='3'>محتويات القائمه اعلى اسفل </td>
</tr>
";
while($row_down_block=mysql_fetch_object($down_block)){
echo"
<tr>
    <td class='tbl3'>".$row_down_block->b_order."</td>
    <td class='tbl3'>".$row_down_block->b_name."</td>
    <td class='tbl3'><a href='?cpages=blocks&edit=block&b_id=".$row_down_block->b_id."'>التعديل</a> - <a href='?cpages=blocks&delete=block&b_id=".$row_down_block->b_id ."'>حذف</a> - <a href=''>التفعيل</a></td>
</tr>
";
}
}

echo" 
</table>
";
}

?>
