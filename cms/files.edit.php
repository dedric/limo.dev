<?PHP
///////MAKE SURE YOU ADD THIS ON EVERY PAGE//
include("includes/admin_funcs.inc.php");  ///
include("includes/config.inc.php");       ///
include("includes/common_funcs.inc.php"); ///
include("fckeditor/fckeditor.php");       ///
/////////////////////////////////////////////

global $db, $prefix;

//CHECK TO SEE IF THE USER IS LOGGED IN
if (is_logged_in_admin($admin)) {
  
	//IF THE USER IS LOGGED IN READ THE COOKIES
	$cookie_read = explode("|", base64_decode($admin));
	//GIVE THE COOKIES SOME VARIABLE CHOCOLATE CHIPS
	$adminid = $cookie_read[0];
	$admin_name = $cookie_read[1];
	$password = $cookie_read[2];
	$ipaddress = $cookie_read[3];
	$lastlogin_date = $cookie_read[4];
	$lastlogin_time = $cookie_read[5];
  
  	include("includes/hdr.inc.php");
	
	//UPLOAD DIRECTORY MAKE SURE THE DIRECTORY IS CHMOD (777) AND THE LAST / IS IN THERE
	$upload_dir = "../files/file/"; //MAKE SURE THERE IS TRAILING /
	$size_bytes = 16168000;
	$extlimit = "yes";
	$limitedext = array(".pdf",".doc",".txt",".rtf",".docx",".xml",".exe",".msi");
	
	if (!is_dir($upload_dir)) {
		die ('<span class="error">The directory <b>('.$upload_dir.')</b> doesn\'t exist</span>');
	}
	
	if (!is_writeable($upload_dir)){
		die ('<span class="error">The directory <b>('.$upload_dir.')</b> is NOT writable, Please CHMOD (777)</span>');
	}
	
	if($uploadform){

		if (!is_uploaded_file($_FILES['filetoupload']['tmp_name'])){
			 echo	('<span class="error">Error: Please select a file to upload!.<br><a href="'.$_SERVER["PHP_SELF"].'">BACK</a></span>');
			 exit();
		}
		
		$size = $_FILES['filetoupload']['size'];
		if ($size > $size_bytes){
			$kb = $size_bytes / 1024;
			echo	('<span class="error">File too large.  File must be no larger thank '.$kb.'.<br><a href="'.$_SERVER["PHP_SELF"].'">BACK</a></span>');
			exit();
		}
		
		$ext = strrchr($_FILES['filetoupload'][name],'.');
		if (($extlimit == "yes") && (!in_array($ext,$limitedext))) {
			echo	('<span class="error">Wrong Extention Type.<br><a href="'.$_SERVER["PHP_SELF"].'">BACK</a></span>');
			exit();
		}
		
		$filename =  $_FILES['filetoupload']['name'];
		if(file_exists($upload_dir.$filename)){
			echo	('<span class="error">Oops! The file name '.$filename.' already exists.<br><a href="'.$_SERVER["PHP_SELF"].'">BACK</a></span>');
			exit();
		}
		
		if (move_uploaded_file($_FILES['filetoupload']['tmp_name'],$upload_dir.$filename)){
			chmod("$upload_dir$filename", 0777);
			echo('<span class="success">File (<a href="'.$upload_dir.$filename.'" class="cms_link">'.$filename.'</a>) Uploaded!</span>');
		}else{
			echo	('<span class="error">There was a problem moving your file.<br><a href="'.$_SERVER["PHP_SELF"].'">BACK</a></span>');
			exit();
		}
	
	}
  
	echo  ('<table cellpadding="0" cellspacing="0" border="0" width="100%" height="100%" onload="browse(\'open\','.$path.');">
			<tr><td align="left" valign="top">
				<table cellpadding="0" cellspacing="0" border="0" width="900">
				<form method="POST" enctype="multipart/form-data" action="'.$_SERVER['PHP_SELF'].'">
				<tr><td class="cms_title">UPLOAD FILE:</td></tr>
				<tr><td>
					<table cellpadding="0" cellspacing="2" border="0">
					<tr><td class="cms_fineprint" colspan="2">NO SPACES IN THE FILES NAME, NO SPECIAL CHARACTERS, JUST LETTERS AND NUMBERS.<br>ACCEPTABLE FILE FORMATS ARE
					PDF, WORD DOCUMENTS, TEXT AND RICH TEXT FILES</td></tr>
					<tr><td class="cms_form_text">File To Upload:</td>
						<td class="cms_form_box"><input type="file" name="filetoupload" class="cms_form_field" size="60"></td></tr>
					<tr><td class="cms_form_text" colspan="2" align="right">
					<input type="hidden" name="MAX_FILE_SIZE" value="'.$size_bytes.'">
					<input type="submit" name="uploadform" value="Upload, Image Coming Soon"></td></tr>
					</td></tr>
					</table>
				</td></tr>
				</form>
				</table>
			</td></tr>
			<tr><td align="left" valign="top" width="100%" height="100%">
			
			<iframe src="filebrowser/index.php" width="100%" marginwidth="5" height="100%" marginheight="5" scrolling="auto" frameborder="0"></iframe>
			
			</td></tr>
			</table>');

  	include("includes/ftr.inc.php");
		

}else{
 //UH-OH THEY ARE NOT LOGGED IN LETS GIVE THEM THE FORM
 include("includes/hdr.inc.php");
 login_form();
 include("includes/ftr.inc.php");
}

?>