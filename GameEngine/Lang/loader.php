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

if (!function_exists('tz_is_rtl_language')) {
    function tz_is_rtl_language($language)
    {
        return strtolower((string) $language) === 'ar';
    }
}

if (!function_exists('tz_arabic_ui_replacements')) {
    /**
     * A small safety net for legacy pages that still print a literal label.
     * New UI should use a language constant; this map keeps old T3 pages from
     * leaking English while those screens are being migrated.
     */
    function tz_arabic_ui_replacements()
    {
        return [
            'All rights reserved' => 'جميع الحقوق محفوظة',
            'Account transactions' => 'حركات الحساب',
            'Active players' => 'اللاعبون النشطون',
            'Attacker' => 'المهاجم',
            'Back' => 'رجوع',
            'back' => 'رجوع',
            'Balance' => 'الرصيد',
            'Buy' => 'شراء',
            'Close' => 'إغلاق',
            'Combat simulator' => 'محاكي المعارك',
            'Combat Simulator' => 'محاكي المعارك',
            'OK' => 'حسنًا',
            'Confirm' => 'تأكيد',
            'Continue' => 'متابعة',
            'Coordinates' => 'الإحداثيات',
            'Crop Finder' => 'باحث الحقول',
            'Cropper Type:' => 'نوع الحقول:',
            'Oasis Crop Bonus (min):' => 'مكافأة حقول الواحة (الحد الأدنى):',
            '9c and 15c' => '9 حقول و15 حقلًا',
            'and any bonus' => 'وأي مكافأة',
            'and at least 25% bonus' => 'ومكافأة لا تقل عن 25٪',
            'Current balance:' => 'الرصيد الحالي:',
            'Earn Gold' => 'اكسب الذهب',
            'Cost:' => 'التكلفة:',
            'Date & Time' => 'التاريخ والوقت',
            'Date' => 'التاريخ',
            'Defender' => 'المدافع',
            'Description' => 'الوصف',
            'Details' => 'التفاصيل',
            'Distance' => 'المسافة',
            'Enter code' => 'أدخل الرمز',
            'Faq' => 'الأسئلة الشائعة',
            'FAQ' => 'الأسئلة الشائعة',
            'Game Rules' => 'قواعد اللعبة',
            'Fair Play' => 'اللعب النزيه',
            'Gold history' => 'سجل الذهب',
            'Gold' => 'ذهب',
            'Login' => 'تسجيل الدخول',
            'Map' => 'الخريطة',
            'No transactions yet.' => 'لا توجد معاملات بعد.',
            'No crops fields found for the selected filters.' => 'لم يتم العثور على حقول قمح وفق المرشحات المحددة.',
            'Next' => 'التالي',
            'Normal' => 'عادي',
            'Occupied' => 'محتلة',
            'Oasis' => 'الواحة',
            'Owner' => 'المالك',
            'Package' => 'الباقة',
            'Page' => 'صفحة',
            'Previous' => 'السابق',
            'Raid' => 'غارة',
            'Register' => 'التسجيل',
            'Registration' => 'التسجيل',
            'Save' => 'حفظ',
            'Screenshot' => 'لقطة شاشة',
            'Search' => 'بحث',
            'Send Troops' => 'إرسال القوات',
            'Send' => 'إرسال',
            'Server time:' => 'وقت الخادم:',
            'Server will start in:' => 'يبدأ الخادم خلال:',
            'START NOW' => 'ابدأ الآن',
            'Start position:' => 'موضع البداية:',
            'The server is currently unavailable for maintenance.' => 'الخادم غير متاح حاليًا بسبب الصيانة.',
            'Production bonus for lumber' => 'مكافأة إنتاج الخشب',
            'Production bonus for clay' => 'مكافأة إنتاج الطين',
            'Production bonus for iron' => 'مكافأة إنتاج الحديد',
            'Production bonus for crop' => 'مكافأة إنتاج القمح',
            'Intellectual Property' => 'الملكية الفكرية',
            'Changes' => 'التغييرات',
            'forward' => 'التالي',
            'Very powerful infantry, average cavalry' => 'مشاة أقوياء جدًا وفرسان متوسطو القوة',
            'Development is expensive and takes a long time.' => 'تطويرها مكلف ويستغرق وقتًا طويلًا.',
            'Expensive siege weapons' => 'أسلحة حصار مكلفة',
            'Cheap settlers' => 'مستوطنون منخفضو التكلفة',
            'Type of attack' => 'نوع الهجوم',
            'Type' => 'النوع',
            'Village' => 'القرية',
            'Village overview' => 'نظرة عامة على القرية',
            'Village Centre' => 'مركز القرية',
            'Messages' => 'الرسائل',
            'Tariffs' => 'التعريفات',
            'World Map' => 'خريطة العالم',
            'World' => 'العالم',
            'normal' => 'عادي',
            'raid' => 'غارة',
            'next' => 'التالي',
            'previous' => 'السابق',
            'Close' => 'إغلاق',
            'Anleitung' => 'الدليل',
            'The results' => 'النتائج',
            'Top Players' => 'أفضل اللاعبين',
            'Top Attackers' => 'أفضل المهاجمين',
            'Top Defenders' => 'أفضل المدافعين',
            'Recommended for new players' => 'موصى به للاعبين الجدد',
            'recommended for new players' => 'موصى به للاعبين الجدد',
            'Let\'s play' => 'لنبدأ اللعب',
            'Change' => 'تغيير',
            'Select your tribe' => 'اختر قبيلتك',
            'Select Starting Position' => 'اختر موضع البداية',
            'Confirm your selection' => 'أكد اختيارك',
            'Great empires begin with important decisions!' => 'تبدأ الإمبراطوريات العظيمة بقرارات مهمة!',
            'Low time requirements' => 'لا تتطلب وقتًا طويلًا',
            'Moderate time requirements' => 'متطلبات زمنية متوسطة',
            'High time requirements' => 'متطلبات زمنية مرتفعة',
            'Loot protection and good defense' => 'حماية من النهب ودفاع جيد',
            'Excellent, fast cavalry' => 'فرسان ممتازون وسريعون',
            'Well suited to new players' => 'مناسبة جدًا للاعبين الجدد',
            'Can develop villages the fastest' => 'تطوّر القرى بأسرع وقت',
            'Very strong but expensive troops' => 'قوات قوية جدًا لكنها مكلفة',
            'Hard to play for new players' => 'صعبة على اللاعبين الجدد',
            'Good at looting in early game' => 'ممتازة للنهب في بداية اللعبة',
            'Strong, cheap infantry' => 'مشاة أقوياء ومنخفضو التكلفة',
            'For aggressive players' => 'مناسبة للاعبين الهجوميين',
            'Where do you want to start building up your empire?' => 'أين تريد أن تبدأ بناء إمبراطوريتك؟',
            'Confirm your choices, choose your avatar name, and start your adventure' => 'أكد اختياراتك واختر اسمك وابدأ مغامرتك',
            'Enter your avatar name:' => 'أدخل اسمك في اللعبة:',
            'This is your avatar name in the game world.' => 'هذا هو اسمك في عالم اللعبة.',
        ];
    }
}

