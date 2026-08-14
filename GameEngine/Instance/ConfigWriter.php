<?php

/**
 * Writes an isolated TravianZ instance configuration from the normal
 * constant_format.tpl template.
 *
 * The writer deliberately works with an explicit replacement map. This keeps
 * the existing installer semantics intact and, importantly, preserves every
 * comment and line from the canonical template.
 */
class TravianZInstanceConfigWriter
{
    public static function write($instanceId, array $replacements)
    {
        $instanceId = TravianZInstance::sanitizeId($instanceId);
        $instancePath = TravianZInstance::path($instanceId);
        $sourceTemplate = dirname(__DIR__) . '/../install/data/constant_format.tpl';

        if (!is_file($sourceTemplate)) {
            throw new RuntimeException('Installer configuration template not found.');
        }

        if (!is_dir($instancePath) && !mkdir($instancePath, 0775, true) && !is_dir($instancePath)) {
            throw new RuntimeException('Cannot create instance directory: ' . $instanceId);
        }

        $text = file_get_contents($sourceTemplate);
        if ($text === false) {
            throw new RuntimeException('Cannot read installer configuration template.');
        }

        if ($replacements) {
            $text = str_replace(array_keys($replacements), array_values($replacements), $text);
        }

        $configPath = $instancePath . '/config.php';
        $tmpPath = $configPath . '.tmp';

        if (file_put_contents($tmpPath, $text, LOCK_EX) === false) {
            throw new RuntimeException('Cannot write temporary instance configuration.');
        }

        if (!rename($tmpPath, $configPath)) {
            @unlink($tmpPath);
            throw new RuntimeException('Cannot activate instance configuration.');
        }

        return $configPath;
    }
}
