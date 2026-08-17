<?php

function ar_fail($message)
{
    fwrite(STDERR, $message . "\n");
    exit(1);
}

$root = dirname(__DIR__);
$englishPath = $root . '/GameEngine/Lang/en.php';
$arabicPath = $root . '/GameEngine/Lang/ar.php';
$english = file_get_contents($englishPath);
$arabic = file_get_contents($arabicPath);

if ($english === false || $arabic === false) {
    ar_fail('Could not read locale files.');
}
if (strncmp($arabic, "\xEF\xBB\xBF", 3) === 0 || !preg_match('//u', $arabic)) {
    ar_fail('Arabic locale must be BOM-free UTF-8.');
}

preg_match_all("/tz_def\\('([^']+)'/", $english, $englishMatches);
preg_match_all("/tz_def\\('([^']+)'/", $arabic, $arabicMatches);
$missing = array_diff($englishMatches[1], $arabicMatches[1]);
if ($missing) {
    ar_fail('Arabic locale is missing constants: ' . implode(', ', $missing));
}

$direct = "/tz_def\\('([^']+)',\\s*'((?:\\\\.|[^'\\\\])*)'\\);/";
preg_match_all($direct, $english, $englishStrings, PREG_SET_ORDER);
preg_match_all($direct, $arabic, $arabicStrings, PREG_SET_ORDER);
$arabicByKey = [];
foreach ($arabicStrings as $entry) {
    $arabicByKey[$entry[1]] = $entry[2];
}

foreach ($englishStrings as $entry) {
    if (!isset($arabicByKey[$entry[1]])) {
        continue;
    }
    preg_match_all('#</?[a-zA-Z][^>]*>#', $entry[2], $englishTags);
    preg_match_all('#</?[a-zA-Z][^>]*>#', $arabicByKey[$entry[1]], $arabicTags);
    if ($englishTags[0] !== $arabicTags[0]) {
        ar_fail('HTML tag sequence changed for ' . $entry[1]);
    }
}

echo 'PASS Arabic locale: ' . count($arabicMatches[1]) . " constants, UTF-8, markup preserved\n";
