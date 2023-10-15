<?php
// TODO: sanitize input (?)
$contents = file_get_contents("php://stdin");
$jsonAssoc = json_decode($contents, true);
$output = [];

foreach($jsonAssoc as $item){
    $output[$item["category"]][] = [
        "id" => $item["id"]
    ];
}

file_put_contents("./results.txt", json_encode($output));