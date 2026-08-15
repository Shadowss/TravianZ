<?php

#################################################################################
##              TravianZ - Multi-instance configuration bootstrap             ##
##  Filename       : config.php                                                ##
##  Purpose        : Load exactly one world's generated configuration.         ##
##  License        : TravianZ Project                                          ##
#################################################################################

/**
 * This file is intentionally NOT the generated world configuration anymore.
 *
 * The installer writes the complete configuration generated from
 * install/data/constant_format.tpl to:
 *
 *     instances/<instance>/config.php
 *
 * Keeping this bootstrap at GameEngine/config.php is important because a large
 * part of the existing TravianZ code includes this path directly. The existing
 * game engine can therefore remain instance-agnostic while this file selects
 * the correct world before any of its constants are defined.
 */

require_once __DIR__ . '/Instance/Resolver.php';

$travianInstance = InstanceResolver::resolve();
$travianConfig = InstanceResolver::configPath($travianInstance);

if (!is_file($travianConfig)) {
    $message = 'TravianZ instance configuration not found for instance: ' . $travianInstance;

    if (PHP_SAPI === 'cli') {
        fwrite(STDERR, $message . PHP_EOL);
        exit(1);
    }

    http_response_code(503);
    exit($message);
}

/**
 * The generated instance configuration defines INSTANCE_ID as an additional
 * identity marker. Constants must only ever be loaded once per PHP request.
 */
require_once $travianConfig;

/**
 * Backward compatibility for instances created before INSTANCE_RUNTIME_PATH
 * was added to the generated configuration template.
 *
 * The instance configuration itself is the authoritative source when the
 * constant exists. For an older configuration, derive the runtime directory
 * from the actual location of that instance's config.php. This allows an
 * already-installed world to be upgraded without reinstalling it.
 */
if (!defined('INSTANCE_RUNTIME_PATH')) {
    define(
        'INSTANCE_RUNTIME_PATH',
        dirname($travianConfig) . DIRECTORY_SEPARATOR . 'runtime' . DIRECTORY_SEPARATOR
    );
}

/**
 * Runtime directories belong to the instance, not to the shared TravianZ
 * source tree. Create the directory lazily so existing installations are
 * migrated automatically the first time their configuration is loaded.
 */
if (!is_dir(INSTANCE_RUNTIME_PATH) && !@mkdir(INSTANCE_RUNTIME_PATH, 0755, true)) {
    $message = 'TravianZ instance runtime directory could not be created: ' . INSTANCE_RUNTIME_PATH;

    if (PHP_SAPI === 'cli') {
        fwrite(STDERR, $message . PHP_EOL);
        exit(1);
    }

    http_response_code(500);
    exit($message);
}