if (!function_exists('tz_translate_arabic_markup')) {
    function tz_translate_arabic_markup($html)
    {
        $replacements = tz_arabic_ui_replacements();
        $parts = preg_split('/(<[^>]+>)/s', $html, -1, PREG_SPLIT_DELIM_CAPTURE);
        $insideRaw = false;
        foreach ($parts as $index => $part) {
            if ($part === '') {
                continue;
            }
            if ($part[0] === '<') {
                if (preg_match('/^<\/?(script|style|textarea|pre|code)\b/i', $part, $match)) {
                    $insideRaw = $part[1] === '/' ? false : true;
                }
                if (!$insideRaw || preg_match('/^<\/(script|style|textarea|pre|code)>/i', $part)) {
                    // Only translate user-facing attributes. Never rewrite
                    // class/id/href values: legacy JS and CSS depend on them.
                    $parts[$index] = preg_replace_callback(
                        '/(\b(?:alt|title|placeholder|aria-label|value)\s*=\s*)(["\'])(.*?)(\2)/is',
                        function ($attribute) use ($replacements) {
                            return $attribute[1] . $attribute[2] . strtr($attribute[3], $replacements) . $attribute[4];
                        },
                        $part
                    );
                }
                continue;
            }
            if (!$insideRaw) {
                $parts[$index] = strtr($part, $replacements);
            }
        }

        return implode('', $parts);
    }
}

