<?php
///////MAKE SURE YOU ADD THIS ON EVERY PAGE//
include("includes/admin_funcs.inc.php");  ///
include("includes/config.inc.php");       ///
include("includes/common_funcs.inc.php"); ///
/////////////////////////////////////////////

function index($admin) {

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
          //LETS INCLUDES THE DASHBOARD
		  
		  echo	('<table cellpadding="0" cellspacing="0" border="0" align="center" width="100%"  height="100%" class="cms_dashboard">
		  		  <tr>');
		  //	  <td align="center"><a href="pages.edit.php"><img src="images/dashboard_pages_icon.jpg" border="0"></a></td>
		  echo	('
				  	  <td align="center"><a href="media.edit.php"><img src="images/dashboard_media_icon.jpg" border="0"></a></td>
					  <td align="center"><a href="files.edit.php"><img src="images/dashboard_files_icon.jpg" border="0"></a></td>
					  
					  <td align="center"><a href="site_info.edit.php"><img src="images/dashboard_siteinfo_icon.jpg" border="0"></a></td>
					  <td align="center"><a href="admin.edit.php"><img src="images/dashboard_users_icon.jpg" border="0"></a></td></tr>
				  <tr>');
		  
			     /*		   <td class="dashboard_pages" valign="top" width="16%" height="100%">
				  	       <table cellpadding="6" cellspacing="0" border="0" width="100%">
						   <tr><td class="cms_dashboard_title">Pages</td></tr>
						   <tr><td class="cms_dashboard_text">
						   In pages you will be able to edit the bulk textual content of your site.  Depending on your site
						   you might even be able to edit everything just from here.  Pages include both dynamic text and
						   dynamic content such as product listings, job listings, etc.
						   </td></tr>
						   <tr><td class="cms_dashboard_text" align="right">
						   <a href="pages.edit.php" class="cms_dashboard_link">Goto Pages...</a></td></tr>
						   </table>
				  	  </td>*/
					  
		  echo	('
				  	  <td class="dashboard_media" valign="top" width="16%" height="100%">
					  	   <table cellpadding="6" cellspacing="0" border="0" width="100%">
						   <tr><td class="cms_dashboard_title">Media</td></tr>
						   <tr><td class="cms_dashboard_text">
						   Media allows you to upload, organize, publish and delete Images, Galleries, and more.
						   If you site employs multiple galliers you can maintain them all from this section.			   
						   </td></tr>
						   <tr><td class="cms_dashboard_text" align="right">
						   <a href="pictures.edit.php" class="cms_dashboard_link">Goto Media...</a></td></tr>
						   </table>
					  </td>
					  <td class="dashboard_files" valign="top" width="17%">
					  	   <table cellpadding="6" cellspacing="0" border="0" width="100%">
						   <tr><td class="cms_dashboard_title">Files</td></tr>
						   <tr><td class="cms_dashboard_text">
						   Sometimes you need to make a file available for your viewers.  PDFs and Word documents are used 
						   everywhere and will allow you to communicate with your viewers when they\'re offline.  From here
						   you can upload, organize, publish and delete all types of files.
						   </td></tr>
						   <tr><td class="cms_dashboard_text" align="right">
						   <a href="files.edit.php" class="cms_dashboard_link">Goto Files...</a></td></tr>
						   </table>
					  </td>
					  
					  <td class="dashboard_siteinfo" valign="top" width="17%">
					  	   <table cellpadding="6" cellspacing="0" border="0" width="100%">
						   <tr><td class="cms_dashboard_title">Site Info</td></tr>
						   <tr><td class="cms_dashboard_text">
						   This is where you manage your site\'s most basic data.  From here you can change your site name,
						   manage your keywords for search engines, and add some meta tags.  
						   </td></tr>
						   <tr><td class="cms_dashboard_text" align="right">
						   <a href="site_info.edit.php" class="cms_dashboard_link">Goto Site Info...</a></td></tr>
						   </table>
					  </td>
					  <td class="dashboard_users" valign="top" width="17%">
					  	   <table cellpadding="6" cellspacing="0" border="0" width="100%">
						   <tr><td class="cms_dashboard_title">User Management</td></tr>
						   <tr><td class="cms_dashboard_text">
						   The people who edit your site from this backend are Users, you can add them, delete them or 
						   change your own information.
						   </td></tr>
						   <tr><td class="cms_dashboard_text" align="right">
						   <a href="admin.edit.php" class="cms_dashboard_link">Goto User Management...</a></td></tr>
						   </table>
					  </td></tr>
		  		  </table>');
		  
		  include("includes/ftr.inc.php");			
     }else{
         //UH-OH THEY ARE NOT LOGGED IN LETS GIVE THEM THE FORM
		 include("includes/hdr.inc.php");
         login_form();
		 include("includes/ftr.inc.php");
    }
}

################################################################################
#------------------------------------------------------------------------------#
#  a switch  for switching between functions
#------------------------------------------------------------------------------#
################################################################################
switch ($maa){

       case "Forgot_pwd":
            Forgot_pwd();
            break;

       case "do_Forgot_pwd":
            do_Forgot_pwd();
            break;
            
       case "Register":
            Register();
            break;

       case "do_Register":
            do_Register();
            break;
            
       case "Logout":
            Logout($admin);
            break;
            
       case "Login":
            Login();
            break;

       case "do_login":
            do_login();
            break;

       Default:
               index($admin);
               Break;
}
