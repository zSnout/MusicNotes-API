<?php
    header("Access-Control-Allow-Origin: *");
    preg_match_all("/(?<=(?:\?|&|:|,))([A-G](?:b|h|flat|sharp|))(maj|min|aug|dim|M|m|a|d|)((?:[0-9]-[0-9])|(?:(?:[0-9]\+)*[0-9])|)(?=\?|&|:|,|$)/",$_SERVER["REQUEST_URI"],$match);
    $fulls = $match[0];
    $bases = $match[1];
    $types = $match[2];
    $notes = $match[3];
    for ($i = 0;$i < count($fulls);$i = $i + 1) {
        $bases[$i] = str_replace("sharp","#",$bases[$i]);
        $bases[$i] = str_replace("flat","b",$bases[$i]);
        $bases[$i] = str_replace("h","#",$bases[$i]);
        
        if ($types[$i] == "") {
            $types[$i] = "maj";
        } else if ($types[$i] == "M") {
            $types[$i] = "maj";
        } else if ($types[$i] == "m") {
            $types[$i] = "min";
        } else if ($types[$i] == "a") {
            $types[$i] = "aug";
        } else if ($types[$i] == "d") {
            $types[$i] = "dim";
        }
        
        if ($notes[$i] == "") {
            if ($types[$i] == "maj" || $types[$i] == "min") {
                $notes[$i] = "1-8";
            } else if ($types[$i] == "aug") {
                $notes[$i] = "1-7";
            } else if ($types[$i] == "dim") {
                $notes[$i] = "1-9";
            }
        }
        
        if (preg_match("/^([0-9])-([0-9])$/",$notes[$i],$match)) {
            $txt = "";
            for ($v = (int)($match[1]);$v <= (int)($match[2]);$v = $v + 1) {
                if ($txt == "") {
                    $txt = "$v";
                } else {
                    $txt = $txt . "+$v";
                }
            }
            $notes[$i] = $txt;
        }
        
        $fulls[$i] = $bases[$i] . $types[$i] . $notes[$i];
    }
    
    $newFulls = [];
    $newBases = [];
    $newTypes = [];
    $newNotes = [];
    for ($i = 0;$i < count($fulls);$i = $i + 1) {
        $notesI = explode("+",$notes[$i]);
        foreach ($notesI as $note) {
            $newFulls[] = $bases[$i] . $types[$i] . $note;
            $newBases[] = $bases[$i];
            $newTypes[] = $types[$i];
            $newNotes[] = $note;
        }
    }
    $fulls = $newFulls;
    $bases = $newBases;
    $types = $newTypes;
    $notes = $newNotes;
    
    function scale($type) {
        $maj = array(0,0,2,2,1,2,2,2, 1, 2);
        $maj = array(0,0,2,4,5,7,9,11,12,14);
        
        $min = array(0,0,2,1,2,2,1,2, 2, 2);
        $min = array(0,0,2,3,5,7,8,10,12,14);
        
        $aug = array(0,0,3,1,3,1,3, 1, 3, 1);
        $aug = array(0,0,3,4,7,8,11,12,15,16);
        
        $dim = array(0,0,2,1,2,1,2,1,2, 1);
        $dim = array(0,0,2,3,5,6,8,9,11,12);
        
        if ($type == "min") {
            return $min;
        } else if ($type == "aug") {
            return $aug;
        } else if ($type == "dim") {
            return $dim;
        } else {
            return $maj;
        }
    }
    
    function num2note($note) {
        $note = fmod((int)($note),12);
        return (array("C","C#","D","D#","E","F","F#","G","G#","A","A#","B"))[$note];
    }
    
    function note2num($note) {
        $array = array(
            "B#" => 0,
            "C" => 0,
            
            "C#" => 1,
            "Db" => 1,
            
            "D" => 2,
            
            "D#" => 3,
            "Eb" => 3,
            
            "E" => 4,
            "Fb" => 4,
            
            "E#" => 5,
            "F" => 5,
            
            "F#" => 6,
            "Gb" => 6,
            
            "G" => 7,
            
            "G#" => 8,
            "Ab" => 8,
            
            "A" => 9,
            
            "A#" => 10,
            "Bb" => 10,
            
            "B" => 11,
            "Cb" => 11
        );
        if (array_key_exists($note,$array)) {
            return $array[$note];
        }
        return 0;
    }
    
    function getNote($base,$type,$note) {
        $note = (int)($note);
        if ($note < 0) {
            $note = 0;
        }
        if ($note > 9) {
            $note = 9;
        }
        
        $scale = scale($type);
        
        return num2note((int)(note2num($base)) + (int)($scale[$note]));
    }
    
    for ($i = 0;$i < count($fulls);$i = $i + 1) {
        echo getNote($bases[$i],$types[$i],$notes[$i]);
        if ($i != count($fulls) - 1) {
            echo ",";
        }
    }
?>
