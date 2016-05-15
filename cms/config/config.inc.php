<?php
$db_username = "dbhlimo";
$db_password = "Scarlet2010!";
$db_host = "dbhlimo.db.5839975.hostedresource.com"; //your databse hostname.
$database_name = "dbhlimo"; //your database name.
$prefix = "site"; //tables prefix. Don't change unless you change this value in the db.

$mdb = mysqli_connect($db_host,$db_username,$db_password) or trigger_error(mysqli_error(),E_USER_ERROR);
mysqli_select_db($mdb,$database_name);

$CONFIG_baseurl = "/home/content/75/5839975/html/dbhlimo/";
$pwz_require = $CONFIG_baseurl . "cms/pwz/auth.inc.php";
$pwz_path = $CONFIG_baseurl . "cms/pwz/";
include_once($CONFIG_baseurl.'cms/tools.inc.php');
//include($_SERVER['DOCUMENT_ROOT'].'/inc/class.phpmailer.php'); 

$sql = "SELECT * FROM site_cfg WHERE id = 2";
$result = mysqli_query($mdb,$sql);
$config = mysqli_fetch_row($result);
$CONFIG_keywords = $config[1];
$CONFIG_description = $config[2];
$CONFIG_email_address = $config[5];
$CONFIG_page_title = $config[3];
$CONFIG_site_name = $config[4];
