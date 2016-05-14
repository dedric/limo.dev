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
		  
//LOAD THE CONFIGURATION FILES FOR UPLOADING IMAGES//
$imgview = 1;////////////////////////////////////////
include("includes/img_config.inc.php");//////////////
include("includes/img.view.php");////////////////////
/////////////////////////////////////////////////////

if(isset($_POST["submit"])){
	
	ini_set("memory_limit","12M");
	
	$file_type = $_FILES['imgfile']['type'];
	$file_name = $_FILES['imgfile']['name'];
	$file_size = $_FILES['imgfile']['size'];
	$file_tmp  = $_FILES['imgfile']['tmp_name'];
	$new_name = $_POST['name'];
	
	echo	$file_type;
	echo	$file_name;
	
	//CHECK IF YOU HAVE SELECTED A FILE
	if(!is_uploaded_file($file_tmp)){
	
		$error_msg = ('<span class="error">Error:  Please select a file to upload!.</span>');
    	msg_redirect($error_msg,"pictures.edit.php","1");
    	exit();
		
	}
	
	//CHECK FILE EXTENSION
	$ext = strrchr($file_name,'.');
	$ext = strtolower($ext);
	
	if(($extlimit == "yes") && (!in_array($ext,$limitedext))){
		
		$error_msg = ('<span class="error">Error:  Unacceptable file type, please check your file type and try again.</span>');
    	msg_redirect($error_msg,"pictures.edit.php","1");
    	exit();
	}
	
	//GET THE FILE EXTENSION
	$getExt   = explode('.',$file_name);
	$file_ext = $getExt[count($getExt)-1];
	
	//CREATE A RANDOM FILE NAME
	$rand_name = md5(time());
	$rand_name = rand(0,999999999);
	
	//GET NEW WIDTH VARIABLE
	$ThumbWidth = $img_thumb_width;
	$LargeHeight = $img_large_height;
	$LargeWidth = $img_large_width;
	$MediumWidth = $img_medium_width;
	
	$thumb = "$path_thumbs/$new_name$rand_name.$file_ext";
	$large   = "$path_large/$new_name$rand_name.$file_ext";
	$medium = "$path_medium/$new_name$rand_name.$file_ext";
	
	//LETS RESIZE THE THUMBNAIL
	if($file_size){
		if($file_type == "image/pjpeg" || $file_type == "image/jpeg"){
			$new_img = imagecreatefromjpeg($file_tmp);
		}elseif($file_type == "image/x-png" || $file_type == "image/png"){
			$new_img = imagecreatefrompng($file_tmp);
		}elseif($file_type == "image/gif"){
			$new_img = imagecreatefromgif($file_tmp);
		}
		
		//LIST WIDTH AND HEIGHT AND KEEP ASPECT RATION
		list($width, $height) = getimagesize($file_tmp);
		if($width > $height){
		$imgration= $width / $height;
			if($imgration>1){
				$newwidth  = $ThumbWidth;
				$newheight = $ThumbWidth / $imgration;
			}else{
				$newwidth  = $ThumbWidth;
				$newheight = $ThumbWidth * $imgration;
			}
		}else{
		$imgration= $height / $width;
			if($imgration>1){
				$newheight  = $ThumbWidth;
				$newwidth = $ThumbWidth / $imgration;
			}else{
				$newheight  = $ThumbWidth;
				$newwidth = $ThumbWidth * $imgration;
			}
		}
			
			//FUNCTION FOR RESIZING IMAGE
			if(function_exists (imagecreatetruecolor)){
				$resized_img = imagecreatetruecolor($newwidth,$newheight);
			}else{
				die('<span class="error">Error: Please make sure you have GD Library ver 2+</span>');
			}
			imagecopyresampled($resized_img, $new_img, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
			//imagecopyresized($resized_img, $new_img, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);			
			//SAVE IMAGE
			ImageJpeg ($resized_img,"$path_thumbs/$new_name$rand_name.$file_ext", 75);
			chmod("$path_thumbs/$new_name$rand_name.$file_ext", 0777);
			ImageDestroy ($resized_img);
			ImageDestroy ($new_img);
	}
	
	//LETS RESIZE THE MEDIUM IMAGE
	if($file_size){
		if($file_type == "image/pjpeg" || $file_type == "image/jpeg"){
			$new_img = imagecreatefromjpeg($file_tmp);
		}elseif($file_type == "image/x-png" || $file_type == "image/png"){
			$new_img = imagecreatefrompng($file_tmp);
		}elseif($file_type == "image/gif"){
			$new_img = imagecreatefromgif($file_tmp);
		}
		
		//LIST WIDTH AND HEIGHT AND KEEP ASPECT RATION
		list($width, $height) = getimagesize($file_tmp);
		if($width > $height){
		$imgration= $width / $height;
			if($imgration>1){
				$newwidth  = $MediumWidth;
				$newheight = $MediumWidth / $imgration;
			}else{
				$newwidth  = $MediumWidth;
				$newheight = $MediumWidth * $imgration;
			}
		}else{
		$imgration= $height / $width;
			if($imgration>1){
				$newheight  = $MediumWidth;
				$newwidth = $MediumWidth / $imgration;
			}else{
				$newheight  = $MediumWidth;
				$newwidth = $MediumWidth * $imgration;
			}
		}
			
			//FUNCTION FOR RESIZING IMAGE
			if(function_exists (imagecreatetruecolor)){
				$resized_img = imagecreatetruecolor($newwidth,$newheight);
			}else{
				die('<span class="error">Error: Please make sure you have GD Library ver 2+</span>');
			}
			imagecopyresampled($resized_img, $new_img, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
			//imagecopyresized($resized_img, $new_img, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);			
			//SAVE IMAGE
			ImageJpeg ($resized_img,"$path_medium/$new_name$rand_name.$file_ext", 75);
			chmod("$path_medium/$new_name$rand_name.$file_ext", 0777);
			ImageDestroy ($resized_img);
			ImageDestroy ($new_img);
	}
	
	//LETS RESIZE THE LARGE IMAGE
	
	if($file_size){
		if($file_type == "image/pjpeg" || $file_type == "image/jpeg"){
			$big_img = imagecreatefromjpeg($file_tmp);
		}elseif($file_type == "image/x-png" || $file_type == "image/png"){
			$big_img = imagecreatefrompng($file_tmp);
		}elseif($file_type == "image/gif"){
			$big_img = imagecreatefromgif($file_tmp);
		}
	}
	list($width, $height) = getimagesize($file_tmp);
		if($width > $height){
		$imgration= $width / $height;
			if($imgration>1){
				$newwidth  = $LargeWidth;
				$newheight = $LargeWidth / $imgration;
			}else{
				$newwidth  = $LargeWidth;
				$newheight = $LargeWidth * $imgration;
			}
		}else{
		$imgration= $height / $width;
			if($imgration>1){
				$newheight  = $LargeHeight;
				$newwidth   = $LargeHeight / $imgration;
			}else{
				$newheight  = $LargeHeight;
				$newwidth   = $LargeHeight * $imgration;
			}
		}
	
	//FUNCTION FOR RESIZING IMAGE
			if(function_exists (imagecreatetruecolor)){
				$resized_img = imagecreatetruecolor($newwidth,$newheight);
			}else{
				die('<span class="error">Error: Please make sure you have GD Library ver 2+</span>');
			}
			imagecopyresampled($resized_img, $big_img, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
			//imagecopyresized($resized_img, $big_img, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);			
			//SAVE IMAGE
			ImageJpeg ($resized_img,"$path_large/$new_name$rand_name.$file_ext", 100);
			chmod("$path_large/$new_name$rand_name.$file_ext", 0777);
			ImageDestroy ($resized_img);
			ImageDestroy ($big_img);
	
	//LETS SHOW WHAT WE GOT AND ADD A JAVASCRIPT POPUP
	
	$thumb = "$path_thumbs/$new_name$rand_name.$file_ext";
	$large   = "$path_large/$new_name$rand_name.$file_ext";
	$medium = "$path_medium/$new_name$rand_name.$file_ext";
	
		//GET THE DIMENSIONS OF THE BIG AND SMALL IMAGES
		$imgsize = getimagesize ($big);
		
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
	
	//ADD THE IMAGE TO THE PORTFOLIO
	$QUERY = "INSERT INTO site_images (name, type, cat, ymd, img) VALUES ('".$_POST["name"]."','0','".$_POST['cat']."',NOW(),'".$new_name.$rand_name.".".$file_ext."')";
	$SQL = mysqli_query($QUERY) or die("Invalid Add to Pictures Query: " . mysqli_error());
	$l = mysqli_insert_id();
		
	$error_msg = ('<span class="error">UPLOAD SUCCESSFUL.</span>');
    msg_redirect($error_msg,"pictures.edit.php?view=".$l."","1");
    exit();
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

?>