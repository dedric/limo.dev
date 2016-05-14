<?PHP global $site_name, $site_url, $site_info, $site_email, $tmp_header; ?>
<html>
<head>
<title>Content Management System</title>
<link href="css/CMS_3.0.css" rel="stylesheet" type="text/css">
	<script type="text/javascript">
    function jsdel(url) {
        var answer = confirm("<? echo "Are you sure you want to delete?"; ?>")
         if (answer){
             window.location = ""+ url +"";
         }
    }
    </script>
</head>
<body>
<table cellpadding="0" cellspacing="0" border="0" width="100%" height="100%">
<tr><td class="cms_header">
	<table cellpadding="0" cellspacing="0" width="100%">
    <tr><td align="left" class="cms_header_text">
		<?PHP echo $site_name;?> CMS 3.0 - <a href="../" class="cms_header_link">View Website</a></td>
        
        <?PHP
		if (is_logged_in_admin($admin)) {
		
		$SQL = mysql_query('SELECT * FROM '.$prefix.'_admin WHERE adminid="'.$adminid.'" LIMIT 1') or die ("Invalid User ID: " . mysql_error());
		$a = mysql_fetch_array($SQL);
		
		echo	('<td align="right" class="cms_header_text">
				  <table cellpadding="2" cellspacing="0" border="0" align="right">
				  <tr><td align="left" class="cms_header_login" colspan="2">
				  <a href="#" class="cms_header_login_link">'.$a['fullname'].' ['.$a['admin_name'].']</a></td></tr>
				  <tr><td align="left" class="cms_header_login" colspan="2">
				  Last Logged In: '.$a['lastlogin'].'<br>from ('.$a['ipaddress'].')
				  </td></tr>
				  <tr><td align="left" class="cms_header_login">
				  	  <a href="admin.edit.php?maa=edit_admins&adminid='.$adminid.'" class="cms_header_login_link">
					  <img src="images/manage_user.gif" border="0" valign="middle"> Manage Account</a></td>
					  <td align="left" class="cms_header_login">
					  <a href="index.php?maa=Logout" class="cms_header_login_link">
					  <img src="images/logoff.gif" border="0" valign="middle"> Logout</a></td></tr>
				  </table>
				  </td>');
		}
        ?>
        </tr>
    </table>
</td></tr>
<tr><td class="cms_menu_bg">

	<!--START THE MENU-->
    <?PHP include("includes/menu.inc.php"); ?>
    <!--END THE MENU-->
    
</td></tr>
<tr><td height="100%">
	<table cellpadding="8" cellspacing="0" border="0" width="100%" height="100%">
    <tr><td width="100%" height="100%" align="left" valign="top"> 