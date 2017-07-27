<?php

$filePath = filter_input(INPUT_GET, "file", FILTER_SANITIZE_URL);

$data = file_get_contents($filePath);
$parts = explode("/", $filePath);
$fileName = $parts[count($parts)-1];

header("Content-type: application/json");
header("Content-Disposition:attachment;filename=$fileName");

echo $data;