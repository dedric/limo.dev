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
  
function load_results(){
  $row_count == "0";
  $LSQL = mysqli_query('SELECT * FROM site_module_results ORDER by u_ymd DESC') or die("Invalid Result Query: " . mysqli_error());
  
  echo('<table cellpadding="0" cellspacing="2" border="0" width="900">
	  <tr><td align="left" valign="top" class="cms_title">MANAGE BEFORE &amp; AFTER RESULTS:</td></tr>
	  <tr><td align="left" valign="top" class="cms_form_box">
		  <table cellpadding="2" cellspacing="0" border="0" width="100%">
		  <tr><td class="cms_table_hdr">ID</td>
			  <td class="cms_table_hdr">Name</td>
			  <td class="cms_table_hdr">Before Thumbnail</td>
			  <td class="cms_table_hdr">After Thumbnail</td>
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
			  <td class="cms_table_cell">'.$l['name'].'</td>
			  <td class="cms_table_cell">'.$l['b_pic'].'</td>
			  <td class="cms_table_cell">'.$l['a_pic'].'</td>
			  <td class="cms_table_cell"> <a href="results.edit.php?ct=edit_results&id='.$l['id'].'" class="cms_table_cell_link">
			  	  						 [ <img src="images/edit_link.gif" border="0" valign="middle"> Edit Result]</a>&nbsp;&nbsp;
                  						 <a href="javascript:jsdel(\'results.edit.php?ct=do_del_results&id='.$l[id].'\')" class="cms_table_cell_link">
										 [ <img src="images/delete.gif" border="0" valign="middle"> Delete Result]</a></td></tr>
			');
	}
	echo	('</table>
		      </td></tr>
			  <form method="POST" action="'.$_SERVER['PHP_SELF'].'">
			  <tr><td class="cms_title">ADD BEFORE &amp; AFTER RESULT:</td></tr>
			  <tr><td align="left" valign="top">
			  <table cellpadding="2" cellspacing="0" border="0">
			  <tr><td align="left" valign="top">
			  	  <table cellpadding="2" cellspacing="2" border="0">
				  <tr><td class="cms_form_text" nowrap>Patient Name:</td>
				  	  <td class="cms_form_box" colspan="2"><input type="text" name="name" class="cms_form_field"></td>
			      <tr><td class="cms_form_text" nowrap>Before Thumb:</td>
				  	  <td class="cms_form_box"><input type="text" class="cms_form_field" id="before" name="before" value="" width="100%"></td>
				  	  <td class="cms_form_text"><a href="#" onClick="
								   dataitem = window.open(\'includes/before.chooser.php\',\'dataitem\',\'toolbar=0,menubar=0,scrollbars=1,height=500,width=500\');
								   dataitem.targetitem = getElementById(\'before\');
								   dataitem.targetPreview = getElementById(\'beforepreview\')">
								   <img src="images/pick_thumbnail.gif" valign="middle" align="right"></a></td></tr>
				  <tr><td class="cms_form_text" nowrap>After Thumb:</td>
				  	  <td class="cms_form_box"><input type="text" class="cms_form_field" id="after" name="after" value="" width="100%"></td>
				  	  <td class="cms_form_text"><a href="#" onClick="
								   dataitem = window.open(\'includes/after.chooser.php\',\'dataitem\',\'toolbar=0,menubar=0,scrollbars=1,height=500,width=500\');
								   dataitem.targetitem = getElementById(\'after\');
								   dataitem.targetPreview = getElementById(\'afterpreview\')">
								   <img src="images/pick_thumbnail.gif" valign="middle" align="right"></a></td></tr>
				  <tr><td class="cms_form_text colspan="3">Info/Testimonial:</td></tr>
				  <tr><td class="cms_form_box" colspan="3"><textarea name="ctext" class="cms_form_field" cols="30" rows="3"></textarea></td></tr>
				  <tr><td class="cms_form_text" colspan="3"><input type="image" src="images/save_changes.gif" border="0"></td></tr>
				  <input type="hidden" name="ct" value="do_add_results">
				  </form>
				  </table>
			  </td>
			  	  <td align="left" valign="top">
					  <table cellpadding="2" cellspacing="0" border="0">
					  <tr><td class="cms_form_text">Before:</td>
					  	  <td class="cms_form_text">After:</td></tr>
					  <tr><td><img src="images/preview.gif" name="beforepreview" border="0" id="beforepreview"></td>
					  	  <td><img src="images/preview.gif" name="afterpreview" border="0" id="afterpreview"></td></tr>
					  </table>
				  </td></tr>
			  </table>
			  
			  
			  
			  </td></tr>
			  </table>
			  </form>');
}
function do_add_results(){
@extract($_POST);
$SQL = mysqli_query('INSERT INTO site_module_results (name,o_ymd,u_ymd,b_pic,a_pic,ctext) VALUES
													("'.$name.'",NOW(),NOW(),"'.$before.'","'.$after.'","'.$ctext.'")') or die("Invalid Add Result Query: " . mysqli_error());
msg_redirect('<span class="success">RESULT ADDED!</span>',''.$_SERVER['PHP_SELF'].'','2');
}

function do_del_results(){
@extract($_GET);
$SQL = mysqli_query('DELETE FROM site_module_results WHERE id="'.$id.'" LIMIT 1') or die("Invalid Delete Result Query: " . mysqli_error());
msg_redirect('<span class="error">RESULT DELETED!</span>',''.$_SERVER['PHP_SELF'].'','2');
}

function do_edit_results(){
@extract($_POST);
$SQL = mysqli_query('UPDATE site_module_results SET name="'.$name.'", ctext="'.$ctext.'", b_pic="'.$before.'", a_pic="'.$after.'", u_ymd=NOW() WHERE id="'.$id.'" LIMIT 1') or die('Invalid Update Result Query: ' . mysqli_error());
msg_redirect('<span class="success">RESULT UPDATED!</span>',''.$_SERVER['PHP_SELF'].'','2');
}

function edit_results(){
@extract($_GET);
$SQL = mysqli_query('SELECT * FROM site_module_results WHERE id="'.$id.'" LIMIT 1') or die('Invalid Edit Result Query: ' . mysqli_error());
$r = mysqli_fetch_array($SQL);
	echo('<table cellpadding="0" cellspacing="2" border="0" width="900">
		 <form method="POST" action="'.$_SERVER['PHP_SELF'].'">
			  <tr><td class="cms_title">EDIT BEFORE &amp; AFTER RESULT:</td></tr>
			  <tr><td align="left" valign="top">
			  <table cellpadding="2" cellspacing="0" border="0">
			  <tr><td align="left" valign="top">
			  	  <table cellpadding="2" cellspacing="2" border="0">
				  <tr><td class="cms_form_text" nowrap>Patient Name:</td>
				  	  <td class="cms_form_box" colspan="2"><input type="text" name="name" class="cms_form_field" value="'.$r['name'].'"></td>
			      <tr><td class="cms_form_text" nowrap>Before Thumb:</td>
				  	  <td class="cms_form_box"><input type="text" class="cms_form_field" id="before" name="before" value="'.$r['b_pic'].'" width="100%"></td>
				  	  <td class="cms_form_text"><a href="#" onClick="
								   dataitem = window.open(\'includes/before.chooser.php\',\'dataitem\',\'toolbar=0,menubar=0,scrollbars=1,height=500,width=500\');
								   dataitem.targetitem = getElementById(\'before\');
								   dataitem.targetPreview = getElementById(\'beforepreview\')">
								   <img src="images/pick_thumbnail.gif" valign="middle" align="right"></a></td></tr>
				  <tr><td class="cms_form_text" nowrap>After Thumb:</td>
				  	  <td class="cms_form_box"><input type="text" class="cms_form_field" id="after" name="after" value="'.$r['a_pic'].'" width="100%"></td>
				  	  <td class="cms_form_text"><a href="#" onClick="
								   dataitem = window.open(\'includes/after.chooser.php\',\'dataitem\',\'toolbar=0,menubar=0,scrollbars=1,height=500,width=500\');
								   dataitem.targetitem = getElementById(\'after\');
								   dataitem.targetPreview = getElementById(\'afterpreview\')">
								   <img src="images/pick_thumbnail.gif" valign="middle" align="right"></a></td></tr>
				  <tr><td class="cms_form_text colspan="3">Info/Testimonial:</td></tr>
				  <tr><td class="cms_form_box" colspan="3"><textarea name="ctext" class="cms_form_field" cols="30" rows="3">'.$r['ctext'].'</textarea></td></tr>
				  <tr><td class="cms_form_text" colspan="3"><input type="image" src="images/save_changes.gif" border="0"></td></tr>
				  <input type="hidden" name="ct" value="do_edit_results">
				  <input type="hidden" name="id" value="'.$r['id'].'">
				  </form>
				  </table>
			  </td>
			  	  <td align="left" valign="top">
					  <table cellpadding="2" cellspacing="0" border="0">
					  <tr><td class="cms_form_text">Before:</td>
					  	  <td class="cms_form_text">After:</td></tr>
					  <tr><td><img src="../files/image/thumbs/'.$r['b_pic'].'" name="beforepreview" border="0" id="beforepreview"></td>
					  	  <td><img src="../files/image/thumbs/'.$r['a_pic'].'" name="afterpreview" border="0" id="afterpreview"></td></tr>
					  </table>
				  </td></tr>
			  </table>

			  </td></tr>
			  </table>
		 ');
}

//THE FUNCTIONS SWITCHER  
switch ($ct){

    case	"edit_results":
            edit_results();
            break;
	   
	case 	"do_edit_results":
	   		do_edit_results();
			break;
			
	case 	"do_add_results":
			do_add_results();
			break;
	
	case	"do_del_results":
			do_del_results();
			break;

       Default:load_results();
               Break;
}
  
  include("includes/ftr.inc.php");

}else{
 //UH-OH THEY ARE NOT LOGGED IN LETS GIVE THEM THE FORM
 include("includes/hdr.inc.php");
 login_form();
 include("includes/ftr.inc.php");
}

?>