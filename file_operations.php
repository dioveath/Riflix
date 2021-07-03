<?php
// $file_path : "photos/photo1.png"
function save_file($file_path, $file){
    file_put_contents($file_path, $file);
}


function load_network_file($file_url){
    return file_get_contents($file_url);
}


?>
