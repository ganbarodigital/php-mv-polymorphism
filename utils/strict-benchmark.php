<?php

require __DIR__ . "/../vendor/autoload.php";
require __DIR__ . "/strict-whitespace.php";

$item = "    hello world   ";
$maxIterations = 1000000;

// raw PHP
$startTime = microtime(true);
for($i = 0; $i < $maxIterations; $i++) {
	$trimmed = trim($item);
}
$endTime = microtime(true);
$totalTime = $endTime - $startTime;
echo "[Baseline          ] Total time: " . round($totalTime, 3) . " secs" . PHP_EOL;

// call the type-aware method directly
$startTime = microtime(true);
for($i = 0; $i < $maxIterations; $i++) {
	$trimmed = TrimWhitespace::trimFromString($item);
}
$endTime = microtime(true);
$totalTime = $endTime - $startTime;
echo "[Call direct       ] Total time: " . round($totalTime, 3) . " secs" . PHP_EOL;

// polmorphic method
$startTime = microtime(true);
for($i = 0; $i < $maxIterations; $i++) {
	$trimmed = TrimWhitespace::from($item);
}
$endTime = microtime(true);
$totalTime = $endTime - $startTime;
echo "[Polymorphism      ] Total time: " . round($totalTime, 3) . " secs" . PHP_EOL;
