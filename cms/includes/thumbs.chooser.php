<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Select a Thumbnail</title>
<script>
function select_item(item){
	targetitem.value = item;
	targetPreview.src = '../../files/image/thumbs/' + item;
	top.close();
	return false;
}
</script>
<link href="../css/CMS_3.0.picker.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php
   echo	('<table cellpadding="4" cellspacing="2" border="0" width="100%">');
   $dir = '../../files/image/thumbs/';
   
   //COUNT THE FILES   
   $icount = "0";
   $dirHandle = opendir($dir);
	while ($file = readdir($dirHandle)){
   		if ($file != "." && $file != ".."){
		$icount++;
		}
   	}
	closedir($dirHandle);
   	
	$count = "0";
   	// open specified directory
   	$dirHandle = opendir($dir);
   	while ($file = readdir($dirHandle)) {
   	   	if ($file != "." && $file != ".."){

			$icount = $icount - 1;
			
		   	if($count == "0"){
		   	echo	('<tr>');
		   	}
			
			echo	('<td align="center" valign="middle" class="picker_thumb_bg">
			<a href="#" onClick="return select_item(\''.$file.'\')">
			<img src="../../files/image/thumbs/'.$file.'" border="0"></a></td>');
		   
		   	if($count == "3"){
				echo	('</tr>');
				$count = "0";
		   	}elseif($count == "2"){
				if($icount == "0"){
					echo('<td></td></tr>');				
				}
			   	$count++;
		   	}elseif($count == "1"){
				if($icount == "0"){
					echo('<td></td><td></td></tr>');
				}
				$count++;
			}elseif($count == "0"){
				if($icount == "0"){
					echo('<td></td><td></td></tr>');
				}
				$count++;
			}
	   	} 

   	} 
   	closedir($dirHandle);
?>
</body>
</html>