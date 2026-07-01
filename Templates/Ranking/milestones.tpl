<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ      					       		 		  	   ##
##  Version:       01.07.2026 						       	 				   ##
##  Filename       milestones.tpl                                              ##
##  Created by     Shadow					                                   ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2026. All rights reserved.                ##
##  URLs:          http://travianz.org	     				       	 		   ##
##  Source code:   http://github.com/Shadowss/TravianZ/         	       	   ##
##                                                                             ##
#################################################################################

mysqli_report(MYSQLI_REPORT_OFF);

// =========================
// SERVER MILESTONES (NEW_FUNCTIONS_MILESTONES)
// "First player on the server to..." achievements. Data is recorded by
// hooks placed at the relevant game events (see GameEngine/Database.php's
// recordMilestoneIfFirst()/getMilestones(), and the hooks in
// GameEngine/Automation.php, GameEngine/Alliance.php). This section only
// READS what's already been recorded — it never writes anything itself.
// =========================
$milestonesEnabled = defined('NEW_FUNCTIONS_MILESTONES') && NEW_FUNCTIONS_MILESTONES;
$milestonesData = $milestonesEnabled ? $database->getMilestones() : [];

// Lightens ($percent > 0) or darkens ($percent < 0) a "#rrggbb" color, used
// to build each badge's radial-gradient inline (kept as plain computed hex
// stops rather than CSS color-mix()/custom properties, for broader browser
// compatibility with this project's existing baseline).
function tzms_shade($hex, $percent) {
    $hex = ltrim($hex, '#');
    $r = hexdec(substr($hex, 0, 2));
    $g = hexdec(substr($hex, 2, 2));
    $b = hexdec(substr($hex, 4, 2));
    $adjust = function ($c) use ($percent) {
        $c = $percent < 0 ? $c * (1 + $percent / 100) : $c + (255 - $c) * ($percent / 100);
        return max(0, min(255, (int) round($c)));
    };
    return sprintf('#%02x%02x%02x', $adjust($r), $adjust($g), $adjust($b));
}

// Simple line-icon set (inline SVG, no external image files, so there's
// nothing that can 404 regardless of where this is deployed).
$milestoneIcons = [
    'village' => '<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 21V11.5L9 7.5L14 11.5V21" stroke="white" stroke-width="1.6" stroke-linejoin="round"/><path d="M9 21v-5h3v5" stroke="white" stroke-width="1.6" stroke-linejoin="round"/><path d="M14 13.5L18 10.5L21 13v8h-5" stroke="white" stroke-width="1.4" stroke-linejoin="round" opacity="0.85"/></svg>',
    'population' => '<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="8" cy="8.2" r="2.6" stroke="white" stroke-width="1.5"/><circle cx="16" cy="8.2" r="2.6" stroke="white" stroke-width="1.5"/><circle cx="12" cy="7" r="2.6" stroke="white" stroke-width="1.5" opacity="0.9"/><path d="M3.3 19c.6-2.8 2.6-4.3 4.5-4.3s3.9 1.5 4.5 4.3" stroke="white" stroke-width="1.4" stroke-linecap="round"/><path d="M11.7 19c.6-2.8 2.6-4.3 4.5-4.3s3.9 1.5 4.5 4.3" stroke="white" stroke-width="1.4" stroke-linecap="round"/></svg>',
    'artifact' => '<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 3l4.5 3-1.7 5.5H9.2L7.5 6z" stroke="white" stroke-width="1.5" stroke-linejoin="round"/><path d="M7.5 6L12 21 16.5 6" stroke="white" stroke-width="1.5" stroke-linejoin="round"/><path d="M9.2 11.5h5.6" stroke="white" stroke-width="1.2"/></svg>',
    'wonder' => '<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 2.5 14.5 6H9.5Z" stroke="white" stroke-width="1.3" stroke-linejoin="round"/><rect x="8" y="6" width="8" height="3" stroke="white" stroke-width="1.3"/><rect x="6.5" y="9" width="11" height="3" stroke="white" stroke-width="1.3"/><rect x="5" y="12" width="14" height="3.5" stroke="white" stroke-width="1.3"/><rect x="3.5" y="15.5" width="17" height="4" stroke="white" stroke-width="1.3"/><path d="M3 21h18" stroke="white" stroke-width="1.4" stroke-linecap="round"/></svg>',
    'plan' => '<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6 4h9l4 4v12H6z" stroke="white" stroke-width="1.5" stroke-linejoin="round"/><path d="M15 4v4h4" stroke="white" stroke-width="1.5" stroke-linejoin="round"/><path d="M8.5 11h7M8.5 14h7M8.5 17h4.5" stroke="white" stroke-width="1.3" stroke-linecap="round"/></svg>',
    'alliance' => '<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 3l7 3v5.5c0 4.5-3 7.7-7 9-4-1.3-7-4.5-7-9V6z" stroke="white" stroke-width="1.5" stroke-linejoin="round"/><path d="M8.5 12l2.3 2.3L15.8 9.5" stroke="white" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>',
    'conquest' => '<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 4l7 7M4 4l1 3.2L7.2 8" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M20 4l-7 7M20 4l-1 3.2L16.8 8" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M3 20l6.5-6.5M21 20l-6.5-6.5" stroke="white" stroke-width="1.6" stroke-linecap="round"/><path d="M11 13l1 1 1-1" stroke="white" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg>',
    'five_villages' => '<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5 22V14.5L8 12L11 14.5V22" stroke="white" stroke-width="1.4" stroke-linejoin="round"/><path d="M8 22v-3h2v3" stroke="white" stroke-width="1.4" stroke-linejoin="round"/><path d="M11 16L13.5 14L16 16V22H11" stroke="white" stroke-width="1.3" stroke-linejoin="round" opacity="0.9"/><path d="M2.5 17L4 16l2 1" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" opacity="0.75"/><path d="M2.5 17V22H5" stroke="white" stroke-width="1.2" stroke-linejoin="round" opacity="0.75"/><path d="M19 16l1.5-1L22 16V22h-3" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" opacity="0.75"/><circle cx="12" cy="6" r="1.8" stroke="white" stroke-width="1.3"/><path d="M10 8.5l2 1.5 2-1.5" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/></svg>',
];

