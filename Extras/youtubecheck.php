<?php
$url = "http://www.youtube.com/watch?v=WGTSR-QsxvU";

$check_link		=	@get_headers($url);

if(!is_array($check_link)) {
	return "false";
	exit(0);
}

$url_get = parse_url($url);

if($check_link[0] == 'HTTP/1.0 404 Not Found'){
	return "false";
	exit(0);
} else {
	if($url_get[host] == 'www.youtube.com') {
		$filesplit	=	explode('=',$url_get[query]);
		if(strlen($filesplit[1]) == 11) {
			//echo strlen($filesplit[1]);
			return "true";
		} else {
			return "false";
		}
	} else {
		return "false";
		exit(0);
	}
}
?>