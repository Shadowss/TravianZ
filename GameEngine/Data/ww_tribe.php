<?php
/**
 * Clasa CSS de trib pentru Minunea Lumii.
 *
 * Intoarce " wwt<trib>" daca functia e pornita SI tribul chiar are imaginile pe
 * disc; altfel sir gol, iar minunea ramane cea originala.
 *
 * Verificarea pe disc e fallback-ul: daca stergi un folder de imagini, tribul
 * revine singur la varianta initiala, fara sa mai atingi codul.
 */
if (!function_exists('tz_ww_tribe_class')) {

    function tz_ww_tribe_class($tribe)
    {
        static $cache = array();

        $tribe = (int) $tribe;

        if ($tribe <= 0) {
            return '';
        }

        if (isset($cache[$tribe])) {
            return $cache[$tribe];
        }

        if (!defined('NEW_FUNCTION_WW_IMAGE') || !NEW_FUNCTION_WW_IMAGE) {
            return $cache[$tribe] = '';
        }

        $dir = (defined('GP_LOCATE') ? GP_LOCATE : 'gpack/travian_default/')
             . 'img/g/ww/t' . $tribe;

        return $cache[$tribe] = (is_dir($dir) && is_file($dir . '/g40_0.png'))
            ? ' wwt' . $tribe
            : '';
    }
}
