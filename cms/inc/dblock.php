<?php 
#اسفل الوسط
//Table blocks=b_id,b_dir,b_order,b_name,b_content,b_active

$down_block=mysql_query("select * from blocks where b_dir='3' order by b_order asc") or die("MYSQL Error");
$num_down_block=mysql_num_rows($down_block);
if($num_down_block > 0){
while($down_block_row=mysql_fetch_object($down_block)){
	 if($down_block_row->b_active==1){
	
	echo"
	<div class='head'>        ".$down_block_row->b_name."     </div>
	<div class='bodypanel'>   ".$down_block_row->b_content."  </div>
	
	";
	 }
	 }
}

?>