<?php
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

@extract($_POST);
@extract($_GET);

  //PRE FORM PROCESSING THIS PAGE IS STATIC SO THERE WILL JUST NEED TO BE PROCESSING AND THE FORM
  if(isset($_POST['save_form'])){
  	 //SAVE THE CHANGES
	 $SQL = mysqli_query('UPDATE site_pages SET ctext="'.$ctext1.'" WHERE id="'.$page_id.'" LIMIT 1') or die("Invalid Page Update Query: " . mysqli_error());
	 $page_msg = "Page Updated Successfully";
  }
  
  if(isset($id){
  
  //GET THE VARIABLES
  $SQL = mysqli_query('SELECT * FROM site_pages WHERE id="'.$id.'" LIMIT 1') or die("Invalid Page Text Query: " . mysqli_error());
  $p = mysqli_fetch_array($SQL);
  
  //PAGE FORM
  echo	('
  <form method="POST" action="'.$_SERVER['PHP_SELF'].'">
  <table cellpadding="0" cellspacing="0" border="0" width="900">
  <tr><td class="cms_title" valign="middle">EDIT WELCOME PAGE</td>
  <td class="cms_title"><input type="image" src="images/save_changes_blue.gif" border="0" value="1" align="right"></td></tr>');
  
  if(isset($page_msg)){
  echo	('<tr><td class="cms_msg" colspan="2">'.$page_msg.'</td></tr>');
  }
  
  echo('
  <tr><td colspan="2" valign="top" align="left">
  <table cellpadding="2" cellspacing="2" border="0" width="100%">
  <tr><td class="cms_form_text" nowrap valign="middle">Header 1:</td>
  	  <td class="cms_form_text" align="left">'.$p['hdr'].'</td></tr>
  <tr><td class="cms_form_text" nowrap valign="top">Page Content:</td>
  <td class="cms_form_box" width="100%">');
	  $oFCKeditor = new FCKeditor('ctext1');
	  $oFCKeditor->BasePath = '/cms/fckeditor/';
	  $oFCKeditor->Value = $p['ctext'];
	  $oFCKeditor->Width = '100%';
	  $oFCKeditor->Height = '400';
	  $oFCKeditor->Create();
  echo	('
  </td></tr>
  <tr><td class="cms_form_text" colspan="2" align="right">
  <input type="hidden" name="save_form" value="0">
  <input type="hidden" name="page_id" value="'.$p['id'].'">
  <input type="hidden" name="id" value="'.$id.'">
  <input type="image" src="images/save_changes.gif" border="0" value="0" align="right">
  </td></tr>
  </table>
  </td></tr>
  </table>
  </form>
  ');
  //
  
  }else{
	
	echo	('PAGES LIST GOES HERE');
	  
  }
  
  include("includes/ftr.inc.php");

}else{
 //UH-OH THEY ARE NOT LOGGED IN LETS GIVE THEM THE FORM
 include("includes/hdr.inc.php");
 login_form();
 include("includes/ftr.inc.php");
}

?>