$milestoneDefs = [
    'second_village'     => ['label' => TZ_MILESTONE_SECOND_VILLAGE,     'icon' => 'village',       'color' => '#c0783c'],
    'population_1000'    => ['label' => TZ_MILESTONE_POPULATION_1000,    'icon' => 'population',    'color' => '#3c78c0'],
    'first_artifact'     => ['label' => TZ_MILESTONE_FIRST_ARTIFACT,     'icon' => 'artifact',      'color' => '#8a4fc0'],
    'first_ww'           => ['label' => TZ_MILESTONE_FIRST_WW,           'icon' => 'wonder',        'color' => '#c0a030'],
    'first_ww_plan'      => ['label' => TZ_MILESTONE_FIRST_WW_PLAN,      'icon' => 'plan',          'color' => '#2f9e8f'],
    'first_alliance'     => ['label' => TZ_MILESTONE_FIRST_ALLIANCE,     'icon' => 'alliance',      'color' => '#3fa14a'],
    'first_pvp_conquest' => ['label' => TZ_MILESTONE_FIRST_PVP_CONQUEST, 'icon' => 'conquest',      'color' => '#b6362f'],
    'five_villages'      => ['label' => TZ_MILESTONE_FIVE_VILLAGES,      'icon' => 'five_villages', 'color' => '#7a6030'],
];
?>

<?php if ($milestonesEnabled): ?>
<!-- ================= SERVER MILESTONES ================= -->
<div class="tzms-wrap">
	<div class="tzms-title"><?php echo TZ_SERVER_MILESTONES; ?></div>
	<div class="tzms-row">
		<?php foreach ($milestoneDefs as $mkey => $mdef):
			$achieved = $milestonesData[$mkey] ?? null;
			$light = tzms_shade($mdef['color'], 28);
			$dark  = tzms_shade($mdef['color'], -32);
			$bg = $achieved
				? sprintf('background:radial-gradient(circle at 32%% 28%%, %s, %s 55%%, %s 100%%);border-color:rgba(255,255,255,0.35);', $light, $mdef['color'], $dark)
				: 'background:#d8d8d8;border-color:rgba(0,0,0,0.08);';
			$title = htmlspecialchars($mdef['label'], ENT_QUOTES, 'UTF-8');

			// Caption text under badge:
			// - first_alliance shows the alliance name/tag (stored in `extra`)
			// - all others show the player username
			if ($achieved) {
				if ($mkey === 'first_alliance') {
					$caption = htmlspecialchars($achieved['extra'] ?: $achieved['username'] ?: '', ENT_QUOTES, 'UTF-8');
				} else {
					$caption = htmlspecialchars($achieved['username'] ?: '', ENT_QUOTES, 'UTF-8');
				}
			} else {
				$caption = '';
			}

			// Tooltip meta line:
			// - first_alliance: shows alliance name on first line, founder + date on second
			// - all others: "Username — dd.mm.yy H:i:s"
			if ($achieved) {
				if ($mkey === 'first_alliance') {
					$meta = htmlspecialchars(
						($achieved['extra'] ?: '-') . "\n" .
						TZ_MILESTONE_FOUNDED_BY . ' ' . ($achieved['username'] ?: '-') . ' — ' . date('d.m.y G:i:s', (int)$achieved['achieved_time']),
						ENT_QUOTES, 'UTF-8'
					);
				} else {
					$meta = htmlspecialchars(
						($achieved['username'] ?: '-') . ' — ' . date('d.m.y G:i:s', (int)$achieved['achieved_time']),
						ENT_QUOTES, 'UTF-8'
					);
				}
			} else {
				$meta = htmlspecialchars(TZ_MILESTONE_NOT_YET, ENT_QUOTES, 'UTF-8');
			}
		?>
		<div class="tzms-badge<?php echo $achieved ? ' tzms-achieved' : ' tzms-locked'; ?>"
			 data-title="<?php echo $title; ?>"
			 data-meta="<?php echo $meta; ?>"
			 onmouseenter="tzmsShow(this)"
			 onmouseleave="tzmsHide()">
			<?php if ($achieved): ?><a href="spieler.php?uid=<?php echo (int)$achieved['uid']; ?>" class="tzms-icon" style="<?php echo $bg; ?>"><?php echo $milestoneIcons[$mdef['icon']] ?? ''; ?></a>
			<?php else: ?><span class="tzms-icon" style="<?php echo $bg; ?>"><?php echo $milestoneIcons[$mdef['icon']] ?? ''; ?></span>
			<?php endif; ?>
			<div class="tzms-caption"><?php echo $caption; ?></div>
		</div>
		<?php endforeach; ?>
	</div>
