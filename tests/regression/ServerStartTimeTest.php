<?php

require_once __DIR__ . '/../../src/Utils/DateTime.php';

use App\Utils\DateTime as TravianDateTime;

function fail_server_start_test($message)
{
    fwrite(STDERR, $message . "\n");
    exit(1);
}

function test_timestamp($value, DateTimeZone $timezone)
{
    return (new DateTimeImmutable($value, $timezone))->getTimestamp();
}

$lisbon = new DateTimeZone('Europe/Lisbon');
$utc = new DateTimeZone('UTC');
$kathmandu = new DateTimeZone('Asia/Kathmandu');

$decisionCases = [
    ['one second before', '20.09.2026', '12:00', '2026-09-20 11:59:59', false, $lisbon],
    ['exact start second', '20.09.2026', '12:00', '2026-09-20 12:00:00', true, $lisbon],
    ['inside start minute', '20.09.2026', '12:00', '2026-09-20 12:00:59', true, $lisbon],
    ['one second after minute', '20.09.2026', '12:00', '2026-09-20 12:01:00', true, $lisbon],
    ['earlier same day', '20.09.2026', '08:30', '2026-09-20 12:00:00', true, $lisbon],
    ['later same day', '20.09.2026', '18:30', '2026-09-20 12:00:00', false, $lisbon],
    ['previous day', '19.09.2026', '23:59', '2026-09-20 00:00:00', true, $lisbon],
    ['next day', '21.09.2026', '00:00', '2026-09-20 23:59:59', false, $lisbon],
    ['previous month', '25.08.2026', '12:00', '2026-09-20 12:00:00', true, $lisbon],
    ['next month', '02.10.2026', '12:00', '2026-09-20 12:00:00', false, $lisbon],
    ['previous year', '31.12.2025', '23:59', '2026-01-01 00:00:00', true, $lisbon],
    ['next year', '01.01.2027', '00:00', '2026-12-31 23:59:59', false, $lisbon],
    ['valid leap day exact', '29.02.2024', '00:00', '2024-02-29 00:00:00', true, $utc],
    ['UTC boundary', '01.01.1970', '00:00', '1970-01-01 00:00:00', true, $utc],
    ['positive offset before', '01.01.2026', '00:00', '2025-12-31 23:59:59', false, $kathmandu],
    ['positive offset exact', '01.01.2026', '00:00', '2026-01-01 00:00:00', true, $kathmandu],
];

foreach ($decisionCases as [$label, $date, $time, $now, $expected, $timezone]) {
    $actual = TravianDateTime::hasServerStarted(
        $date,
        $time,
        test_timestamp($now, $timezone),
        $timezone
    );

    if ($actual !== $expected) {
        fail_server_start_test(
            $label . ': expected ' . var_export($expected, true)
            . ', got ' . var_export($actual, true)
        );
    }
}

$validParseCases = [
    ['epoch', '01.01.1970', '00:00', $utc, 0],
    [
        'leap day',
        '29.02.2024',
        '23:59',
        $utc,
        test_timestamp('2024-02-29 23:59:00', $utc),
    ],
    [
        'leap century',
        '29.02.2000',
        '12:00',
        $utc,
        test_timestamp('2000-02-29 12:00:00', $utc),
    ],
    [
        'last minute of year',
        '31.12.2026',
        '23:59',
        $lisbon,
        test_timestamp('2026-12-31 23:59:00', $lisbon),
    ],
    [
        'surrounding whitespace',
        ' 20.09.2026 ',
        ' 12:00 ',
        $lisbon,
        test_timestamp('2026-09-20 12:00:00', $lisbon),
    ],
    [
        'non-hour timezone',
        '01.01.2026',
        '00:00',
        $kathmandu,
        test_timestamp('2026-01-01 00:00:00', $kathmandu),
    ],
    [
        'DST repeated local time',
        '25.10.2026',
        '01:30',
        $lisbon,
        test_timestamp('2026-10-25T01:30:00+00:00', $utc),
    ],
];

foreach ($validParseCases as [$label, $date, $time, $timezone, $expected]) {
    $actual = TravianDateTime::getServerStartTimestamp($date, $time, $timezone);
    if ($actual !== $expected) {
        fail_server_start_test(
            $label . ': expected timestamp ' . $expected . ', got ' . var_export($actual, true)
        );
    }
}

