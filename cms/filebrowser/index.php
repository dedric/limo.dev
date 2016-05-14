<?php
require_once ('config.php');
?>
<html>
<head>
<script type="text/javascript" src="browse.js"></script>
<script type="text/javascript">
function jsdel(url) {
	var answer = confirm("<? echo "Are you sure you want to delete?"; ?>")
	 if (answer){
		 window.location = ""+ url +"";
	 }
}
</script>
<link rel="stylesheet" type="text/css" href="../css/CMS_3.0.css">
<style type="text/css">
    h1 {font-family: Tahoma; font-size: 110%;font-weight: bold}
    p {font-family: Tahoma}
</style>
<?php
@extract($_GET);
if(isset($kill_file)){
	unlink($file_dir);
}
?>
</head>
<body onload="browse('open','<?php echo $path?>');">
<table cellpadding="0" cellspacing="0" width="900" border="0">
<tr><td class="cms_title" id="busy">Click on a folder to browse</td>
<td id="<?=$path?>" title="open" onclick="browse(this.title,this.id);" class="cms_title" align="right"><?=$path?></td></tr>
<tr><td colspan="2">
	<table cellspacing="2" cellpadding="0" border="0" width="100%">
	<tr><td id="<?=$path?>Info" class="cms_form_box"></td></tr>
    </table>
</td></tr>
</table>
</body>
</html>