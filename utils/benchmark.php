<?php

use GanbaroDigital\HttpStatus\StatusValues\RuntimeError\UnexpectedErrorStatus;
use GanbaroDigital\HttpStatus\StatusValues\HttpStatusObject;
use GanbaroDigital\Polymorphism\V1\DispatchTables\AllPurposeDispatchTable;
use GanbaroDigital\Polymorphism\V1\DispatchTables\ObjectsOnlyDispatchTable;
use GanbaroDigital\Polymorphism\V1\DispatchTables\TypeOnlyDispatchTable;
use GanbaroDigital\Polymorphism\V1\TypeMapping\MapDuckTypeToMethodName;
use GanbaroDigital\Polymorphism\V1\TypeMapping\MapStrictTypeToMethodName;

require __DIR__ . "/../vendor/autoload.php";

$maxIterations = 1000000;
$item = new UnexpectedErrorStatus;
$dispatchTable = [
    HttpStatusObject::class => "foo",
    get_class($item) => "bar"
];

// this is our baseline
$startTime = microtime(true);
for ($i = 0; $i < $maxIterations; $i++) {
    $method = "foo";
}
$endTime = microtime(true);
$totalTime = round($endTime - $startTime, 3);

echo "[Baseline          ] Total time: " . $totalTime . PHP_EOL;

// this is about as quick as we can make it
$startTime = microtime(true);
for ($i = 0; $i < $maxIterations; $i++) {
    $method = $dispatchTable[HttpStatusObject::class];
}
$endTime = microtime(true);
$totalTime = round($endTime - $startTime, 3);

echo "[Manual look-up    ] Total time: " . $totalTime . PHP_EOL;

// this shows the overhead of calling get_class() even once
$startTime = microtime(true);
for ($i = 0; $i < $maxIterations; $i++) {
    $type = get_class($item);
    $method = $dispatchTable[$type];
}
$endTime = microtime(true);
$totalTime = round($endTime - $startTime, 3);

echo "[get_class()       ] Total time: " . $totalTime . PHP_EOL;

// our very best case - hand-crafted cache
$resultCache = [];
$startTime = microtime(true);
for ($i = 0; $i < $maxIterations; $i++) {
    $type = get_class($item);
    if (isset($resultCache[$type]) === false) {
        $resultCache[$type] = MapStrictTypeToMethodName::using($item, $dispatchTable);
    }
    $method = $resultCache[$type];
}
$endTime = microtime(true);
$totalTime = round($endTime - $startTime, 3);

echo "[Manual cache      ] Total time: " . $totalTime . PHP_EOL;

// our 2nd best case - hand-crafted cache that supports everything
$resultCache = [];
$startTime = microtime(true);
for ($i = 0; $i < $maxIterations; $i++) {
    if (is_object($item)) {
        $type = get_class($item);
        if (isset($resultCache[$type]) === false) {
            $resultCache[$type] = MapStrictTypeToMethodName::using($item, $dispatchTable);
        }
        $method = $resultCache[$type];
    }
    else {
        $method = MapStrictTypeToMethodName::using($item, $dispatchTable);
    }
}
$endTime = microtime(true);
$totalTime = round($endTime - $startTime, 3);

echo "[Manual cache 2    ] Total time: " . $totalTime . PHP_EOL;

// let's compare that with our object-driven caching dispatch table
$startTime = microtime(true);
$cachingTable = new ObjectsOnlyDispatchTable($dispatchTable, new MapStrictTypeToMethodName);
for ($i = 0; $i < $maxIterations; $i++) {
    $method = $cachingTable->mapTypeToMethodName($item);
}
$endTime = microtime(true);
$totalTime = round($endTime - $startTime, 3);
echo "[Objects only      ] Total time: " . $totalTime . PHP_EOL;

// let's compare that with our type-driven caching dispatch table
$startTime = microtime(true);
$cachingTable = new TypeOnlyDispatchTable($dispatchTable, new MapStrictTypeToMethodName);
for ($i = 0; $i < $maxIterations; $i++) {
    $method = $cachingTable->mapTypeToMethodName($item);
}
$endTime = microtime(true);
$totalTime = round($endTime - $startTime, 3);
echo "[Type only         ] Total time: " . $totalTime . PHP_EOL;

// let's compare that with our caching dispatch table
$startTime = microtime(true);
$cachingTable = new AllPurposeDispatchTable($dispatchTable, new MapStrictTypeToMethodName);
for ($i = 0; $i < $maxIterations; $i++) {
    $method = $cachingTable->mapTypeToMethodName($item);
}
$endTime = microtime(true);
$totalTime = round($endTime - $startTime, 3);

echo "[All Purpose       ] Total time: " . $totalTime . PHP_EOL;

// finally, not using a caching dispatch table at all
$startTime = microtime(true);
for ($i = 0; $i < $maxIterations; $i++) {
    $method = MapStrictTypeToMethodName::using($item, $dispatchTable);
}
$endTime = microtime(true);
$totalTime = round($endTime - $startTime, 3);

echo "[No cache          ] Total time: " . $totalTime . PHP_EOL;
