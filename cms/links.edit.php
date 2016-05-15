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
  
function load_links(){
	global $mdb;
	$row_count = "0";
	$LSQL = mysqli_query($mdb,'SELECT * FROM site_links ORDER by u_ymd DESC') or die("Invalid Links List Query: " . mysqli_error($mdb));

	echo('<table cellpadding="0" cellspacing="2" border="0" width="900">
	  <tr><td align="left" valign="top" class="cms_title">MANAGE LINKS:</td></tr>
	  <tr><td align="left" valign="top" class="cms_form_box">
		  <table cellpadding="2" cellspacing="0" border="0" width="100%">
		  <tr><td class="cms_table_hdr">ID</td>
			  <td class="cms_table_hdr">Link Name</td>
			  <td class="cms_table_hdr">Link Address</td>
			  <td class="cms_table_hdr">Thumbnail</td>
			  <td class="cms_table_hdr">Options</td></tr>');
	while($l = mysqli_fetch_array($LSQL)){
	  echo	('<tr ');
		if($row_count == "0"){
		   echo	('class="cms_table_row_one" onmouseover="this.className=\'cms_table_row_hlt\';" onmouseout="this.className=\'cms_table_row_one\';">');
		   $row_count++;
		}else{
		   echo	('class="cms_table_row_two" onmouseover="this.className = \'cms_table_row_hlt\';" onmouseout="this.className=\'cms_table_row_two\';">');
		   $row_count = "0";
		}

	  echo	('<td class="cms_table_cell">'.$l['id'].'</td>
			  <td class="cms_table_cell">'.$l['hdr'].'</td>
			  <td class="cms_table_cell">'.$l['address'].'</td>
			  <td class="cms_table_cell">'.$l['img'].'</td>
			  <td class="cms_table_cell"> <a href="link.edit.php?ct=edit_link&id='.$l['id'].'" class="cms_table_cell_link">
										 [ <img src="images/edit_link.gif" border="0" valign="middle"> Edit Link]</a>&nbsp;&nbsp;
										 <a href="javascript:jsdel(\'link.edit.php?ct=do_del_link&id='.$l[id].'\')" class="cms_table_cell_link">
										 [ <img src="images/delete.gif" border="0" valign="middle"> Delete Link]</a></td></tr>
			');
	}
	echo	('</table>
			  </td></tr>
			  <form method="POST" action="'.$_SERVER['PHP_SELF'].'">
			  <tr><td class="cms_title">ADD LINK:</td></tr>
			  <tr><td align="left" valign="top">
			  <table cellpadding="0" cellspacing="2" border="0">
			  <tr><td class="cms_form_text" nowrap>Link Name:</td>
				  <td class="cms_form_box" colspan="2"><input type="text" name="link_name" class="cms_form_field"></td>
				  <td rowspan="3" class="cms_form_text" valign="top" align="center" width="96">
				  <img src="images/preview.gif" name="preview" border="0" id="preview"></td></tr>
			  <tr><td class="cms_form_text">Address:</td>
				  <td class="cms_form_box" colspan="2"><input type="text" name="address" class="cms_form_field"></td></tr>
			  <tr><td class="cms_form_text">Thumbnail:</td>
				  <td class="cms_form_box"><input type="text" id="thumbnail" name="thumbnail" class="cms_form_field" value="" width="100%"></td>
				  <td class="cms_form_text" valign="middle" align="right">
								   <a href="#" onClick="
								   dataitem = window.open(\'includes/thumbs.chooser.php\',\'dataitem\',\'toolbar=0,menubar=0,scrollbars=1,height=500,width=500\');
								   dataitem.targetitem = getElementById(\'thumbnail\');
								   dataitem.targetPreview = getElementById(\'preview\')">
								   <img src="images/pick_thumbnail.gif" valign="middle" align="right"></a></td></tr>

			  <tr><td align="right" valign="top" colspan="4"></td></tr>
			  </table>
			  </td></tr>
			  </table>
			  </form>');
}

//THE FUNCTIONS SWITCHER  
switch ($ct){

    case	"edit_link":
            edit_link();
            break;
	   
	case 	"do_edit_link":
	   		do_edit_link();
			break;
			
	case 	"do_add_link":
			do_add_link();
			break;
	
	case	"do_del_link":
			do_del_link();
			break;

       Default:load_links();
               Break;
}
  
  include("includes/ftr.inc.php");

}else{
 //UH-OH THEY ARE NOT LOGGED IN LETS GIVE THEM THE FORM
 include("includes/hdr.inc.php");
 login_form();
 include("includes/ftr.inc.php");
}
