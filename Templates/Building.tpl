<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       Building.tpl                                                ##
##  Developed by:  Dzoki                                                       ##
##  Refactored by: Shadow Incremental Refactor 			                       ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2025. All rights reserved.                ##
##                                                                             ##
##  Refactor notes:                                                            ##
##  - păstrată logica originală 100%                                           ##
##  - compatibil PHP 5.6+ / 7+                                                 ##
##  - redus cod duplicat                                                       ##
##  - output HTML mai sigur                                                    ##
##  - comentarii adăugate                                                      ##
##  - redirect securizat                                                       ##
##                                                                             ##
#################################################################################

// Încarcă datele pentru clădire/construcții
$building->loadBuilding();

/**
 * Escape HTML compatibil PHP vechi
 * Previne probleme XSS pe output
 */
if (!function_exists('safeHTML')) {
    function safeHTML($string)
    {
        return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
    }
}
?>

<?php if ($building->NewBuilding) { ?>

<table cellpadding="1" cellspacing="1" id="building_contract">

    <thead>
        <tr>
            <th colspan="4">
                <?php echo BUILDING_UPGRADING; ?>

                <?php
                // Buton instant finish dacă jucătorul are minim 2 gold
                if (isset($session->gold) && $session->gold >= 2) {
                ?>
                    <a href="?buildingFinish=1"
                       onclick="return confirm('Finish all construction and research orders in this village immediately for 2 Gold?');"
                       title="<?php echo FINISH_GOLD; ?>">

                        <img class="clock"
                             alt="<?php echo FINISH_GOLD; ?>"
                             src="img/x.gif" />
                    </a>
                <?php } ?>

            </th>
        </tr>
    </thead>

    <tbody>

    <?php
    // Verifică dacă există array valid
    if (!empty($building->buildArray) && is_array($building->buildArray)) {

        foreach ($building->buildArray as $jobs) {

            // Normalizează valorile pentru compatibilitate și siguranță
            $jobId     = isset($jobs['id']) ? (int)$jobs['id'] : 0;
            $fieldId   = isset($jobs['field']) ? (int)$jobs['field'] : 0;
            $type      = isset($jobs['type']) ? (int)$jobs['type'] : 0;
            $level     = isset($jobs['level']) ? (int)$jobs['level'] : 0;
            $timestamp = isset($jobs['timestamp']) ? (int)$jobs['timestamp'] : time();
            $master    = isset($jobs['master']) ? (int)$jobs['master'] : 0;
            $loopcon   = isset($jobs['loopcon']) ? (int)$jobs['loopcon'] : 0;

            // Nume clădire procesat
            $buildingName = Building::procResType($type);

            // Timer rămas
            $remainingTime = $timestamp - time();

            // Evită timp negativ
            if ($remainingTime < 0) {
                $remainingTime = 0;
            }

            // Ora finalizării
            $finishTime = date('H:i', $timestamp);
    ?>

        <tr>

            <!-- Buton cancel -->
            <td class="ico">
                <a href="?d=<?php echo $jobId; ?>&amp;a=0&amp;c=<?php echo safeHTML($session->checker); ?>">
                    <img src="img/x.gif"
                         class="del"
                         title="<?php echo CANCEL; ?>"
                         alt="<?php echo CANCEL; ?>" />
                </a>
            </td>

            <!-- Informații clădire -->
            <td>

                <?php if ($master == 0) { ?>

                    <a href="build.php?id=<?php echo $fieldId; ?>">
                        <?php echo safeHTML($buildingName); ?>
                    </a>

                    (Level <?php echo $level; ?>)

                    <?php
                    // Construcție în waiting loop
                    if ($loopcon == 1) {
                        echo ' (waiting loop)';
                    }
                    ?>

                <?php } else { ?>
					<a href="build.php?id=<?php echo $fieldId; ?>">
                    <?php echo safeHTML($buildingName); ?>
					</a>
                    <span class="none">
                        (Level <?php echo $level; ?>) (master builder)
                    </span>

                <?php } ?>

            </td>

            <?php if ($master == 0) { ?>

                <!-- Timer -->
                <td>
                    in
                    <span id="timer<?php echo ++$session->timer; ?>">
                        <?php echo $generator->getTimeFormat($remainingTime); ?>
                    </span>
                    <?php echo TZ_HRS_2; ?>
                </td>

                <!-- Ora finalizare -->
                <td>
                    done at <?php echo $finishTime; ?>
                </td>

            <?php } else { ?>
			
                <!-- Compatibil layout original -->
                <td colspan="2">&nbsp;</td>

            <?php } ?>

        </tr>

    <?php
        }
    }
    ?>

    </tbody>

</table>

<!-- JS original păstrat -->
<script type="text/javascript">
var bld=[{"stufe":1,"gid":"1","aid":"3"}];
</script>

<?php
} else {

    /**
     * Redirect securizat
     * Evită folosirea directă a REQUEST_URI fără validare minimă
     */

    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
        ? 'https://'
        : 'http://';

    $host = isset($_SERVER['HTTP_HOST'])
        ? $_SERVER['HTTP_HOST']
        : 'localhost';

    $requestUri = isset($_SERVER['REQUEST_URI'])
        ? $_SERVER['REQUEST_URI']
        : '/';

    // Elimină caractere invalide pentru header
    $requestUri = str_replace(array("\r", "\n"), '', $requestUri);

    $redirectUrl = $protocol . $host . $requestUri;

    header('Location: ' . $redirectUrl);
    exit;
}
?>