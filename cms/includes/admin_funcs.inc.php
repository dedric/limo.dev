<?php
//skip the functions file if somebody call it directly from the browser.
if (preg_match("/functions.php/", $_SERVER['SCRIPT_NAME'])) {
    Header("Location: index.php"); die();
}


// Report all errors and ignor notices
error_reporting(E_ALL ^ E_NOTICE);

// Disable magic_quotes_runtime
if(get_magic_quotes_runtime()){
    // Deactivate
    set_magic_quotes_runtime(false);
}

//if (!ini_get("register_globals")) {
//    import_request_variables('GPC');
//}

$phpver = phpversion();
if ($phpver < '4.1.0') {
	$_GET = $HTTP_GET_VARS;
	$_POST = $HTTP_POST_VARS;
	$_SERVER = $HTTP_SERVER_VARS;
}
$phpver = explode(".", $phpver);
$phpver = "$phpver[0]$phpver[1]";
if ($phpver >= 41) {
	$PHP_SELF = $_SERVER['PHP_SELF'];
}


if(isset($admin)){
$admin = base64_decode($admin);
$admin = addslashes($admin);
$admin = base64_encode($admin);
}
if(isset($user)){
$user = base64_decode($user);
$user = addslashes($user);
$user = base64_encode($user);
}

foreach ($_GET as $sec_key => $secvalue) {
	if ((preg_match("/<[^>]*script*\"?[^>]*>/i", $secvalue)) ||
	(preg_match("/<[^>]*object*\"?[^>]*>/i", $secvalue)) ||
	(preg_match("/<[^>]*iframe*\"?[^>]*>/i", $secvalue)) ||
	(preg_match("/<[^>]*applet*\"?[^>]*>/i", $secvalue)) ||
	(preg_match("/<[^>]*meta*\"?[^>]*>/i", $secvalue)) ||
	(preg_match("/<[^>]*style*\"?[^>]*>/i", $secvalue)) ||
	(preg_match("/<[^>]*form*\"?[^>]*>/i", $secvalue)) ||
	(preg_match("/<[^>]*img*\"?[^>]*>/i", $secvalue)) ||
	(preg_match("/<[^>]*onmouseover*\"?[^>]*>/i", $secvalue)) ||
	(preg_match("/([^>]*\"?[^)]*/i)", $secvalue)) ||
	(preg_match("/\"/", $secvalue))) {
		die ("not allowed");
	}
}
foreach ($_POST as $secvalue) {
	if ((preg_match("/<[^>]*onmouseover*\"?[^>]*>/i", $secvalue)) ||
        (preg_match("<[^>]script*\"?[^>]*>/i", $secvalue)) ||
        (preg_match("<[^>]meta*\"?[^>]*>/i", $secvalue)) ||
        (preg_match("<[^>]style*\"?[^>]*>/i", $secvalue))) {
		die ("not allowed");
	}
}

//set root path
$ROOT_DIR = realpath(dirname(__FILE__));
$ROOT_DIR = str_replace('\\', '/', $ROOT_DIR);

include ("$ROOT_DIR/config.inc.php");

include ("$ROOT_DIR/mysql.class.php");

if(!$mdb) {
      include("hdr.inc.php");

      //if connection to database/login faild, print error.
      echo "<br><font color=\"red\"><h5><br><center>Error:</b><br><hr><br>
            <b>Connection to database has faild!<br>
            check mysql server/database name/username/password </center>
            <br><br><br><br><br><br><br><br><br>";
      echo mysqli_error($mdb);
      include("ftr.inc.php");
      die();
}
//load the site options and info from db.
$options_sql = mysqli_query($mdb,"SELECT * FROM ".$prefix."_options");
$options = mysqli_fetch_row($options_sql);

$site_name = stripslashes($options['site_name']);
$site_email= stripslashes($options['site_email']);
$site_url = stripslashes($options['site_url']);
$site_info = stripslashes($options['site_info']);
$language = stripslashes($options['language']);
$tmp_header = stripslashes($options['tmp_header']);
$tmp_footer = stripslashes($options['tmp_footer']);
$validate = intval($options['validate']);

//load the language
include ("$ROOT_DIR/../lang/$language.php");

//global function for checkig whethar user is logged in or not.
//you will notice we will use it everwhere in the script.
/*function is_logged_in($user) {
    global $db,$prefix;

    $read_cookie = explode("|", base64_decode($user));
    $userid = addslashes($read_cookie[0]);
    $passwd = $read_cookie[2];
    $userid = intval($userid);
    
    if ($userid != "" AND $passwd != "") {
        $result = $db->sql_query("SELECT password FROM ".$prefix."_users WHERE userid='$userid'");
	$row = $db->sql_fetchrow($result);
        $pass = $row['password'];
	if($pass == $passwd && $pass != "") {
           return 1;
	}
    }
    return 0;
}*/