if (!function_exists('tz_rtl_html_filter')) {
    function tz_rtl_html_filter($html, $gpack = null, $scriptName = null)
    {
        if (stripos($html, '<html') === false) {
            return $html;
        }

        $html = preg_replace_callback('/<html\b([^>]*)>/i', function ($match) {
            $attributes = preg_replace('/\s(?:lang|dir)\s*=\s*(?:"[^"]*"|\'[^\']*\'|[^\s>]+)/i', '', $match[1]);
            return '<html' . $attributes . ' lang="ar" dir="rtl">';
        }, $html, 1);

        $gpack = $gpack ?: (defined('GP_LOCATE') ? GP_LOCATE : 'gpack/travian_default/');
        $scriptName = $scriptName === null ? ($_SERVER['SCRIPT_NAME'] ?? '') : $scriptName;

        // notification/ owns a separate graphic pack and adds its own RTL
        // stylesheet; only inject the document attributes here.
        if (strpos($scriptName, '/notification/') !== false) {
            return $html;
        }

        $rtlFile = dirname(__DIR__, 2) . '/' . $gpack . 'lang/ar/rtl.css';
        if (!is_file($rtlFile)) {
            $gpack = 'gpack/travian_default/';
            $rtlFile = dirname(__DIR__, 2) . '/' . $gpack . 'lang/ar/rtl.css';
        }

        // The Arabic pack imports the original sprites and adds RTL rules.
        // Rewrite CSS links at the output boundary so legacy entry points
        // cannot accidentally load the English-only stylesheet.
        $html = preg_replace(
            '#((?:\.\.?/)?(?:[^"\']*/)?lang/)en/(compact|lang|gp_check)\.css#i',
            '$1ar/$2.css',
            $html
        );

        $prefix = strpos($scriptName, '/Admin/') !== false ? '../' : '';
        $version = filemtime($rtlFile);
        $href = htmlspecialchars(
            $prefix . $gpack . 'lang/ar/rtl.css?v=' . $version,
            ENT_QUOTES,
            'UTF-8'
        );

        $html = preg_replace('/<\/head>/i', '<link rel="stylesheet" href="' . $href . '" type="text/css" />$0', $html, 1);

        return tz_translate_arabic_markup($html);
    }
}

if (!function_exists('tz_enable_rtl_output')) {
    /**
     * Legacy pages do not share one PHP layout.  Add locale attributes and
     * the RTL layer once at the language boundary instead of changing each
     * entry point separately.
     */
    function tz_enable_rtl_output($language)
    {
        static $enabled = false;

        if ($enabled || !tz_is_rtl_language($language) || PHP_SAPI === 'cli') {
            return;
        }

        $enabled = true;
        ob_start(function ($html) {
            return tz_rtl_html_filter($html);
        });
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
            tz_enable_rtl_output($language);
            return $lang;
        }

        $english = tz_language_array_from_file($englishFile);
        $lang = array_replace_recursive($english, $localized);
        tz_enable_rtl_output($language);

        return $lang;
    }
}
