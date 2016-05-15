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
		  
//LOAD THE CONFIGURATION FILES FOR UPLOADING IMAGES//
$imgview = 1;////////////////////////////////////////
include("includes/img_config.inc.php");//////////////
include("includes/img.view.php");////////////////////
/////////////////////////////////////////////////////

echo	('<table cellpadding="6" cellspacing="0" border="0" width="100%">
		  <tr><td align="left" valign="top">');

if(isset($_GET["view"])){
	
	//THE FORM FOR UPDATING THE SELECTED IMAGE IN THE POTFOLIO
		$QUERY	= "SELECT * FROM site_images WHERE id='".$view."' LIMIT 1";
		$SQL	= mysqli_query($mdb, $QUERY) or die("Invalid Portfolio Image Query: " . mysqli_error($mdb));
		$i		= mysqli_fetch_array($SQL);
		
echo	('<form action="'.$_SERVER['PHP_SELF'].'" method="POST">
		  <table cellpadding="0" cellspacing="0" border="0" width="900">
		  <tr><td class="cms_title" valign="middle">EDIT IMAGE</td></tr>');		 
		
		$large   = ('../files/image/large/'.$i["img"].'');
		$medium = ('../files/image/medium/'.$i["img"].'');
		
		//GET THE DIMENSIONS OF THE BIG AND SMALL IMAGES
		$imgsize = getimagesize ($large);
		
		//GET FILE SIZE IN BYTES/KB/MB
		$file_size = filesize ($big);
		
		if($file_size >= 1048576){
			$show_filesize = number_format(($file_size / 1048576),2) . " MB";
		}elseif ($file_size >= 1024){
			$show_filesize = number_format(($file_size / 1024),2) . " KB";
		}elseif	($file_size >=0){
			$show_filesize = $file_size . "bytes";
		}else{
			$show_filesize = "0 bytes";
		}
			  
echo	('<tr><td valign="top" align="left">
		  <table cellpadding="2" cellspacing="2" border="0" width="100%">
		  <tr><td class="cms_image_name" colspan="2" align="center" valign="top">
		  	<a href="javascript:popimg(\''.$large.'\',\''.$i["img"].'\','.$imgsize[0].','.$imgsize[1].',\'black\')" class="cms_link"><img src="'.$medium.'" border="1"></a>
		  </td></tr>
		  <tr><td align="left" valign="middle" nowrap class="cms_form_text">Name:</td>
		  	  <td align="left" class="cms_form_box" width="100%"><input type="text" name="title" class="cms_input" size="30" value="'.$i['name'].'"></td></tr>
		  <tr><td align="left" valign="middle" nowrap class="cms_form_text">Category:</td>
		  	  <td align="left" class="cms_form_text">'.CategorySelect($i['cat']).'</td></tr>
		  <tr><td align="right" valign="middle" class="cms_form_text"><input type="image" name="img" src="images/save_changes.gif" border="0"></td></tr>
		  <input type="hidden" name="update" value="1">
		  <input type="hidden" name="id" value="'.$i['id'].'">
		  </form>
		  </table>
		  </td></tr>
		  </table>');

	}else{
		//IF ITEM IS TO BE UPDATED RUN THIS
		if($_POST["update"]){
			$QUERY 	= "UPDATE site_images SET name='".$_POST["title"]."', cat='".$_POST["cat"]."', type='".$_POST['type']."', ymd = NOW() WHERE id='".$_POST["id"]."'";
			$SQL 	= mysqli_query($mdb, $QUERY) or die("Invalid Update Query: " . mysqli_error($mdb));
			echo	('<span class="success">IMAGE UPDATED SUCCESSFULLY</span>');
		}
		
		if($_GET["delete"]){
			$QUERY 	= "DELETE FROM site_images WHERE id='".$_GET["delete"]."' LIMIT 1";
			$SQL 	= mysqli_query($mdb, $QUERY) or die("Invalid Delete Query: " . mysqli_error($mdb));
			echo	('<span class="success">IMAGE DELETED SUCCESSFULLY</span>');
		}
	
  echo	('
  <form method="POST" action="pictures.add.php" enctype="multipart/form-data">
  <table cellpadding="0" cellspacing="0" border="0" width="900">
  <tr><td class="cms_title" valign="middle">UPLOAD IMAGE</td></tr>
  <tr><td valign="top" align="left">
	  <table cellpadding="2" cellspacing="2" border="0" width="100%">
	  <tr><td class="cms_form_text" nowrap valign="middle">File to Upload:</td>
		  <td class="cms_form_text" align="left" width="100%"><input type="file" name="imgfile" class="cms_input" size="40"></td></tr>
	  <tr><td class="cms_form_text" nowrap valign="middle">Photo Name:</td>
	  	  <td class="cms_form_box" align="left"><input type="text" name="name" class="cms_input" size="40"></td></tr>
	  <tr><td class="cms_form_text" nowrap value="middle">Category:</td>
	  	  <td class="cms_form_text" align="left">'.CategorySelect('0').'</td></tr>
	  <tr><td></td><td align="right" valign="middle" class="cms_form_text"><input type="image" name="upload_resize" src="images/upload_resize.gif" border="0"></td></tr>
	  </table>
	  <input type="hidden" name="submit" value="1">
	  </form>
	  </td></tr>
  <tr><td class="cms_title" valign="middle">CURRENT IMAGES</td></tr>
  <tr><td valign="top" align="left">
  	  <table cellpadding="2" cellspacing="2" border="0" width="100%">');

		
		//LIST ALL OF THE IMAGES IN THE PORTFOLIO
		$SQL 	= mysqli_query($mdb, 'SELECT * FROM site_images ORDER BY ymd DESC') or die("Invalid Portfolio Query: " . mysqli_error($mdb));
		
		$tr = 1;
		$rws = mysqli_num_rows($SQL);
		
		while($p = mysqli_fetch_array($SQL)){
			if($tr == 1){
			echo	('<tr>');
			}

echo	('<td align="center" valign="top" class="cms_table_row_one" onmouseover="this.className=\'cms_table_row_hlt\';" onmouseout="this.className=\'cms_table_row_one\';">
			<table cellpadding="1" cellspacing="0" border="0" width="150">
			<tr><td align="center" valign="middle" class="cms_image_name" colspan="2"><a href="'.$_SERVER['PHP_SELF'].'?view='.$p['id'].'" class="cms_link">
				<img src="../files/image/thumb/'.$p['img'].'" border="1"></a></td></tr>
		    <tr><td align="center" valign="middle" class="cms_image_name" colspan="2"><a href="'.$_SERVER['PHP_SELF'].'?view='.$p['id'].'" class="cms_image_link">'.$p['name'].'</a></td></tr>');

		$CSQL = mysqli_query($mdb, 'SELECT * FROM category_images WHERE id="'.$p['cat'].'" LIMIT 1') or die ('Invalid Image Category Query: ' . mysqli_error($mdb));
		$c = mysqli_fetch_array($CSQL);
		echo ('<tr><td align="center" valign="middle" class="cms_cat_name" colspan="2">'.$c['name'].'</td></tr>');

echo	('		<tr><td align="left" valign="middle" class="cms_image_name"><a href="'.$_SERVER['PHP_SELF'].'?view='.$p['id'].'" class="cms_link">
				<img src="images/edit_image.gif" border="0"></a></td>
				<td align="right" valign="middle" class="cms_image_name"><a href="'.$_SERVER['PHP_SELF'].'?delete='.$p['id'].'" class="cms_link">
				<img src="images/delete_image.gif" border="0"></a></td></tr>
		</table>
		</td>');
			
			$rws = $rws - 1;
			if($rws == 0){
				if($tr == 1){
				echo	('<td>&nbsp;</td>
						  <td>&nbsp;</td></tr>');	
				}elseif($tr == 2){
				echo	('<td>&nbsp;</td></tr>');
				}elseif($tr == 3){
				echo	('</tr>');	
				}
			}else{
				if($tr == 3){
				echo	('</tr>');
				$tr = 0;
				}
			}
			$tr = $tr + 1;
			
		}
		
echo	('</table>
		  </td></tr>');
		
	}		  
echo	('</td></tr>
		  </table>');

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
?>