function is_logged_in_admin($admin) {
    global $mdb,$prefix;
	
	

    $read_cookie = explode("|", base64_decode($admin));
    $adminid = addslashes($read_cookie[0]);
    $passwd = $read_cookie[2];
    $adminid = intval($adminid);
        
    if ($adminid != "" AND $passwd != "") {
        $result =mysqli_query($mdb,"SELECT password FROM ". $prefix ."_admin WHERE adminid='".$adminid."'");
	$row = mysqli_fetch_row($result);
        $pass = $row['password'];
	if($pass == $passwd && $pass != "") {
           return 1;
		}
    }
    return 0;
}


function msg_redirect($msg,$url,$seconds){
         global $site_name;

echo('<html dir="'._LTR_RTL.'">
	  <head>
	  <title>'.$site_name.'</title>
	  <meta http-equiv="Refresh" content="'.$seconds.'; URL='.$url.'">
      <meta http-equiv="Content-Type" content="text/html; charset="'._CHARSET.'">
      <link rel="stylesheet" href="css/CMS_3.0.css" type="text/css">
	  </head>
	  <body>
	  <table cellpadding="0" cellspacing="0" border="0" width="100%" height="100%">
	  <tr><td align="center" valign="middle">
	  	  <table cellpadding="0" cellspacing="2" border="0" width="700">
		  <tr><td class="cms_title">'._REDIRECTING.'</td></tr>
		  <tr><td class="cms_text" align="center">'.$msg.'</td></tr>
		  <tr><td class="cms_text" align="center"><a href="'.$url.'" class="cms_link">'._CLICK_HERE_BROWSER_REDIRECT.'</a></td></tr>
		  </table>
	  </td></tr>
	  </table>
	  </body>
	  </html>');
}


///////////////////////////////////////////////MOVED FUNCTIONS//////////////////////////////////////////////////////////////////

//LOGIN FORM FUNCTION, YEAH I'M MOVING THIS TO FUNCTIONS
function login_form(){
         global $admin_name,$admin_err,$pass_err,$error_msg;

	echo	('<form method="POST" action="index.php" name="loginform">
			  <table cellspacing="0" border="0">
			  <tr><td align="left" class="cms_title">LOGIN:</td></tr>');
			  
	if(isset($error_msg)){
		echo	('<tr><td align="left" class="cms_login_error">'.$error_msg.' '.$pass_err.' '.$admin_err.'</td></tr>');
	}
			  
	echo	('<tr><td align="left" valign="top">
			  	  <table cellpadding="0" cellspacing="2" border="0">
				  <tr><td class="cms_form_text">Username: </td>
				  	  <td class="cms_form_box">
					  <input type="text" name="admin_name" value="'.$admin_name.'"  class="cms_login_field"></td></tr>
				  <tr><td class="cms_form_text">Password: </td>
				  	  <td class="cms_form_box">
					  <input type="password" name="password" class="cms_login_field"></td></tr>
				  <tr><td colspan="2">
				  	  <table cellpadding="0" cellspacing="0" border="0" width="100%">
					  <tr><td align="left" class="cms_form_text">
				  	  <input type="hidden" name="maa" value="do_login">
				  	  <input type="image" value="Login" src="images/login.gif" border="0" alt="Login"></td>
					  <td align="right" class="cms_form_text">
					  <a href="index.php?maa=Forgot_pwd" class="cms_login_link">
					  <img src="images/forgot_pwd.gif" border="0" alt="Forgot Password" align="right"></a>
				  	  </td></tr>
					  </table>
				  </td></tr>
				  </table>
			  </td></tr>
			  </table>
			  </form>');
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//a login function to call the login form.
function Login(){
		include("hdr.inc.php");
        login_form();
		include("ftr.inc.php");
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//this function will do the login for you.
function do_login(){
         global $prefix,$mdb,$admin_name,$password, $remember, $admin_err,$pass_err,$error_msg,$REMOTE_ADDR;


         //check admin name and password fields.
         if((!$admin_name) || (!$password)){
		 		include("hdr.inc.php");
                $reqmsg= ('<span class="cms_login_error">Required!</font>)');

                if(trim(empty($admin_name))){
                   $admin_err= $reqmsg;
                }
                if(empty($password)){
                   $pass_err= $reqmsg;
                }
                login_form();
				include("ftr.inc.php");
                exit();
         }

         //encyrpt  password for more Security
         $md5_pass = md5($password);
         $sql = mysqli_query($mdb,"SELECT * FROM ".$prefix."_admin WHERE admin_name='$admin_name' AND password='$md5_pass'");
         $login_check = mysqli_num_rows($sql);
         ///////////////////////////////////////////////////////////////////////
         if($login_check > 0){
            while($row = mysqli_fetch_array($sql)){

                 $adminid = $row['adminid'];
                 $admin_name = $row['admin_name'];
                 $password = $row['password'];
                 $ipaddress = $row['ipaddress'];

                 $lastlogin = explode(" ", $row['lastlogin']);
                 $lastlogin_date =  $lastlogin[0];
                 $lastlogin_time = $lastlogin[1];

                 $info = base64_encode("$adminid|$admin_name|$password|$ipaddress|$lastlogin_date|$lastlogin_time");

                 setcookie("admin","$info",0);

                 mysqli_query($mdb, "UPDATE ".$prefix."_admin SET ipaddress='$REMOTE_ADDR', lastlogin=NOW() WHERE adminid='$adminid'") or die (mysqli_error($mdb));

                 msg_redirect("Login success please wait..........","index.php","2");
                 //header("Location: index.php");
            }//end while
         }else{
            //include("header.php");
            $error_msg = ('<span class="cms_login_error">Login error. Please check admin name/password.</span>');
            unset($admin_name);
            unset($password);
            include("hdr.inc.php");
            login_form();
            include("ftr.inc.php");
            exit();
         }
}


################################################################################
#------------------------------------------------------------------------------#
#  logout
#------------------------------------------------------------------------------#
################################################################################
function Logout($admin) {


    unset($admin);
    unset($cookie);

    setcookie("admin", false);
    header("Location: index.php");
    
}

################################################################################
#------------------------------------------------------------------------------#
#  Forgot Password
#------------------------------------------------------------------------------#
################################################################################
function Forgot_pwd_form(){
global $error_msg;
	echo	('<form method="POST" action="'.$_SERVER['PHP_SELF'].'">
			  <table cellpadding="0" cellspacing="0" border="0">
			  <tr><td align="left" class="cms_title">PASSWORD RESET FORM:</td></tr>');
	if(isset($error_msg)){
	echo	('<tr><td align="left" class="cms_login_error">'.$error_msg.'</td></tr>');
	}
	echo	('<tr><td align="left">
			      <table cellpadding="0" cellspacing="2" border="0">
				  <tr><td align="left" class="cms_form_text">Username:</td>
				  	  <td align="left" class="cms_form_box"><input type="text" name="admin_name" class="cms_login_field"></td></tr>
				  <tr><td align="left" class="cms_form_text">Email:</td>
				  	  <td align="left" class="cms_form_box"><input type="text" name="email" class="cms_login_field"></td></tr>
				  <tr><td align="right" class="cms_form_text" colspan="2">
				  	  <input type="hidden" name="maa" value="do_Forgot_pwd">
					  <input type="image" src="images/send_pwd.gif" border="0" value="Send Password" align="right"></td></tr>
				  </table>	  
			  </td></tr>
			  </table>
			  </form>');
		  
}
function Forgot_pwd(){
         global $admin, $prefix;
		 include("hdr.inc.php");
         Forgot_pwd_form();
		 include("ftr.inc.php");
}

function new_pwd() {
    $chars = "abchefghjkmnpqrstuvwxyz0123456789";
    srand((double)microtime()*1000000);
    $i = 0;
    while ($i <= 7) {
        $num = rand() % 33;
        $pwd = substr($chars, $num, 1);
        $i++;
    }
    return $pwd;
}

function do_Forgot_pwd(){
    global $admin, $prefix, $mdb, $email, $admin_name, $error_msg, $site_name ,$site_email, $site_url;

    $result = mysqli_query($mdb,"SELECT * FROM ".$prefix."_admin WHERE admin_name='$admin_name' AND email='$email'");
    $check = mysqli_num_rows($result);
         
    if($check == 1){
        $new_pwd = new_pwd();
        $md5_password = md5($new_pwd);
        mysqli_query($mdb,"UPDATE ".$prefix."_admin SET password='$md5_password' WHERE email='$email'");
        
        $subject = "New Content Management System Password";
        $message = "
        Hello $admin_name,
        
        You are receiving this email because you have (or someone pretending to be you has) requested a new password be sent for your account on $site_name.
        
        Here it is below.
        --------------------------
        admin name: $admin_name
        Password: $new_pwd
        --------------------------
        You may login below:
        $site_url
        
        You can of course change this password yourself via the profile page. If you have any difficulties please contact the webmaster.
        
        --
        -Thanks
        $site_name
        
        This email was automatically generated.
        Please do not respond to this email or it will ignored.";
        
        mail($email,$subject,$message, "FROM: $site_name <$site_email>");
        include("hdr.inc.php");
        echo "Your New Pass has been emailed to your email.";
        echo "<br>please wait...";
        include("ftr.inc.php");

    }else{
        include("hdr.inc.php");
        Forgot_pwd_form();
        echo ('<center><span class="cms_login_error">Error: Wrong admin name/email</span></center><br>');
        include("ftr.inc.php");
        
    }
}