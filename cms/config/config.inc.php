<?
$db_username = "root";
$db_password = "root";
$db_server = "127.0.0.1";
$db_db = "limo_05112016";

$mdb = mysqli_connect($db_server,$db_username,$db_password) or trigger_error(mysqli_error(),E_USER_ERROR);
mysqli_select_db($mdb,$db_db);

//your databse hostname.
$db_host = "127.0.0.1";
//your database name.
$database_name = "limo_05112016";
$databse_name = $db_db;
//tables prefix. Don't change unless you change this value in the db.
$prefix = "site";

$CONFIG_baseurl = "/home/content/75/5839975/html/dbhlimo/";
$pwz_require = $CONFIG_baseurl . "cms/pwz/auth.inc.php";
$pwz_path = $CONFIG_baseurl . "cms/pwz/";
include_once($CONFIG_baseurl.'cms/tools.inc.php');
//include($_SERVER['DOCUMENT_ROOT'].'/inc/class.phpmailer.php'); 

$sql = "SELECT * FROM site_cfg WHERE id = 2";
$result = mysqli_query($sql,$mdb);
$config = mysqli_fetch_row($result);
$CONFIG_keywords = $config[1];
$CONFIG_description = $config[2];
$CONFIG_email_address = $config[5];
$CONFIG_page_title = $config[3];
$CONFIG_site_name = $config[4];
