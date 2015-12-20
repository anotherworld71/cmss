<?php 
#القائمة اليمني
//Table blocks=b_id,b_dir,b_order,b_name,b_content,b_active

$right_block=mysql_query("select * from blocks where b_dir='1' order by b_order asc") or die("MYSQL Error");
$num_right_block=mysql_num_rows($right_block);
if($num_right_block > 0){
while($right_block_row=mysql_fetch_object($right_block)){
	 if($right_block_row->b_active==1){
	
	echo"
	<div class='head'>        ".$right_block_row->b_name."     </div>
	<div class='bodypanel'>   ".$right_block_row->b_content."  </div>
	
	";
	 }
	 }
}

?>


<?php 
#القائمة اليسار
//Table blocks=b_id,b_dir,b_order,b_name,b_content,b_active

$left_block=mysql_query("select * from blocks where b_dir='4' order by b_order asc") or die("MYSQL Error");
$num_left_block=mysql_num_rows($left_block);
if($num_left_block > 0){
while($left_block_row=mysql_fetch_object($left_block)){
	 if($left_block_row->b_active==1){
	
	echo"
	<div class='head'>        ".$left_block_row->b_name."     </div>
	<div class='bodypanel'>   ".$left_block_row->b_content."  </div>
	
	";
	 }
	 }
}

?>