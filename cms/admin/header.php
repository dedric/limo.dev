<?PHP
echo "<html>\n"
     ."<head>\n"
     ."<meta http-equiv=\"content-language\" content=\"en-us\">\n"
     ."<meta name=\"generator\" content=\"microsoft frontpage 6.0\">\n"
     ."<meta name=\"progid\" content=\"frontpage.editor.document\">\n"
     ."<meta name=\"author\" content=\"Mohammed Ahmed\">\n\n"
     ."<meta http-equiv=\"content-type\" content=\"text/html; charset=windows-1256\">\n\n"
     ."<title>Admin - Users login system</title>\n";
?>
<script type="text/javascript">
function jsdel(url) {
    var answer = confirm("<? echo "Are you sure you want to delete?"; ?>")
     if (answer){
         window.location = ""+ url +"";
     }
}
</script>
<?
echo "<link rel=\"stylesheet\" href=\"../style.css\" type=\"text/css\">\n"
     ."</head>\n\n\n\n\n"
     ."<body topmargin=\"20\" leftmargin=\"20\" rightmargin=\"20\" bgcolor=\"#cfcfcf\">\n\n\n";



include("navigation.php");

?>
