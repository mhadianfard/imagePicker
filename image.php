<?php
/**
 * imagePicker will serve a random image each per request.
 */

define("IMAGES_DIR", __DIR__ . "/images");

$allFileNames = scandir(IMAGES_DIR);
foreach ($allFileNames as $index => $filename) if ($filename[0] === '.') unset($allFileNames[$index]);

$pickedImage = IMAGES_DIR . "/" . $allFileNames[array_rand($allFileNames)];

header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Expires: on, 01 Jan 1970 00:00:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
$size = getimagesize($pickedImage);
$fp = fopen($pickedImage, "rb");

if ($size && $fp) {
    header("Content-type: {$size['mime']}");
    fpassthru($fp);
}