</div>
<div id="tzms_tooltip" class="tzms-tooltip"></div>

<style>
.tzms-wrap{max-width:760px;margin:0 auto 16px;text-align:center;padding:12px 10px 6px;background:#fbfbfb;border:1px solid #ddd;border-radius:6px;}
.tzms-title{font-size:11px;font-weight:bold;letter-spacing:1.5px;color:#8a8a8a;text-transform:uppercase;margin-bottom:12px;}
.tzms-row{display:flex;justify-content:center;gap:20px;flex-wrap:wrap;}
.tzms-badge{position:relative;width:64px;}
.tzms-icon{display:flex;align-items:center;justify-content:center;width:56px;height:56px;margin:0 auto;border-radius:50%;border:2px solid;box-shadow:0 2px 6px rgba(0,0,0,0.3), inset 0 1px 2px rgba(255,255,255,0.35);text-decoration:none;transition:transform .12s ease;}
.tzms-badge.tzms-achieved{cursor:pointer;}
.tzms-badge.tzms-achieved:hover .tzms-icon{transform:scale(1.08);}
.tzms-badge.tzms-locked .tzms-icon{opacity:0.6;box-shadow:none;}
.tzms-badge.tzms-locked svg{opacity:0.55;}
.tzms-icon svg{width:28px;height:28px;}
.tzms-caption{margin-top:5px;font-size:10px;color:#666;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:64px;margin-left:auto;margin-right:auto;}
/* position:fixed — tooltip is always anchored to the viewport, immune to
   any overflow:hidden or position:relative on parent containers */
.tzms-tooltip{display:none;position:fixed;z-index:99999;background:#1b1b1b;color:#fff;padding:8px 12px;border-radius:5px;font-size:12px;line-height:1.55;box-shadow:0 3px 10px rgba(0,0,0,0.4);max-width:260px;text-align:left;pointer-events:none;white-space:pre-line;}
.tzms-tip-title{font-weight:bold;color:#fff;}
.tzms-tip-meta{color:#b7b7b7;font-size:11px;margin-top:3px;white-space:pre-line;}
</style>
<script type="text/javascript">
function tzmsShow(el) {
	var tip = document.getElementById('tzms_tooltip');
	if (!tip) return;
	var title = document.createElement('div');
	title.className = 'tzms-tip-title';
	title.textContent = el.getAttribute('data-title') || '';
	var meta = document.createElement('div');
	meta.className = 'tzms-tip-meta';
	meta.textContent = el.getAttribute('data-meta') || '';
	tip.innerHTML = '';
	tip.appendChild(title);
	tip.appendChild(meta);
	tip.style.display = 'block';

	// position:fixed — coords are already viewport-relative, no scroll offset needed
	var rect = el.getBoundingClientRect();
	var top  = rect.bottom + 8;
	var left = rect.left;
	var maxLeft = (document.documentElement.clientWidth || window.innerWidth) - 270;
	if (left > maxLeft) left = Math.max(4, maxLeft);
	if (top + 80 > (document.documentElement.clientHeight || window.innerHeight)) {
		top = rect.top - 80; // flip above if near bottom of viewport
	}
	tip.style.top  = top + 'px';
	tip.style.left = left + 'px';
}
function tzmsHide() {
	var tip = document.getElementById('tzms_tooltip');
	if (tip) tip.style.display = 'none';
}
</script>
<?php endif; ?>

<?php?>
<table cellpadding="1" cellspacing="1" id="search_navi">