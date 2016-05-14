<?
include_once($_SERVER['DOCUMENT_ROOT'].'/inc/class.phpmailer.php');
class MyMailer extends PHPMailer {
    // Set default variables for all new objects
    var $From     = "info@transfollictechnique.com";
    var $FromName = "Web Services";
    var $Host     = "mail.transfollictechnique.com";
    var $Mailer   = "smtp";                         // Alternative to IsSMTP()
    var $WordWrap = 75;
	var $SMTPAuth     = true;
    var $Username     = "web@transfollictechnique.com";
    var $Password     = "scarlet";

    // Replace the default error_handler
    function error_handler($msg) {
        print("My Site Error");
        print("Description:");
        printf("%s", $msg);
        exit;
    }

    // Create an additional function
    function do_something($something) {
        // Place your new code here
    }
}


function echo_html($id) {
	$db = mysql_connect ($GLOBALS[db_server], $GLOBALS[db_username], $GLOBALS[db_password]) or die ('I cannot connect to the database because: ' . mysql_error());
	mysql_select_db ($GLOBALS[db_db]); 
	list($folder,$file) = explode("/",$id);
	$sql = "SELECT * FROM pages WHERE pagename LIKE '$file' ORDER BY id";
	$result = mysql_query($sql,$db);
	$page = mysql_fetch_row($result);
	echo $page[2]; 
}

function truncate_string ($string, $maxlength, $extension) {
  // Set the replacement for the "string break" in the wordwrap function
   $cutmarker = "**cut_here**";
   // Checking if the given string is longer than $maxlength
  if (strlen($string) > $maxlength) {
      // Using wordwrap() to set the cutmarker
       // NOTE: wordwrap (PHP 4 >= 4.0.2, PHP 5)
       $string = wordwrap($string, $maxlength, $cutmarker);
       // Exploding the string at the cutmarker, set by wordwrap()
       $string = explode($cutmarker, $string);
       // Adding $extension to the first value of the array $string, returned by explode()
       $string = $string[0] . $extension;
   }
   // returning $string
   return $string;
}

function send_email($rec_e, $rec_n,$message,$subject) {
	// Instantiate your new class
	$mail = new MyMailer;
	
	// Now you only need to add the necessary stuff
	$mail->AddAddress($rec_e, $rec_n);
	$mail->Subject = $subject;
	$mail->Body    = $message;
	//$mail->AddAttachment("c:/temp/11-10-00.zip", "new_name.zip");  // optional name
	
	if(!$mail->Send())
	{
	   return false;
	} else {
		return true;
	}
}

?>