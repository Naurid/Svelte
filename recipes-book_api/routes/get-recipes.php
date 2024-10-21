<?php

header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');

$recipes = $db->read('recipes');

finish([
    'responseCode'=>200,
    'data'=> $recipes,
]);