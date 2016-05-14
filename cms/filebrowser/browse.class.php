<?php
class Browse {
	var $folder = '.';
	var $file;
	var $files = array();
	var $handle;
	var $ext;
	var $invalid_files;

	public function BrowseAJAX($inputValue, $fieldID)	{
		return $this->dirList($fieldID, $inputValue);
	}
	//separate each folder with spaces or hyphens
	public function hyphens($dir) {
		$hyphens_amount = array();
		$count = explode('/',$dir);
		foreach ($count as $each) { 
			$hyphens_amount[] = '&nbsp;&nbsp;&nbsp;'; 
		} 
		return implode($hyphens_amount);
	}
	//check extension
	public function valid_extension($filename) {
		$this->ext = substr (strrchr ($filename, "."), 1);
		return array_search ($this->ext, $this->invalid_files);
	}
	//get mime type
	public function get_mime_type($filename) {
		if (!function_exists ('mime_content_type')) {
			function mime_content_type ( $f ) {
				return exec ( trim( 'file -bi ' . escapeshellarg ( $f ) ) ) ;
			}
		}
		$type = mime_content_type($filename);
		return $type;
	}
	//format file size
	public function file_size($file) {
		$size = filesize($file);
		if (strlen($size) <= 9 && strlen($size) >= 7) {
			$size = number_format($size / 1048576,1);
			return ''.$size.'MB';
		} elseif (strlen($size) >= 10) {
			$size = number_format($size / 1073741824,1);
			return ''.$size.'GB';
		} else {
			$size = number_format($size / 1024,1);
			return ''.$size.'KB';
		}
	}
	function htmlspecialchars_decode($text) {
		return strtr($text, array_flip(get_html_translation_table(HTML_SPECIALCHARS)));
	}
	//List all in directory
	private function dirList($folder,$state) {
		$temp = '';

		if ($this->handle = opendir($folder)) {
			while (false !== ($this->file = readdir($this->handle))) {
				array_push($this->files,$this->file);
			}
			foreach ($this->files as $i) {
				
				$dir = $folder.$i;
				if (is_dir($dir) && $i!='.' && $i!='..') {
					$temp .= '
					<b><span id="'.$dir.'/" title="open" onclick=\'browse(this.title, this.id);document.getElementById("'.$dir.'/Info").innerHTML = "";\' />
					'.$this->hyphens($dir).'
					<img border="0" id="image'.$dir.'/" src="images/folder.gif">
					<a href="javascript:void(0)" class="cms_files_folder">'.$i.'</a>
					</span>	
					</b><br>
					<span id="'.$dir.'/Info" class=""></span>
					';
				}
				elseif ($i=='.' || $i=='..' || $this->valid_extension($i)) {}
				else {
					$myExt =  substr (strrchr ($i, "."), 1);
					$temp .= '
						
						<span name="'.$i.'">
						'.$this->hyphens($dir).'
						<img border="0" src="images/'.$myExt.'.gif">
						<a href="'.$dir.'" class="cms_files_file" target="_blank">'.$i.'</a>
						<span id="stat'.$dir.'" class="show" name='.$i.'" />
						&nbsp;&nbsp;&nbsp;Date modified- '.date ("jS M 'y H:i:s", filemtime($dir)).'
						&nbsp;&nbsp;&nbsp;Size- '.$this->file_size($dir).'</span>
						<a href="javascript:jsdel(\'index.php?file_dir='.$dir.'&file_name='.$i.'&kill_file=1\')">
						<img src="../images/delete.gif" border="0"></a>
						</span><br>
					';
				}
			}
			closedir($this->handle);
		}
		return htmlentities($temp);
	}


}
?>