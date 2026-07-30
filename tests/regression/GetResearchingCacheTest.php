<?php

if (function_exists('mysqli_query')) {
    $command = escapeshellarg(PHP_BINARY)
        . ' -d disable_functions=mysqli_query '
        . escapeshellarg(__FILE__);

    passthru($command, $status);
    exit($status);
}

if (!function_exists('mysqli_query')) {
    function mysqli_query($connection, $query)
    {
        $GLOBALS['queryCount']++;

        return $query;
    }
}

define('TB_PREFIX', 'test_');

require_once __DIR__ . '/../../GameEngine/Database/DatabaseTroopQueries.php';

final class ResearchingCacheHarness
{
    use DatabaseTroopQueries;

    public $dblink;
    public $rows = [];

    private static $researchingCache = [];

    private static function returnCachedContent(&$cache, $key)
    {
        return isset($cache[$key]) && !empty($cache[$key])
            ? $cache[$key]
            : null;
    }

    public function mysqli_fetch_all($result)
    {
        return $this->rows;
    }
}

$GLOBALS['queryCount'] = 0;

$database = new ResearchingCacheHarness();
$database->rows = [
    ['id' => 1, 'vref' => 42, 'tech' => 't2', 'timestamp' => 1234],
];

$first = $database->getResearching(42);
$second = $database->getResearching(42);

if ($first !== $database->rows || $second !== $database->rows) {
    fwrite(STDERR, "getResearching() did not return the fetched research rows.\n");
    exit(1);
}

if ($GLOBALS['queryCount'] !== 1) {
    fwrite(
        STDERR,
        "Expected one query across two cached reads; got {$GLOBALS['queryCount']}.\n"
    );
    exit(1);
}

fwrite(STDOUT, "getResearching cache regression test passed.\n");
