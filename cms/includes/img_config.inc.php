<?PHP
//PATHS TO WHERE IMAGES WILL BE STORED
$path_thumbs = "../files/image/thumb";
$path_large = "../files/image/large";
$path_medium = "../files/image/medium";

//THE NEW WIDTH OF THE RESIZED IMAGE
$img_thumb_width = 125; // IN PIXELS
$img_large_width = 800; // IN PIXELS
$img_large_height = 800; // IN PIXELS
$img_medium_width = 320; // IN PIXELS

//DO YOU WANT TO LIMIT THE EXTENSIONS OF THE FILES UPLOADED (yes OR no);
$extlimit = "yes";

//ALLOWED FILENAME EXTENSIONS
$limitedext = array(".gif",".jpg",".png",".jpeg",".bmp");

//CHECK IF FOLDERS ARE WRITABLE OR NOT
//PLEASE CHMOD THEM (777)

if(!is_writeable($path_thumbs)){
	die("Error:  The Directory: <b>($path_thumbs)</b> is NOT writeable");
}
if(!is_writeable($path_large)){
	die("Error:  The Directory: <b>($path_large)</b> is NOT writable");
}
if(!is_writeable($path_medium)){
	die("Error: The directory: <b>($path_medium)</b> is NOT writable");
}
?>