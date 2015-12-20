<?php




# connect to mysqlclass
class con_sql{
#privates propreties
private $dbhost,$dbuser,$dbpass;

#methods
#here used constructer for method and propties
#Doing Thent tostar connection with mysql

public function __construct($host,$user,$pass) 
{
	
	$this->dbhost=$host;
	$this->dbuser=$user;
	$this->dbpass=$pass;
}
#here you have acon fun to used selected propretie
#To do connect with the funcion mysql.connect();

public function con(){
	@mysql_connect($this->dbhost,$this->dbuser,$this->dbpass) or die (mysql_error());
}

#here you have aselect dbveaused mysql-selected-db

  public function select ($data){
	@mysql_select_db($data) or die("not selecte data base");

  }
}
$con=mysql_pconnect("localhost","root","root");// اتصال دائم وسريعه الاتصال بدل
$db=mysql_select_db("cms");
//if($con){
	//echo"ok";}
/*$DB_HOST="localhost";
$DB_NAME="cms";
$DB_USER="root";
$DB_PASS="root";
 

$con=new consql($DB_HOST,$DB_USER,$DB_PASS);
$con->con();
$con->select_db($DB_NAME);
*/

?>