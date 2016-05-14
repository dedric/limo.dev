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

include ('includes/hdr.inc.php');

function load_admins(){
        global $db,$fullname,$admin_name,$password,$email,$admin_taken_err,$email_taken_err,$prefix;

$row_count = "0";
  
echo('<table cellpadding="0" cellspacing="2" border="0" width="900">
	  <tr><td align="left" valign="top" class="cms_title" colspan="2">MANAGE USERS:</td></tr>
	  <tr><td align="left" valign="top" class="cms_form_box" colspan="2">
		  <table cellpadding="2" cellspacing="0" border="0" width="100%">
		  <tr><td class="cms_table_hdr">ID</td>
			  <td class="cms_table_hdr">Full Name</td>
			  <td class="cms_table_hdr">Username</td>
			  <td class="cms_table_hdr">Email</td>
			  <td class="cms_table_hdr">Options</td></tr>');

	$result = mysqli_query("SELECT * from ".$prefix."_admin ORDER BY adminid ASC");
	while($m = mysqli_fetch_array($result)){
	  echo	('<tr ');
		if($row_count == "0"){
		   echo	('class="cms_table_row_one" onmouseover="this.className=\'cms_table_row_hlt\';" onmouseout="this.className=\'cms_table_row_one\';">');
		   $row_count++;		   
		}else{
		   echo	('class="cms_table_row_two" onmouseover="this.className = \'cms_table_row_hlt\';" onmouseout="this.className=\'cms_table_row_two\';">');
		   $row_count = "0";
		}
		
	  echo	('<td class="cms_table_cell">'.$m['adminid'].'</td>
			  <td class="cms_table_cell">'.$m['fullname'].'</td>
			  <td class="cms_table_cell">'.$m['admin_name'].'</td>
			  <td class="cms_table_cell">'.$m['email'].'</td>
			  <td class="cms_table_cell"> <a href="javascript:jsdel(\'admin.edit.php?maa=del_admins&delid='.$m[adminid].'\')" class="cms_table_cell_link">
										 [ <img src="images/delete.gif" border="0" valign="middle"> Delete User]</a></td>
			   </tr>');
	}
echo	('</table>
		  	  
	  </td></tr>
	  <form method="POST" enctype="multipart/form-data" action="admin.edit.php">
	  <tr><td class="cms_title" colspan="2">ADD USER:</td></tr>
	  <tr><td colspan="2" valign="top" align="left">
	  <table cellpadding="0" cellspacing="2" border="0">
	  <tr><td class="cms_form_text">Full Name:</td>
	  	  <td class="cms_form_box"><input type="text" name="fullname" value="'.$fullname.'" class="cms_form_field"></td></tr>
	  <tr><td class="cms_form_text">Username:</td>
	  	  <td class="cms_form_box"><input type="text" name="admin_name" value="'.$admin_name.'" class="cms_form_field"></td></tr>
	  <tr><td class="cms_form_text">Password:</td>
	  	  <td class="cms_form_box"><input type="password" name="password" value="'.$password.'" class="cms_form_field"></td></tr>
	  <tr><td class="cms_form_text">Email:</td>
	  	  <td class="cms_form_box"><input type="text" name="email" value="'.$email.'" class="cms_form_field"></td></tr>
	  <tr><td class="cms_form_error" colspan="2">'.$admin_taken_err.''.$email_taken_err.'</td></tr>
	  <tr><td  align="right" class="cms_form_text" colspan="2">
	  <input type="hidden" name="maa" value="do_add_admins">
	  <input type="image" value="Add" name="B1" src="images/add_user.gif" border="0" align="right">
	  </td></tr>
	  </table>
	  </td></tr>
	  </table>
	  </form>');
}

function do_add_admins(){
     global  $db,$prefix,$fullname,$admin_name,$password,$email,$admin_taken_err,$email_taken_err;

     if ((!$fullname) or (!$admin_name)  or (!$password)){

        echo "Error: All Feilds are required!";

     exit();
     }

    //--nothing empty? everything is okay? lets do the register.
    $email_check = $db->sql_numrows($db->sql_query("SELECT email FROM ".$prefix."_admin WHERE email='$email'"));
    $admin_check = $db->sql_numrows($db->sql_query("SELECT admin_name FROM ".$prefix."_admin WHERE admin_name='$admin_name'"));
        if(($email_check > 0) || ($admin_check > 0)){
               //define error message for usage in multi plces.
               $exist_msg= "<font class=\"error\">"._ALREADY_TAKEN."</font>";

               if($email_check > 0){
                  $email_taken_err =  $exist_msg;
                  unset($email);
               }

               if($admin_check > 0){
                  $admin_taken_err =  $exist_msg;
                  unset($admin_name);
               }

               //if the username or email already been taken load the form and print errors.
               load_admins();

               exit();
        }
    $password = md5($password);
    
    $sql =  mysqli_query("INSERT INTO ".$prefix."_admin (fullname,admin_name,password,email,regdate) VALUES ('$fullname','$admin_name','$password','$email',NOW())") or die ("Error Adding Mod: ". mysqli_error());

    msg_redirect(""._ADDED_SUCCESS."","admin.edit.php","2");
    
}

function edit_admins() {
	global $db,$prefix;

        $result = mysqli_query("SELECT * from ".$prefix."_admin WHERE adminid='".$_GET['adminid']."'");
        $m = mysqli_fetch_array($result);

echo	('<form method="POST" action="admin.edit.php" enctype="multipart/form-data">
		  <table cellpadding="0" cellspacing="2" border="0">
		  <tr><td align="left" valign="top" class="cms_title">EDIT USER:</td></tr>
		  <tr><td align="left" valign="top">
		  	  <table cellpadding="0" cellspacing="2" border="0" width="100%">
			  <tr><td class="cms_form_text">Full Name:</td>
			  	  <td class="cms_form_box">
				  <input type="text" name="fullname" value="'.$m['fullname'].'" class="cms_login_field"></td></tr>
			  <tr><td class="cms_form_text">Username:</td>
			  	  <td class="cms_form_box">
				  <input type="text" name="admin_name" value="'.$m['admin_name'].'" class="cms_login_field"></td></tr>
			  <tr><td class="cms_form_text">Password:</td>
			  	  <td class="cms_form_box">
				  <input type="password" name="password" class="cms_login_field"></td></tr>
			  <tr><td class="cms_form_text">Email:</td>
			  	  <td class="cms_form_box">
				  <input type="text" name="email" value="'.$m['email'].'" class="cms_login_field"></td></tr>
			  </table>
		  </td></tr>
		  <tr><td align="right" valign="top">
		  	  <input type="hidden" name="adminid" value="'.$m['adminid'].'">
              <input type="hidden" name="maa" value="do_edit_admins">
              <input type="image" value="Save Changes" name="B1" src="images/save_changes.gif" border="0">
		  </td></tr>
	      </table>
		  </form>');
}


function do_edit_admins(){
      global  $db,$prefix,$fullname,$admin_name,$password,$email,$adminid;

      if ($password == ""){
      $sql =  mysqli_query("UPDATE  ".$prefix."_admin SET  fullname='$fullname',admin_name='$admin_name',email='$email' where adminid='$adminid'") or die ("Error Editing admins: ". mysqli_error());
      }else{
      $password = md5($password);
      $sql =  mysqli_query("UPDATE  ".$prefix."_admin SET  fullname='$fullname',admin_name='$admin_name',password='$password',email='$email' where adminid='$adminid'") or die ("Error Editing admins: ". mysqli_error());
      }
      
      msg_redirect(""._EDITED_SUCCESS."","admin.edit.php","2");
}
function del_admins(){
      global  $db,$prefix,$adminid;

      if ($adminid == 1){
          die("You Cannot delete the Main Admin");
      }else{
       $sql =  mysqli_query("delete from  ".$prefix."_admin where adminid=".$_GET["delid"]."") or die ("Error del admins: ". mysqli_error());
      }
      msg_redirect(""._DELETED_SUCCESS."","admin.edit.php","2");
}

switch($maa) {

             default:
             load_admins();
             break;


       case "do_add_admins":
             do_add_admins();
             break;

       case "del_admins":
             del_admins();
             break;
             
       case "edit_admins":
             edit_admins();
             break;
       
      	case "do_edit_admins":
             do_edit_admins();
             break;

        case "del_admins":
             del_admins();
             break;
}

include ('includes/ftr.inc.php');

//////////////////////////////////
//if the admin is not logged in.
}else{
      $error_msg = "<font class=\"error\">"._ADMIN_LOGIN_ERR."</font>";
      unset($admin_name);
      unset($password);

      msg_redirect($error_msg,"index.php","1");
      exit();
}
