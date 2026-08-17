<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

function fail_test($message)
{
    throw new RuntimeException($message);
}

function assert_same($expected, $actual, $message)
{
    if ($expected !== $actual) {
        fail_test(
            $message
            . "\nExpected: " . var_export($expected, true)
            . "\nActual:   " . var_export($actual, true)
        );
    }
}

function run_language_case($language)
{
    $expected = [
        'en' => [
            'tribe' => 'Romans',
            'welcome' => 'Welcome to Test Server',
        ],
        'ar' => [
            'tribe' => 'الرومان',
            'welcome' => 'مرحبًا بك في Test Server',
        ],
        'fr' => [
            'tribe' => 'Romains',
            'welcome' => 'Bienvenue sur le Test Server!',
        ],
        'it' => [
            'tribe' => 'Romani',
            'welcome' => 'Benvenuto in Test Server',
            'fallback' => ['TRIBE7', 'Egyptians'],
        ],
        'ro' => [
            'tribe' => 'Romani',
            'welcome' => 'Bine ai venit pe Test Server',
            'fallback' => ['PUBLIC_WELCOME_TO', 'Welcome to'],
        ],
        'zh' => [
            'tribe' => '罗马',
            'welcome' => '欢迎来到 Test Server',
            'fallback' => ['TRIBE7', 'Egyptians'],
        ],
    ];

    if (!isset($expected[$language])) {
        fail_test('Unknown test language: ' . $language);
    }

    define('SERVER_NAME', 'Test Server');
    define('USRNM_MIN_LENGTH', 3);
    define('PW_MIN_LENGTH', 6);
    define('COMMENCE', 0);
    define('TS_THRESHOLD', 0);
    define('CRANNY_CAPACITY', 100);
    define('SPEED', 1);

    require dirname(__DIR__) . '/GameEngine/Lang/loader.php';
    $loaded = tz_load_language($language);

    assert_same($expected[$language]['tribe'], TRIBE1, $language . ': selected constants must win');
    assert_same(
        $expected[$language]['welcome'],
        $loaded['index'][0][1] ?? null,
        $language . ': selected $lang values must survive the English fallback'
    );
    assert_same($loaded, $GLOBALS['lang'], $language . ': loader must publish the merged global array');

    if ($language === 'en') {
        assert_same('Arabic', TZ_ARABIC, 'en: Arabic selector label must be available to every locale');
        assert_same('Arabic', ADM_ARABIC, 'en: Arabic admin selector label must be available to every locale');
    }

    if ($language === 'ar') {
        $legacyQuestJsonConstants = [
            'Q3_DESC',
            'Q4_DESC',
            'Q11_DESC1',
            'Q14_DESC',
            'Q25_7_DESC1',
            'Q25_16_DESC',
        ];
        foreach ($legacyQuestJsonConstants as $questConstant) {
            json_decode('{"markup":"' . constant($questConstant) . '"}', true);
            assert_same(
                JSON_ERROR_NONE,
                json_last_error(),
                'ar: ' . $questConstant . ' must remain safe in the legacy quest JSON response'
            );
        }

        $rtlHtml = tz_rtl_html_filter('<html lang="en"><head></head><body>test</body></html>', 'gpack/travian_default/', '/Admin/admin.php');
        $rtlVersion = filemtime(dirname(__DIR__) . '/gpack/travian_default/lang/ar/rtl.css');
        assert_same(
            '<html lang="ar" dir="rtl"><head><link rel="stylesheet" href="../gpack/travian_default/lang/ar/rtl.css?v=' . $rtlVersion . '" type="text/css" /></head><body>test</body></html>',
            $rtlHtml,
            'ar: root locale attributes and a cache-safe RTL stylesheet must be injected'
        );

        $legacyTitle = tz_rtl_html_filter(
            '<html><head><title>Village overview | Village Centre | Messages | PLUS Tariffs</title></head><body></body></html>',
            'gpack/travian_default/',
            '/dorf1.php'
        );
        assert_same(
            true,
            strpos($legacyTitle, '<title>نظرة عامة على القرية | مركز القرية | الرسائل | PLUS التعريفات</title>') !== false,
            'ar: legacy page titles must not leak common English navigation labels'
        );
    }

    if (isset($expected[$language]['fallback'])) {
        [$constant, $value] = $expected[$language]['fallback'];
        assert_same($value, constant($constant), $language . ': missing constant must fall back to English');
    }

    $fixtureDirectory = __DIR__ . '/fixtures/languages';
    $fixture = tz_load_language('xx', $fixtureDirectory);
    assert_same(
        'English fallback',
        $fixture['nested']['fallback_only'] ?? null,
        $language . ': missing nested array value must fall back to English'
    );
    assert_same(
        'Localized shared',
        $fixture['nested']['shared'] ?? null,
        $language . ': localized nested array value must override English'
    );
    assert_same(
        'Localized value',
        $fixture['nested']['localized_only'] ?? null,
        $language . ': localized-only nested array value must be preserved'
    );
    assert_same(
        'English fallback',
        LANGUAGE_LOADER_FIXTURE_FALLBACK,
        $language . ': fixture constant must fall back to English'
    );
    assert_same(
        'Localized value',
        LANGUAGE_LOADER_FIXTURE_LOCALIZED,
        $language . ': fixture localized constant must win'
    );

    $invalid = tz_load_language('../xx', $fixtureDirectory);
    assert_same(
        'English shared',
        $invalid['nested']['shared'] ?? null,
        $language . ': invalid locale must use English'
    );

    echo "PASS {$language}\n";
}

if (isset($argv[1])) {
    run_language_case($argv[1]);
    exit(0);
}

$languages = ['en', 'ar', 'fr', 'it', 'ro', 'zh'];
foreach ($languages as $language) {
    $pipes = [];
    $process = proc_open(
        [PHP_BINARY, __FILE__, $language],
        [
            1 => ['pipe', 'w'],
            2 => ['pipe', 'w'],
        ],
        $pipes,
        __DIR__
    );

    if (!is_resource($process)) {
        fail_test('Unable to start test process for ' . $language);
    }

    $stdout = stream_get_contents($pipes[1]);
    $stderr = stream_get_contents($pipes[2]);
    fclose($pipes[1]);
    fclose($pipes[2]);
    $status = proc_close($process);

    if ($status !== 0) {
        fwrite(STDERR, $stderr !== '' ? $stderr : $stdout);
        exit($status);
    }

    echo $stdout;
}

echo "PASS language loader: 6 locales\n";
