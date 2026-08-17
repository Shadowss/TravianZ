<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

function fail_rtl_layout_test($message)
{
    throw new RuntimeException($message);
}

$rtlPath = dirname(__DIR__) . '/gpack/travian_default/lang/ar/rtl.css';
$rtlCss = file_get_contents($rtlPath);

if ($rtlCss === false) {
    fail_rtl_layout_test('Arabic RTL stylesheet must be readable');
}

if (!preg_match(
    '/html\[dir="rtl"\]\s+#header\s*,\s*html\[dir="rtl"\]\s+#mtop\s*,\s*html\[dir="rtl"\]\s+#res\s*,\s*html\[dir="rtl"\]\s+#resWrap\s*\{[^}]*direction\s*:\s*ltr\s*;/s',
    $rtlCss
)) {
    fail_rtl_layout_test(
        'Arabic layout must keep the legacy header, navigation, and resource wrappers in LTR coordinate flow'
    );
}

echo "PASS Arabic RTL structural layout contract\n";

foreach ([
    'html[dir="rtl"] body.indexPage #content {',
    'html[dir="rtl"] body.indexPage #content .grit {',
    'html[dir="rtl"] body.indexPage .grit .infobox,',
    'html[dir="rtl"] body.indexPage .grit .secondarybox',
] as $landingRule) {
    if (strpos($rtlCss, $landingRule) === false) {
        fail_rtl_layout_test('Arabic landing page must include the scoped RTL rule: ' . $landingRule);
    }
}

if (!preg_match(
    '/html\[dir="rtl"\]\s+body\.indexPage\s+#content\s*\{[^}]*float\s*:\s*none\s*;[^}]*width\s*:\s*auto\s*;/s',
    $rtlCss
)) {
    fail_rtl_layout_test('Arabic landing page content must stay centered instead of inheriting the global float');
}

echo "PASS Arabic landing-page RTL contract\n";

foreach (['travian_default', 'travian_t4'] as $pack) {
    $packRoot = dirname(__DIR__) . '/gpack/' . $pack . '/lang/ar';

    foreach (['compact.css', 'lang.css', 'gp_check.css'] as $asset) {
        $assetPath = $packRoot . '/' . $asset;
        $assetCss = is_file($assetPath) ? file_get_contents($assetPath) : false;

        if ($assetCss === false
            || strpos($assetCss, '@import "../en/' . $asset . '";') === false
            || strpos($assetCss, '@import "rtl.css";') === false) {
            fail_rtl_layout_test(
                $pack . ' Arabic graphic pack must expose ' . $asset . ' with its English base and RTL layer'
            );
        }
    }
}

echo "PASS Arabic graphic-pack CSS asset contract\n";

$defaultCompactPath = dirname(__DIR__) . '/gpack/travian_default/lang/en/compact.css';
$defaultCompactCss = file_get_contents($defaultCompactPath);
if ($defaultCompactCss === false) {
    fail_rtl_layout_test('Default graphic-pack compact stylesheet must be readable');
}

if (strpos($defaultCompactCss, 'url(img/bg.gif)') !== false
    && !is_file(dirname($defaultCompactPath) . '/img/bg.gif')) {
    fail_rtl_layout_test('Default graphic pack must not request the missing lang/en/img/bg.gif asset');
}

echo "PASS default graphic-pack asset reference contract\n";
