<?php
// error_reporting(E_ALL);
//
// require_once('firephp/lib/FirePHPCore/fb.php');
// ob_start();

// ffmpeg command. currently converts mp3 to oggvorbis
$ffmpeg_cmd = "ffmpeg -i - -acodec libvorbis -f ogg -";

// Set headers for ogg binary data
header("Accept-Ranges: bytes");
header("Content-Type: application/ogg");
header("Content-Transfer-Encoding: binary");


//set param defaults
$vals = array(
    "tl" => "en",
    "ie" => "utf-8",
    "q"  => "Hello world",
);

if (isset($_GET["tl"]))
    $vals["tl"] = $_GET["tl"];

if (isset($_GET["ie"]))
    $vals["ie"] = $_GET["ie"];

if (isset($_GET["q"]))
    $vals["q"] = $_GET["q"];

// Get mp3 data from Google TTS
//$qs = http_build_query(array("ie" => "utf-8","tl" => $_GET["tl"], "q" => $_GET["q"]));
$qs = http_build_query($vals);
// $qs = http_build_query(array("tl" => "en", "q" => $_GET["q"]));
//$qs = http_build_query(array("q" => $_GET["q"]));
// fb("http://translate.google.com/translate_tts?".$qs);


$ctx = stream_context_create(array("http"=>array("method"=>"GET","header"=>"Referer: \r\n")));

// $soundfile = file_get_contents("http://translate.google.com/translate_tts?tl=en&q=Hello%20World", false, $ctx);
$soundfile = file_get_contents("http://translate.google.com/translate_tts?".$qs, false, $ctx);

$descriptorspec = array(
    0 => array("pipe", "r"), // stdin is a pipe that the child will read from
    1 => array("pipe", "w"), // stdout is a pipe that the child will write to
    2 => array("file", "/tmp/error-output.txt", "a") // stderr is a file to write to
);

$process = proc_open($ffmpeg_cmd, $descriptorspec, $pipes);

if (is_resource($process)) {
// $pipes now looks like this:
// 0 => writeable handle connected to child stdin
// 1 => readable handle connected to child stdout
// Any error output will be appended to /tmp/error-output.txt

    fwrite($pipes[0], $soundfile);
    fclose($pipes[0]);

    $oggOutput = stream_get_contents($pipes[1]);
    fclose($pipes[1]);

// It is important that you close any pipes before calling
// proc_close in order to avoid a deadlock
    $return_value = proc_close($process);

    echo $oggOutput;
}
?>