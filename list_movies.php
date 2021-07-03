<?php

include_once("movie_manager.php");

$riflix_folder = "stream_videos";
$riflix_movies = array();
$DEBUG = true;

if(!$DEBUG){
    error_reporting(0);
}


$riflix_movies = get_movies_from_folder($riflix_folder);

function get_movies_from_folder($folder_path){
    $dir = $folder_path;
    $dir_array = scandir($dir);
    $movies = array();

    foreach($dir_array as $key => $value){
	if(in_array($value, array('.', '..'))) continue;

	$c_dir = $dir . '/' . $value;
	$movie_path = null;
	$thumbnail_path = null;
	$desc_path = null;
	if(is_dir($c_dir)) {
	    $smdir = scandir($c_dir);
	    foreach($smdir as $k => $v){
		if(in_array($v, array('.', '..'))) continue;
		$file_ext = substr($v, strrpos($v, '.'));
		if($file_ext == ".mp4")
		    $movie_path = $c_dir . '/'. $v;
		if($file_ext == ".txt")
		    $desc_path = $c_dir . '/'. $v;
		if($file_ext == ".png")
		    $thumbnail_path = $c_dir . '/' . $v;
	    }
	    $summary = isset($desc_path) ? file_get_contents($desc_path) : "Excellent Movie it is!";
	    $movie_name = get_movie_name_from_folder($value);
	    $thumbnail_path = get_movie_poster($value);
	    array_push($movies, ["movie_path" => $movie_path,
				 "movie_name" => $movie_name,
				 "summary" => substr($summary, 0, 40), 
				 "thumbnail_path" => $thumbnail_path]);
	}
    }

    return $movies;
}


function set_movies($movies)
{?>
    <div class="grid-container">
	<?php foreach($movies as $movie): ?>
	    <a class="grid-area" href="video_show.php?file_path=<?=$movie['movie_path']?>" method="POST">
		<input type="hidden" name="sub_eng" value="<?=isset($movie['sub_path']) ? $movie['sub_path'] : ''?>"/>
		<div class="thumbnail">
		    <img src="<?=$movie['thumbnail_path']?>" width="195" height="288"/>
		</div>
		<div class="mov-title" >
		    <h5> <?=$movie['movie_name']?> </h5>
		</div>
		<div class="mov-summary"> 
		    <p> <?=$movie['summary']?> </p>
		</div>
	    </a>
	<?php endforeach; ?>
    </div>
<?php
}
?>



<h1> Riflix </h1>
<?php
set_movies($riflix_movies);
?>


