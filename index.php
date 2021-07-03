<?php

include_once("header.php");
include_once("list_movies.php");


/* echo "<pre>";
 * echo get_raw_http_request();
 * echo "</pre>";
 *  */




function get_raw_http_request() {

    $request = "{$_SERVER['REQUEST_METHOD']} {$_SERVER['REQUEST_URI']} {$_SERVER['SERVER_PROTOCOL']}\r\n";

    
    foreach (getallheaders() as $name => $value) {
	$request .= "$name: $value\r\n";
    }

    $request .= "\r\n" . file_get_contents('php://input');

    return $request;
}

?>


<?php 
include_once("footer.php");
?>
