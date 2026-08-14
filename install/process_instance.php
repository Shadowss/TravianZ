<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ                                                    ##
##  Filename       process_instance.php                                        ##
##  Type           : Multi-instance installation process                       ##
##  Project        : TravianZ                                                  ##
##  Source code    : https://github.com/Shadowss/TravianZ                     ##
#################################################################################

// don't let SQL time out when 30-500 seconds (depending on php.ini) is not enough
@set_time_limit(0);

require_once dirname(__DIR__) . '/GameEngine/Instance/InstanceResolver.php';
require_once dirname(__DIR__) . '/GameEngine/Instance/Instance.php';
require_once dirname(__DIR__) . '/GameEngine/Instance/ConfigRouter.php';
require_once dirname(__DIR__) . '/GameEngine/Instance/ConfigWriter.php';

final class TravianZInstanceInstallProcess
{
    private string $root;
    private string $instancesFile;

    public function __construct()
    {
        $this->root = dirname(__DIR__);
        $this->instancesFile = $this->root . '/instances/registry.json';
    }

    public function run(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->fail('Invalid request method.');
        }

        $instanceId = strtolower(trim((string) ($_POST['instance_id'] ?? '')));
        if (!TravianZInstanceResolver::isValid($instanceId)) {
            $this->fail('Invalid instance ID.');
        }

        // Select this instance before Bootstrap/Database are loaded.
        putenv('TRAVIANZ_INSTANCE=' . $instanceId);

        $action = (string) ($_POST['action'] ?? 'config');

