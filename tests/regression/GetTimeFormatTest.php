<?php

require_once __DIR__ . '/../../GameEngine/Generator.php';

$cases = [
    -61 => '0:00:00',
    -1 => '0:00:00',
    0 => '0:00:00',
    1 => '0:00:01',
    59 => '0:00:59',
    60 => '0:01:00',
    3599 => '0:59:59',
    3600 => '1:00:00',
    86399 => '23:59:59',
    86400 => '24:00:00',
    90000 => '25:00:00',
];

foreach ($cases as $seconds => $expected) {
    $actual = $generator->getTimeFormat($seconds);

    if ($actual !== $expected) {
        fwrite(
            STDERR,
            "getTimeFormat($seconds): expected $expected, got $actual.\n"
        );
        exit(1);
    }
}

fwrite(STDOUT, "getTimeFormat regression test passed.\n");