// Exercise every possible H:i value accepted by the configuration format.
for ($hour = 0; $hour < 24; $hour++) {
    for ($minute = 0; $minute < 60; $minute++) {
        $time = sprintf('%02d:%02d', $hour, $minute);
        $expected = test_timestamp('2026-06-15 ' . $time . ':00', $utc);
        $actual = TravianDateTime::getServerStartTimestamp('15.06.2026', $time, $utc);

        if ($actual !== $expected) {
            fail_server_start_test(
                'clock sweep ' . $time . ': expected timestamp ' . $expected
                . ', got ' . var_export($actual, true)
            );
        }
    }
}

// Exercise every calendar day across a common year and a leap year. Each
// parsed timestamp is checked immediately before, at, and after the boundary.
$day = new DateTimeImmutable('2023-01-01 12:34:00', $utc);
$lastDay = new DateTimeImmutable('2024-12-31 12:34:00', $utc);
while ($day <= $lastDay) {
    $date = $day->format('d.m.Y');
    $expected = $day->getTimestamp();
    $actual = TravianDateTime::getServerStartTimestamp($date, '12:34', $utc);

    if ($actual !== $expected) {
        fail_server_start_test(
            'calendar sweep ' . $date . ': expected timestamp ' . $expected
            . ', got ' . var_export($actual, true)
        );
    }

    if (TravianDateTime::hasServerStarted($date, '12:34', $expected - 1, $utc)) {
        fail_server_start_test('calendar sweep ' . $date . ': started one second early');
    }
    if (!TravianDateTime::hasServerStarted($date, '12:34', $expected, $utc)) {
        fail_server_start_test('calendar sweep ' . $date . ': not started at exact boundary');
    }
    if (!TravianDateTime::hasServerStarted($date, '12:34', $expected + 1, $utc)) {
        fail_server_start_test('calendar sweep ' . $date . ': not started after boundary');
    }

    $day = $day->modify('+1 day');
}

$invalidParseCases = [
    ['blank date', '', '12:00', $utc],
    ['blank time', '20.09.2026', '', $utc],
    ['wrong separator', '20-09-2026', '12:00', $utc],
    ['un-padded date', '20.9.2026', '12:00', $utc],
    ['two-digit year', '20.09.26', '12:00', $utc],
    ['zero day', '00.09.2026', '12:00', $utc],
    ['day too large', '32.09.2026', '12:00', $utc],
    ['zero month', '20.00.2026', '12:00', $utc],
    ['month too large', '20.13.2026', '12:00', $utc],
    ['invalid month length', '31.04.2026', '12:00', $utc],
    ['invalid non-leap day', '29.02.2025', '12:00', $utc],
    ['invalid non-leap century', '29.02.2100', '12:00', $utc],
    ['un-padded time', '20.09.2026', '9:00', $utc],
    ['wrong time separator', '20.09.2026', '09.00', $utc],
    ['hour too large', '20.09.2026', '24:00', $utc],
    ['minute too large', '20.09.2026', '23:60', $utc],
    ['unexpected seconds', '20.09.2026', '12:00:00', $utc],
    ['non-numeric time', '20.09.2026', 'noon', $utc],
    ['NUL byte in date', "20.\0.09.2026", '12:00', $utc],
    ['NUL byte in time', '20.09.2026', "12:\000", $utc],
    ['DST skipped local time', '29.03.2026', '01:30', $lisbon],
];

foreach ($invalidParseCases as [$label, $date, $time, $timezone]) {
    $actual = TravianDateTime::getServerStartTimestamp($date, $time, $timezone);
    if ($actual !== null) {
        fail_server_start_test(
            $label . ': expected invalid configuration, got timestamp ' . $actual
        );
    }

    if (TravianDateTime::hasServerStarted($date, $time, PHP_INT_MAX, $timezone)) {
        fail_server_start_test($label . ': invalid configuration must fail closed');
    }
}

// Verify that omitting the timezone uses PHP's configured server timezone at
// the exact decision boundary, rather than silently falling back to UTC.
$originalTimezone = date_default_timezone_get();
date_default_timezone_set('Asia/Kathmandu');
try {
    $defaultTimezoneStart = test_timestamp('2026-01-01 00:00:00', $kathmandu);
    if (TravianDateTime::hasServerStarted('01.01.2026', '00:00', $defaultTimezoneStart - 1)) {
        fail_server_start_test('default timezone: started one second early');
    }
    if (!TravianDateTime::hasServerStarted('01.01.2026', '00:00', $defaultTimezoneStart)) {
        fail_server_start_test('default timezone: not started at exact boundary');
    }
} finally {
    date_default_timezone_set($originalTimezone);
}

fwrite(STDOUT, "Server start time regression tests passed.\n");
