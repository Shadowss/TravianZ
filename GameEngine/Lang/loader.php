<?php

/**
 * Load one interface language and fill its gaps from English.
 *
 * Language files define constants through tz_def(), so loading the selected
 * locale first preserves translated constants while English defines only the
 * missing ones. Their legacy $lang arrays need an explicit merge because those
 * assignments are not guarded.
 */
if (!function_exists('tz_language_array_from_file')) {
    function tz_language_array_from_file($file)
    {
        $lang = [];
        require $file;

        return is_array($lang) ? $lang : [];
    }
}

if (!function_exists('tz_load_language')) {
    function tz_load_language($language, $languageDirectory = __DIR__)
    {
        global $lang;

        $language = strtolower(trim((string) $language));
        if (!preg_match('/\A[a-z_]+\z/', $language)) {
            $language = 'en';
        }

        $languageDirectory = rtrim($languageDirectory, '/\\');
        $englishFile = $languageDirectory . '/en.php';
        if (!is_file($englishFile)) {
            throw new RuntimeException('English language fallback not found: ' . $englishFile);
        }

        $selectedFile = $languageDirectory . '/' . $language . '.php';
        if (!is_file($selectedFile)) {
            $selectedFile = $englishFile;
        }

        $localized = tz_language_array_from_file($selectedFile);
        if ($selectedFile === $englishFile) {
            $lang = $localized;
            return $lang;
        }

        $english = tz_language_array_from_file($englishFile);
        $lang = array_replace_recursive($english, $localized);

        return $lang;
    }
}
