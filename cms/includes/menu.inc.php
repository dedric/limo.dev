<script type="text/javascript" src="js/chrome.js"></script>
<table cellpadding="0" cellspacing="0" border="0" id="chromemenu">
<tr><td><img src="images/x.gif" border="0" width="14" height="30"></td>
	<td><img src="images/menu_break.gif" border="0"></td>
	<td class="cms_menu_item"><a href="index.php" class="cms_menu_link">Dashboard</a></td>
	<td><img src="images/menu_break.gif" border="0"></td>
	<td class="cms_menu_item"><a href="pages.edit.php" class="cms_menu_link" rel="dropmenu1">Pages</a></td>
	<td><img src="images/menu_break.gif" border="0"></td>
    <td class="cms_menu_item"><a href="pictures.edit.php" class="cms_menu_link" rel="dropmenu2">Media</a></td>
	<td><img src="images/menu_break.gif" border="0"></td>
   	<td class="cms_menu_item"><a href="files.edit.php" class="cms_menu_link">Files</a></td>
	<td><img src="images/menu_break.gif" border="0"></td>
	<td class="cms_menu_item"><a href="site_info.edit.php" class="cms_menu_link">Site Info</a></td>
	<td><img src="images/menu_break.gif" border="0"></td>
    <td class="cms_menu_item"><a href="admin.edit.php" class="cms_menu_link">User Administration</a></td>
	<td><img src="images/menu_break.gif" border="0"></td>
</tr> 
</table>

<div id="dropmenu1" class="dropmenudiv">
<?php
include ("config.inc.php");

$SQL = mysqli_query($mdb, 'SELECT * FROM site_pages ORDER BY id ASC') or die ('Invalid Pages Menu Query: ' . mysqli_error($mdb));

while($p = mysqli_fetch_array($SQL)){
	if($p['page'] == 1){
	echo	('<a href="pages.edit.php?id='.$p['id'].'">'.$p['hdr'].'</a>');
	}else{
	$MSQL = mysqli_query($mdb,'SELECT * FROM site_modules WHERE mod_id="'.$p['id'].'" LIMIT 1') or die(' Invalid Modules Menu Query: ' . mysqli_error($mdb));
	$m = mysqli_fetch_array($MSQL);
	echo	('<a href="'.$m['mod_file'].'">'.$p['hdr'].'</a>');
	}
}
?>
</div>

<div id="dropmenu2" class="dropmenudiv">
<a href="pictures.edit.php">Pictures</a></div>

<script type="text/javascript">
cssdropdown.startchrome("chromemenu");
</script>