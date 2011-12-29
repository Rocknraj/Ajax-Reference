<?php

function grabStuff($open, $close, $page){
	$open = addslashes($open);
	$close = addslashes($close);
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $page);	
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	/*
	//include following code if $page requires authentication
	
	if($uName!=''){
		curl_setopt($ch, CURLOPT_USERPWD, "$uName:$pWord");
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
	}*/
	
	
	$content = curl_exec($ch);
	$pattern = $open.'(.*?)'.$close;
		$pattern = str_replace('/', '\/', $pattern);
	if(preg_match("/$pattern/is", $content, $matches)) {
		return $matches[0];
	} 
}





?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/test.css" rel="stylesheet" type="text/css" />

<title>Experimental Pages</title>
</head>

<body>

<div id="outer">
  <div id="main"><p>These are experimental pages testing the potential of Ajax. Also compiling the style sheet using SASS.</p>
 <ul>
  <?php

$file_list = scandir(getcwd());
foreach ($file_list as $list_item) {
	
if (($list_item != ".") && ($list_item != "..") && ($list_item != "css") && ($list_item != "js") && ($list_item != "images") && ($list_item != "flash") && ($list_item != "_notes") && ($list_item != ".git") && ($list_item != "README") && ($list_item != "testXX.html")){
	$file_type = explode(".",$list_item);
	$file_type = $file_type[1];
	
	if ($file_type == "html"){
		
		$newpage = "http://learningtodevelop.mobi/ajaxref/".$list_item;
	//$newpage = rawurlencode($newpage); //this may be needed depending on how you are building your url string ($new_page)
	
	$open = '<title>';
	$close = '</title>';
	$new_content = grabStuff($open, $close, $newpage);	
	$new_content = str_replace ($open,"",$new_content);
	$new_content = str_replace ($close,"",$new_content);
	
		
		
    	echo "<li><a href=\"".$list_item."\">".$new_content."</a><br />";
		$open = '<meta name="description" content="';
		$close = '" />';
		$new_content = grabStuff($open, $close, $newpage);	
		$new_content = str_replace ($open ,"" ,$new_content);
		$new_content = str_replace ($close ,"" ,$new_content);
		echo $new_content."</li>"; //place new content here inline
		}
	
	}
	
}

?>
 </ul>
	</div>
</div>
</body>
</html>