        try {
            switch ($action) {
                case 'config':
                    $this->writeConfig($instanceId);
                    break;

                case 'structure':
                    $this->loadInstanceBootstrap();
                    $this->createStructure($instanceId);
                    break;

                case 'world':
                    $this->loadInstanceBootstrap();
                    $this->createWorld($instanceId);
                    break;

                case 'accounts':
                    $this->loadInstanceBootstrap();
                    $this->createAccounts($instanceId);
                    break;

                case 'finalize':
                    $this->finalize($instanceId);
                    break;

                default:
                    $this->fail('Unknown installation action.');
            }
        } catch (Throwable $e) {
            $this->fail($e->getMessage());
        }
    }

    /**
     * Converts the existing installer POST fields into the placeholders used
     * by constant_format.tpl. This deliberately mirrors the normal installer
     * naming convention, with aliases only where the old form uses a different
     * name (for example tzone -> STIMEZONE and paypal-email -> PAYPAL_EMAIL).
     */
    private function buildReplacements(): array
    {
        $templatePath = $this->root . '/install/data/constant_format.tpl';
        $text = file_get_contents($templatePath);
        if ($text === false) {
            $this->fail('Cannot read installer configuration template.');
        }

        preg_match_all('/%([A-Z0-9_]+)%/', $text, $matches);
        $placeholders = array_unique($matches[0] ?? []);

        $aliases = [
            '%STIMEZONE%' => 'tzone',
            '%SERVERNAME%' => 'servername',
            '%SSTARTDATE%' => 'start_date',
            '%SSTARTTIME%' => 'start_time',
            '%PAYPAL_EMAIL%' => 'paypal-email',
            '%PAYPAL_CURRENCY%' => 'paypal-currency',
            '%PLUS_PACKAGE_A_GOLD%' => 'plus-a-gold',
            '%PLUS_PACKAGE_A_PRICE%' => 'plus-a-price',
            '%PLUS_PACKAGE_B_GOLD%' => 'plus-b-gold',
            '%PLUS_PACKAGE_B_PRICE%' => 'plus-b-price',
            '%PLUS_PACKAGE_C_GOLD%' => 'plus-c-gold',
            '%PLUS_PACKAGE_C_PRICE%' => 'plus-c-price',
            '%PLUS_PACKAGE_D_GOLD%' => 'plus-d-gold',
            '%PLUS_PACKAGE_D_PRICE%' => 'plus-d-price',
            '%PLUS_PACKAGE_E_GOLD%' => 'plus-e-gold',
            '%PLUS_PACKAGE_E_PRICE%' => 'plus-e-price',
            '%GP_LOCATE%' => 'gp_locate',
            '%CRONKEY%' => null,
            '%STARTTIME%' => null,
            '%ERROR%' => 'error',
        ];

        $defaults = [
            '%SERVERNAME%' => 'TravianZ', '%SPEED%' => '1', '%INCSPEED%' => '1', '%EVASIONSPEED%' => '1',
            '%TRADERCAP%' => '1', '%CRANNYCAP%' => '1', '%TRAPPERCAP%' => '1', '%STORAGE_MULTIPLIER%' => '1',
            '%MAX%' => '100', '%LANG%' => 'en', '%STIMEZONE%' => 'Europe/Bucharest', '%BEGINNER%' => '43200',
            '%REG_OPEN%' => 'true', '%TS_THRESHOLD%' => '20', '%MEDALINTERVAL%' => '0', '%GREAT_WKS%' => 'false',
            '%WW%' => 'false', '%SHOW_NATARS%' => 'false', '%NATARS_UNITS%' => '100', '%NATARS_SPAWN_TIME%' => '260',
            '%NATARS_WW_SPAWN_TIME%' => '260', '%NATARS_WW_BUILDING_PLAN_SPAWN_TIME%' => '260', '%NATARS_WW_START_DELAY%' => '10',
            '%NATURE_REGTIME%' => '43200', '%OASIS_WOOD_MULTIPLIER%' => '40', '%OASIS_CLAY_MULTIPLIER%' => '40',
            '%OASIS_IRON_MULTIPLIER%' => '40', '%OASIS_CROP_MULTIPLIER%' => '40', '%CRONLOOP%' => '300',
            '%CRONTICK%' => '60', '%CLEANUPREPORTS%' => '14', '%CLEANUPCHAT%' => '7', '%CLEANUPMESSAGES%' => '0',
            '%HEROBASEREGEN%' => '10', '%HEROSILVERPERGOLD%' => '10', '%HEROSILVERTOGOLD%' => '25',
            '%HERORESALL%' => '3', '%HERORESONE%' => '10', '%ERRORREPORT%' => '0', '%GP%' => 'false',
            '%GP_LOCATE%' => 'gpack/travian_default/', '%ALLIANCEBONUSES%' => 'false', '%PLUSSTATS%' => 'true',
            '%PLUSSTATSHOURS%' => '6', '%PLUSSTATSKEEP%' => '0', '%USRNMSPECIAL%' => 'true', '%USRNMMIN%' => '3',
            '%USRNMMAX%' => '15', '%PWMIN%' => '4', '%WWIMAGE%' => 'true', '%PROTECTEDPLAYERS%' => '',
            '%ASUPPMSGS%' => 'true', '%ARAIDS%' => 'false', '%ARANK%' => 'false', '%CONNECTT%' => '1',
            '%DOMAIN%' => '', '%HOMEPAGE%' => '', '%SERVER%' => '', '%LIMIT_MAILBOX%' => '0', '%MAX_MAILS%' => '100',
            '%DEMOLISH%' => 'true', '%BOX1%' => 'false', '%BOX2%' => 'false', '%BOX3%' => 'false', '%VILLAGE_EXPAND%' => '0',
            '%PLUS_TIME%' => '0', '%PLUS_PRODUCTION%' => '0', '%PAYPAL_EMAIL%' => '', '%PAYPAL_CURRENCY%' => 'EUR',
            '%PEACE%' => '0', '%T4_COMING%' => 'false',
        ];

        $replacements = [];
        foreach ($placeholders as $placeholder) {
            $field = $aliases[$placeholder] ?? strtolower(trim($placeholder, '%'));
            if ($field === null) {
                continue;
            }

            if (isset($_POST[$field]) && !is_array($_POST[$field])) {
                $value = (string) $_POST[$field];
            } elseif (array_key_exists($placeholder, $defaults)) {
                $value = (string) $defaults[$placeholder];
            } else {
                $value = '';
            }

            if ($placeholder === '%STIMEZONE%') {
                $tz = explode(',', $value, 2);
                $value = $tz[1] ?? $value;
            }

            $replacements[$placeholder] = $value;
        }

        $replacements['%STARTTIME%'] = time();
        $replacements['%CRONKEY%'] = bin2hex(random_bytes(24));

        $registry = $this->readRegistry();
        if (isset($registry[(string) $_POST['instance_id']])) {
            $instance = $registry[(string) $_POST['instance_id']];
            $replacements['%SERVERNAME%'] = (string) ($instance['name'] ?? $replacements['%SERVERNAME%']);
            $replacements['%SDB%'] = (string) ($instance['database'] ?? '');
            $replacements['%PREFIX%'] = (string) ($instance['prefix'] ?? '');
        }

        return $replacements;
    }

    private function writeConfig(string $instanceId): void
    {
        $path = TravianZInstanceConfigWriter::write($instanceId, $this->buildReplacements());
        $this->updateStatus($instanceId, 'configured', ['config' => $path, 'configured_at' => date('c')]);
        $this->redirect('multi.php?instance=' . rawurlencode($instanceId));
    }

    private function loadInstanceBootstrap(): void
    {
        require_once $this->root . '/GameEngine/Instance/Bootstrap.php';
    }

    private function createStructure(string $instanceId): void
    {
        global $database;
        require_once $this->root . '/GameEngine/Database.php';
        require_once $this->root . '/GameEngine/Admin/database.php';

        $result = $database->createDbStructure();
        if ($result === false) $this->fail('Database structure creation failed.');
        if ($result === -1) $this->fail('Database structure already exists or installation requires attention.');

        $this->updateStatus($instanceId, 'structure_created', ['structure_at' => date('c')]);
        $this->redirect('multi.php?instance=' . rawurlencode($instanceId));
    }

    private function createWorld(string $instanceId): void
    {
        global $database;
        require_once $this->root . '/GameEngine/Database.php';
        require_once $this->root . '/GameEngine/Admin/database.php';

        $result = $database->populateWorldData();
        if ($result === false) $this->fail('World data creation failed.');
        if ($result === -1) $this->fail('World data already exists or installation requires attention.');

        $this->updateStatus($instanceId, 'world_created', ['world_at' => date('c')]);
        $this->redirect('multi.php?instance=' . rawurlencode($instanceId));
    }

    private function createAccounts(string $instanceId): void
    {
        // accounts.php contains the canonical account/village provisioning logic.
        // The instance environment is already selected before this include, and
        // the account script now resolves its config path through TravianZInstance.
        require $this->root . '/install/include/accounts.php';
        $this->fail('Account installation did not redirect as expected.');
    }

    private function finalize(string $instanceId): void
    {
        $registry = $this->readRegistry();
        if (!isset($registry[$instanceId])) $this->fail('Instance not found.');

        $instancePath = $this->root . '/instances/' . $instanceId;
        if (!is_dir($instancePath) && !mkdir($instancePath, 0775, true) && !is_dir($instancePath)) {
            $this->fail('Cannot create instance directory.');
        }

        if (file_put_contents($instancePath . '/installed', date('c') . PHP_EOL, LOCK_EX) === false) {
            $this->fail('Cannot create instance installed marker.');
        }

        $this->updateStatus($instanceId, 'installed', ['installed_at' => date('c')]);
        $this->redirect('multi.php?instance=' . rawurlencode($instanceId));
    }

    private function readRegistry(): array
    {
        if (!is_file($this->instancesFile)) return [];
        $data = json_decode((string) file_get_contents($this->instancesFile), true);
        return is_array($data) ? $data : [];
    }

    private function updateStatus(string $instanceId, string $status, array $extra = []): void
    {
        $registry = $this->readRegistry();
        if (!isset($registry[$instanceId]) || !is_array($registry[$instanceId])) return;

        $registry[$instanceId]['status'] = $status;
        $registry[$instanceId]['updated_at'] = date('c');
        foreach ($extra as $key => $value) $registry[$instanceId][$key] = $value;

        $tmp = $this->instancesFile . '.tmp';
        if (file_put_contents($tmp, json_encode($registry, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . PHP_EOL, LOCK_EX) === false) {
            $this->fail('Cannot update instance registry.');
        }
        if (!rename($tmp, $this->instancesFile)) {
            @unlink($tmp);
            $this->fail('Cannot activate instance registry update.');
        }
    }

    private function redirect(string $location): void
    {
        header('Location: ' . $location);
        exit;
    }

    private function fail(string $message): void
    {
        http_response_code(500);
        echo '<h1>TravianZ Multi-Instance Installer</h1>';
        echo '<p>' . htmlspecialchars($message, ENT_QUOTES, 'UTF-8') . '</p>';
        exit;
    }
}

(new TravianZInstanceInstallProcess())->run();
