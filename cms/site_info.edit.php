<?php
///////MAKE SURE YOU ADD THIS ON EVERY PAGE//
include("includes/admin_funcs.inc.php");  ///
include("includes/config.inc.php");       ///
include("includes/common_funcs.inc.php"); ///
/////////////////////////////////////////////

if (is_logged_in_admin($admin)) {

		  //IF THE USER IS LOGGED IN READ THE COOKIES
          $cookie_read = explode("|", base64_decode($admin));
          $adminid = $cookie_read[0];
          
		  include("includes/hdr.inc.php");

function set_up(){
        global $mdb, $prefix;

       $sql = mysqli_query($mdb,"SELECT * FROM ".$prefix."_options") or die ("Error:". mysqli_error($mdb));
       $r = mysqli_fetch_array($sql);

          foreach( $r AS $key => $val ){
                   $$key = stripslashes( $val );
          }
  
echo	('<form method="POST" action="site_info.edit.php">
		  <table cellpadding="0" cellspaceing="2" border="0">
		  <tr><td class="cms_title">SITE INFO &amp; OPTIONS</td></tr>
		  <tr><td>
		  	  <table cellpadding="0" cellspacing="2" border="0">
			  <tr><td class="cms_form_text">Site Name:</td>
			  	  <td class="cms_form_box">
				  <input type="text" name="xsite_name" value="'.$r['site_name'].'" class="cms_login_field"></td></tr>
			  <tr><td class="cms_form_text">Site Email:</td>
			  	  <td class="cms_form_box">
				  <input type="text" name="xsite_email" value="'.$r['site_email'].'" class="cms_login_field"></td></tr>
			  <tr><td class="cms_form_text">Site URL:</td>
			  	  <td class="cms_form_box">
				  <input type="text" name="xsite_url" value="'.$r['site_url'].'" class="cms_login_field"></td></tr>
			  <tr><td class="cms_form_text">Site Description:</td>
			      <td class="cms_form_box"><textarea name="xsite_info" class="cms_login_field">'.$r['site_info'].'</textarea></td></tr>
			  <tr><td class="cms_form_text">Site Keywords:</td>
			  	  <td class="cms_form_box"><textarea name="xsite_keywords" class="cms_login_field">'.$r['site_keywords'].'</textarea></td></tr>
			  <tr><td class="cms_form_text">Language:</td>
			  	  <td class="cms_form_text">English</td></tr>
			  <tr><td class="cms_form_text" colspan="2" align="right"><input type="hidden" name="maa"  value="save">
				  <input type="image" value="'._SAVECHANGES.'" name="B1" src="images/save_changes.gif" border="0" align="right">
			  </table>
		  </td></tr>
		  <table>
		  </form>');
}


function save(){
      global  $mdb,$prefix,$xsite_name,$xsite_email,$xsite_url,$xsite_info,$xsite_keywords;
      $sql =  mysqli_query($mdb, "UPDATE ".$prefix."_options SET  site_name='$xsite_name',site_email='$xsite_email',site_url='$xsite_url',site_info='$xsite_info',site_keywords='$xsite_keywords'") or die ("Error Editing Setup: ". mysqli_error($mdb));
      
      //print success message and redirect browser
      msg_redirect("Saved!","site_info.edit.php","2");
          
}


switch($maa) {

         default:
             set_up();
             break;

         case "save":
             save();
             break;
}

include("includes/ftr.inc.php");

//////////////////////////////////
//if the admin is not logged in.
}else{
      $error_msg = "<font class=\"error\">"._ADMIN_LOGIN_ERR."</font>";
      unset($admin_name);
      unset($password);

      msg_redirect($error_msg,"index.php","1");
      exit();
}
