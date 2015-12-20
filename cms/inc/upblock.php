<?php 
#القائمة اعلى الوسط
//Table blocks=b_id,b_dir,b_order,b_name,b_content,b_active

$up_block=mysql_query("select * from blocks where b_dir='2' order by b_order asc") or die("MYSQL Error");
$num_up_block=mysql_num_rows($up_block);
if($num_up_block > 0){
while($up_block_row=mysql_fetch_object($up_block)){
	 if($up_block_row->b_active==1){
	
	echo"
	<div class='head'>        ".$up_block_row->b_name."     </div>
	<div class='bodypanel'>   ".$up_block_row->b_content."  </div>
	
	";
	 }
 }
}

?>