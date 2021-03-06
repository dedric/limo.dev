<?php
include("config.inc.php");

function FixForFlash($oldtext){
$old = array('%','&#160;','-','/r','/n','&amp;','&lt;','&gt', '&');
$new = array('%25','%A0','%2D','','','%26','%3c','%3e','%26');
$newtext = str_replace($old, $new, $oldtext);
$newtext = preg_replace('/\r\n/', '',trim($newtext));
return $newtext;
}

function TypeSelect($curtype){
$ct = ('<select name="type" class="finput">');
	if($curtype == 1){
	$c1 = "selected"; $c2 = ""; $cn = "";
	}elseif($curtype == 2){
	$c2 = "selected"; $c1 = ""; $cn = "";
	}else{
	$cn = "selected"; $c1 = ""; $c2 = "";
	}
$ct .= ('<option value="0" '.$cn.'>PLEASE SELECT A TYPE</option>
		 <option value="1" '.$c1.'>Gallery Item</option>
		 <option value="2" '.$c2.'>Accessory Item</option>
		 </select>');
return $ct;
}

function CategorySelect($curcat){
    global $mdb;
	$GSQL = 'SELECT * FROM category_images ORDER by ID ASC';
	$GQUERY = mysqli_query($mdb, $GSQL) or die ("Invalid Gallery Category Query: " . mysqli_error($mdb));
	
$cc = ('<select name="cat" class="finput">');
		while($g = mysqli_fetch_array($GQUERY)){
			if($g['id'] == $curcat){
			$sc = "selected";
			}else{
			$sc = "";
			}
			$cc .= ('<option value="'.$g['id'].'" '.$sc.'>'.$g['name'].'</option>');
		}
$cc .= ('</select>');
return $cc;
}
function CatName($curcat,$curtype){
    global $mdb;
	if($curtype == 1){
		$SQL = ( "SELECT * FROM gallery_cats WHERE id='".$curcat."' LIMIT 1");
		$QUERY = mysqli_query($mdb,$SQL) or die ("Invalid Category Name Query: " . mysqli_error($mdb));
		$c = mysqli_fetch_array($QUERY);
		$cn = $c['name'];
	}elseif($curtype == 2){
		$SQL = ("SELECT * FROM access_cats WHERE id='".$curcat."' LIMIT 1");
		$QUERY = mysqli_query($mdb,$SQL) or die ("Invalid Category Name Query: " . mysqli_error($mdb));
		$c = mysqli_fetch_array($QUERY);
		$cn = $c['name'];
	}
	return $cn;
}
