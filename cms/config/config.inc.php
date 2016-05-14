<?
$db_username = "dbhlimo";
$db_password = "Scarlet2010!";
$db_server = "dbhlimo.db.5839975.hostedresource.com";
$db_db = "dbhlimo";

$mdb = mysql_connect($db_server,$db_username,$db_password) or trigger_error(mysql_error(),E_USER_ERROR);
mysql_select_db($db_db,$mdb);

//your databse hostname.
$db_host = "dbhlimo.db.5839975.hostedresource.com";
//your database name.
$database_name = "dbhlimo";
$databse_name = $db_db;
//tables prefix. Don't change unless you change this value in the db.
$prefix = "site";

$CONFIG_baseurl = "/home/content/75/5839975/html/dbhlimo/";
$pwz_require = $CONFIG_baseurl . "cms/pwz/auth.inc.php";
$pwz_path = $CONFIG_baseurl . "cms/pwz/";
include_once($CONFIG_baseurl.'cms/tools.inc.php');
//include($_SERVER['DOCUMENT_ROOT'].'/inc/class.phpmailer.php'); 

$sql = "SELECT * FROM site_cfg WHERE id = 2";
$result = mysql_query($sql,$mdb);
$config = mysql_fetch_row($result);
$CONFIG_keywords = $config[1];
$CONFIG_description = $config[2];
$CONFIG_email_address = $config[5];
$CONFIG_page_title = $config[3];
$CONFIG_site_name = $config[4];
?>