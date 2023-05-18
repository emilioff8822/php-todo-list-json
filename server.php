<?php

$json_string = file_get_contents('json-team.json');

$team = json_decode($json_string, true);

header('Content-Type: application/json');
echo json_encode($team);


// var_dump($team);


?>





