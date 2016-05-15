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
  
function load_faq(){
    global $mdb;
    $row_count = "0";
    $SQL = mysqli_query($mdb, 'SELECT * FROM site_module_faq ORDER by id ASC') or die("Invalid FAQ List Query: " . mysqli_error($mdb));
  
    echo('<table cellpadding="0" cellspacing="2" border="0" width="900">');
  
    if(isset($msg)){
        echo $msg;
    }
  
    echo('<tr><td align="left" valign="top" class="cms_title">MANAGE FAQs:</td></tr>
	  <tr><td align="left" valign="top" class="cms_form_box">
		  <table cellpadding="2" cellspacing="0" border="0" width="100%">
		  <tr><td class="cms_table_hdr">ID</td>
			  <td class="cms_table_hdr">Question:</td>
			  <td class="cms_table_hdr">Options</td></tr>');

    while($m = mysqli_fetch_array($SQL)){
        echo ('<tr ');
        if($row_count == "0"){
           echo	('class="cms_table_row_one" onmouseover="this.className=\'cms_table_row_hlt\';" onmouseout="this.className=\'cms_table_row_one\';">');
           $row_count++;
        }else{
           echo	('class="cms_table_row_two" onmouseover="this.className = \'cms_table_row_hlt\';" onmouseout="this.className=\'cms_table_row_two\';">');
           $row_count = "0";
        }

        echo ('<td class="cms_table_cell">'.$m['id'].'</td>
              <td class="cms_table_cell">'.$m['ques'].'</td>
              <td class="cms_table_cell"> <a href="'.$_SERVER['PHP_SELF'].'?ct=edit_faq&id='.$m['id'].'" class="cms_table_cell_link">
                                         [ <img src="images/edit_link.gif" border="0" valign="middle"> Edit FAQ]</a>&nbsp;&nbsp;
                                         <a href="javascript:jsdel(\''.$_SERVER['PHP_SELF'].'?ct=do_del_faq&id='.$m[id].'\')" class="cms_table_cell_link">
                                         [ <img src="images/delete.gif" border="0" valign="middle"> Delete FAQ]</a></td></tr>
            ');
	}
	echo ('</table>
          </td></tr>
          <form method="POST" action="'.$_SERVER['PHP_SELF'].'">
          <tr><td class="cms_title">ADD FAQ:</td></tr>
          <tr><td align="left" valign="top">
          <table cellpadding="0" cellspacing="2" border="0">
          <tr><td class="cms_form_text" nowrap>Question:</td>
              <td class="cms_form_box"><input type="text" name="ques" class="cms_form_field" size="80"></td></tr>
          <tr><td class="cms_form_text" colspan="2">Answer:</td></tr>
          <tr><td class="cms_form_box" colspan="2"><textarea name="ans" class="cms_form_field" cols="110"></textarea></td></tr>
          <tr><td class="cms_form_text"></td>
              <td class="cms_form_text"><input type="image" src="images/save_changes.gif" border="0" name="i" value="1"></td></tr>
          <input type="hidden" name="ct" value="do_add_faq">
          </table>
          </td></tr>
          </table>
          </form>');
}

function do_add_faq(){
    @extract($_POST);
    global $mdb;

    $SQL = mysqli_query($mdb, 'INSERT INTO site_module_faq (ques,o_ymd,u_ymd,ans) VALUES ("'.$ques.'",NOW(),NOW(),"'.$ans.'")') or die("Invalid Add FAQ Query: " . mysqli_error($mdb));
    msg_redirect('<span class="success">FAQ ADDED!</span>',''.$_SERVER['PHP_SELF'].'','2');
}

function do_del_faq(){
    @extract($_GET);
    global $mdb;

    $SQL = mysqli_query($mdb, 'DELETE FROM site_module_faq WHERE id="'.$id.'" LIMIT 1') or die("Invalid Delete FAQ Query: " . mysqli_error($mdb));
    msg_redirect('<span class="error">FAQ DELETED!</span>',''.$_SERVER['PHP_SELF'].'','2');
}

function do_edit_faq(){
    @extract($_POST);
    global $mdb;

    $SQL = mysqli_query($mdb, 'UPDATE site_module_faq SET ques="'.$ques.'", ans="'.$ans.'", u_ymd=NOW() WHERE id="'.$id.'" LIMIT 1') or die('Invalid Update FAQ Query: ' . mysqli_error($mdb));
    msg_redirect('<span class="success">FAQ UPDATED!</span>',''.$_SERVER['PHP_SELF'].'','2');
}

function edit_faq(){
    @extract($_GET);
    global $mdb;

    $SQL = mysqli_query($mdb,'SELECT * FROM site_module_faq WHERE id="'.$id.'" LIMIT 1') or die("Invalid Edit FAQ Query: " . mysqli_error($mdb));
    $m = mysqli_fetch_array($SQL);

    echo  ('<table cellpadding="0" cellspacing="2" border="0" width="900">
            <form method="POST" action="'.$_SERVER['PHP_SELF'].'">
            <tr><td class="cms_title">EDIT FAQ:</td></tr>
            <tr><td align="left" valign="top">
            <table cellpadding="0" cellspacing="2" border="0">
            <tr><td class="cms_form_text" nowrap>Question:</td>
            <td class="cms_form_box"><input type="text" name="ques" class="cms_form_field" value="'.$m['ques'].'" size="80"></td></tr>
            <tr><td class="cms_form_text" colspan="2">Answer:</td></tr>
            <tr><td class="cms_form_box" colspan="2"><textarea name="ans" class="cms_form_field" cols="110">'.$m['ans'].'</textarea></td></tr>
            <tr><td class="cms_form_text"></td>
            <td class="cms_form_text"><input type="image" src="images/save_changes.gif" border="0" name="i" value="1"></td></tr>
            <input type="hidden" name="id" value="'.$m['id'].'">
            <input type="hidden" name="ct" value="do_edit_faq">
            </table>
            </td></tr>
            </table>
            </form>');
}

//THE FUNCTIONS SWITCHER  
switch ($ct){

    case	"edit_faq":
            edit_faq();
            break;
	   
	case 	"do_edit_faq":
	   		do_edit_faq();
			break;
			
	case 	"do_add_faq":
			do_add_faq();
			break;
	
	case	"do_del_faq":
			do_del_faq();
			break;

       Default:load_faq();
               Break;
}
  
  include("includes/ftr.inc.php");

}else{
 //UH-OH THEY ARE NOT LOGGED IN LETS GIVE THEM THE FORM
 include("includes/hdr.inc.php");
 login_form();
 include("includes/ftr.inc.php");
}
