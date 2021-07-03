
<?php

include_once("video_stream.php");


$filePath = $_GET['file_path'];

$stream = new VideoStream($filePath);
$stream->start();

?>

<video controls preload="auto" src="stream_videos/Big Hero 6 (2014)/Big.Hero.6.2014.720p.BluRay.x264.YIFY.mp4" width="100%"></video>
