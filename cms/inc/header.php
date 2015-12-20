

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $sname; ?></title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<link href="css/panels.css" rel="stylesheet" type="text/css" />
<meta name="description" content="<?php echo $sdesc; ?>"/>
<meta name="keywords" content="<?php echo $stags; ?>"/>
</head>

<body>
<div id="cliprz">

<!--header-->
<table  width="100%" align="center" cellpadding="0" cellspacing="0">
<tr>
    <td>
<div id="header">
	<img src="images/logo.png" alt="مدرسة كليبرز"  />
</div>

<div id="navbar">
	<ul>
    	<li><a href="index.html" title="الرئيسية">الرئيسية</a></li>
        <li><a href="index.html" title="الرئيسية">الرئيسية</a></li>
        <li><a href="index.html" title="الرئيسية">الرئيسية</a></li>
        <li><a href="index.html" title="الرئيسية">الرئيسية</a></li>
        <li><a href="index.html" title="الرئيسية">الرئيسية</a></li>
        <li><a href="index.html" title="الرئيسية">الرئيسية</a></li>
    </ul>
</div>  
    </td>
</tr>
</table>
<!--header//--><?php if($shturn==1) {?>
<table width="100" align="center" cellspacing="0" cellpadding="0">
  <tr>
    <td><?php echo $sh ; ?></td>
  </tr>
</table>
<?php } ?>



<!--Body panels-->
<table width="100%" align="center" cellpadding="5" cellspacing="3">
<tr>
    <td valign="top" width="20%">
   <?php include "inc/rblock.php"; ?>
    </td>