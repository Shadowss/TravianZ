<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       links.tpl                                                   ##
##  Developed by:  Slim, Manuel Mannhardt 							           ##
##  Refactored by: Shadow Incremental Refactor 			                       ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2025. All rights reserved.                ##
##                                                                             ##
##  Refactor notes:                                                            ##
##  - păstrată logica originală 100%                                           ##
##  - compatibil PHP 5.6+ / 7+                                                 ##
##  - redus cod duplicat                                                       ##
##  - securizare output HTML                                                   ##
##  - protecție basic URL                                                      ##
##  - comentarii adăugate                                                      ##
##                                                                             ##
#################################################################################

/**
 * Escape HTML compatibil PHP vechi
 */
if (!function_exists('safeHTML')) {
    function safeHTML($string)
    {
        return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
    }
}

/**
 * Verifică URL minim
 * Compatibil PHP vechi
 */
if (!function_exists('safeLinkUrl')) {
    function safeLinkUrl($url)
    {
        $url = trim($url);

        // Blochează javascript:
        if (stripos($url, 'javascript:') === 0) {
            return '#';
        }

        return $url;
    }
}

/**
 * Fetch links utilizator
 */
$query = $database->getLinks($session->uid);

/**
 * Verifică query valid
 */
if ($query && mysqli_num_rows($query) > 0) {

    /**
     * Cache links
     */
    $links = array();

    while ($data = mysqli_fetch_assoc($query)) {
        $links[] = $data;
    }
?>

<!-- ===================== PLAYER LINKS ===================== -->

<table cellpadding="1" cellspacing="1">

    <thead>

        <tr>
            <td colspan="3">
                <a href="spieler.php?s=2"><?php echo TZ_LINKS; ?></a>
            </td>
        </tr>

    </thead>

    <tbody>

<?php
/**
 * Render links
 */
foreach ($links as $link) {

    /**
     * Normalizează date
     */
    $linkName = isset($link['name'])
        ? $link['name']
        : '';

    $linkUrl = isset($link['url'])
        ? $link['url']
        : '';

    /**
     * Link extern
     * URL terminat în *
     */
    $isExternal = false;

    if (substr($linkUrl, -1) === '*') {

        $isExternal = true;

        // Elimină *
        $linkUrl = substr($linkUrl, 0, -1);
    }

    /**
     * Securizare URL
     */
    $linkUrl = safeLinkUrl($linkUrl);

    /**
     * Target extern
     */
    $target = '';

    if ($isExternal) {
        $target = ' target="_blank" rel="noopener noreferrer"';
    }

    /**
     * Icon extern
     */
    $externalIcon = '';

    if ($isExternal) {

        $externalIcon = '<img src="gpack/travian_default/img/a/external.gif"
                              alt="External"
                              title="External" />';
    }
?>

        <tr>

            <td class="dot">●</td>

            <td class="link">

<?php
/**
 * Fără PLUS
 */
if ((int)$session->plus == 0) {

    echo 'buy Plus';

} else {

    echo '<a href="' . safeHTML($linkUrl) . '"' . $target . '>'
        . safeHTML($linkName)
        . $externalIcon
        . '</a>';
}
?>

            </td>

        </tr>

<?php } ?>

    </tbody>

</table>

<?php } ?>