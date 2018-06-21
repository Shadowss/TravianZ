<?php 
class Artifacts{
    
    /**
     * Gets the artifact informations in plain text
     * 
     * @param int $artifact The artifact
     * @return array Returns the information of the artifacts
     */
    
    public static function getArtifactInfo($artifact){
        
        $activationTime = 86400 / (SPEED == 2 ? 1.5 : (SPEED == 3 ? 2 : SPEED));
        $time = time();
        $nextEffect = "-";
        
        if($artifact['size'] == 1 && $artifact['type'] != 11){
            $requiredLevel = 10;
            $effectInfluence = VILLAGE;
        }else{
            $requiredLevel = $artifact['type'] != 11 ? 20 : 10;
            $effectInfluence = ACCOUNT;
        }
  
        if($artifact['owner'] == 3) $active = "-";
        elseif(!$artifact['active'] && $artifact['conquered'] < $time - $activationTime) $active = "<b>Can't be activated</b>";
        elseif (!$artifact['active']) $active = date("d.m.Y H:i:s", $artifact['conquered'] + $activationTime);
        else
        {
            $active = "<b>".ACTIVE."</b>";
            $nextEffect = date("d.m.Y H:i:s", $artifact['lastupdate'] + (86400 / (SPEED == 2 ? 1.5 : (SPEED == 3 ? 2 : SPEED))));
        }
        
        //// Added by brainiac - thank you
        if ($artifact['type'] == 8)
        {
            $kind = $artifact['kind'];
            $effect = $artifact['effect2'];
        }else{
            $kind = $artifact['type'];
            $effect = $artifact['effect'];
        }
        
        $artifactBadEffect = $artifact['type'] == 8 && $artifact['bad_effect'] == 1;
        switch($kind){
            case 1:
                $betterorbadder = $artifactBadEffect ? BUILDING_WEAKER : BUILDING_STRONGER;
                break;
            case 2:
                $betterorbadder = $artifactBadEffect ? TROOPS_SLOWEST : TROOPS_FASTER;
                break;
            case 3:
                $betterorbadder = $artifactBadEffect ? SPIES_DECRESE : SPIES_INCREASE;
                break;
            case 4:
                $betterorbadder = $artifactBadEffect ? CONSUME_HIGH : CONSUME_LESS;
                break;
            case 5:
                $betterorbadder = $artifactBadEffect ? TROOPS_MAKE_SLOWEST : TROOPS_MAKE_FASTER;
                break;
            case 6:
                $betterorbadder = $artifactBadEffect ? YOU_CONSTRUCT : YOU_CONSTRUCT;
                break;
            case 7:
                $betterorbadder = $artifactBadEffect ? CRANNY_DECRESE : CRANNY_INCREASED;
                break;
            case 8:
                $betterorbadder = $artifactBadEffect ? SPIES_INCREASE : SPIES_DECRESE;
                break;
        }
        $bonus = isset($betterorbadder) ? $betterorbadder." (<b>".str_replace(["(", ")"], "" , $effect)."</b>)" : (($kind == 11 && $artifact['active']) ? "<b>".WW_BUILDING_PLAN."</b>" : "<b>Not yet active</b>");
        
        return ["requiredLevel" => $requiredLevel, "active" => $active,
                "bonus" => $bonus, "effectInfluence" => $effectInfluence,
                "nextEffect" => $nextEffect];
    }
}

?>