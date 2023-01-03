<?php
function setPath($str)
{
    # code...
    $r = preg_replace('/[\/\\\#\s\'",]+/', "-", $str);
    var_dump($r);
}

$rows = [["tiele" => "hello"], ["tiele" => "hello"]];

foreach ($rows as $key => $item) {
    echo $key . "-" . $item["title"];
}
