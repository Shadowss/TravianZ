<?php

if (!isset($argv[1])) {
    foreach (['es' => 'es', 'invalid' => 'en'] as $configured => $expected) {
        $command = escapeshellarg(PHP_BINARY)
            . ' '
            . escapeshellarg(__FILE__)
            . ' '
            . escapeshellarg($configured)
            . ' '
            . escapeshellarg($expected);

        passthru($command, $status);
        if ($status !== 0) {
            exit($status);
        }
    }

    fwrite(STDOUT, "Registration language regression test passed.\n");
    exit(0);
}

define('USER', 2);
define('TB_PREFIX', 'test_');
define('SERVER_LANG', $argv[1]);
define('START_DATE', date('d.m.Y'));
define('START_TIME', '00:00');
define('PROTECTION', 0);

require_once __DIR__ . '/../../GameEngine/Database/DatabaseUserQueries.php';

final class RegistrationLanguageStatement
{
    public $insert_id = 42;

    public function bind_param($types, &...$values)
    {
    }

    public function execute()
    {
        return true;
    }

    public function close()
    {
    }
}

final class RegistrationLanguageConnection
{
    public function prepare($query)
    {
        return new RegistrationLanguageStatement();
    }
}

final class RegistrationLanguageHarness
{
    use DatabaseUserQueries;

    public $dblink;
    public $language;

    public function __construct()
    {
        $this->dblink = new RegistrationLanguageConnection();
    }

    public function updateUserField($ref, $field, $value, $switch)
    {
        if ($field === 'lang') {
            $this->language = $value;
        }
    }

    private function grantRegistrationGold($id)
    {
    }
}

$database = new RegistrationLanguageHarness();
$id = $database->register('player', 'password', 'player@example.com', 1, '');

if ($id !== 42) {
    fwrite(STDERR, "Registration did not return the inserted account ID.\n");
    exit(1);
}

if ($database->language !== $argv[2]) {
    fwrite(
        STDERR,
        "Expected registration language {$argv[2]}; got {$database->language}.\n"
    );
    exit(1);
}
