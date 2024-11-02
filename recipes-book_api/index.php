<?php

header("Access-Control-Allow-Origin: *");

$requesturl = $_SERVER["REQUEST_URI"];
$requesturl = parse_url($requesturl);
$requesturl = $requesturl['path'];

require 'config.php';
require 'utils/database.php';
require 'utils/response.php';

if (!array_key_exists($requesturl, $config)){
finish([
        'responseCode'=>404,
        'message'=> "la route $requesturl n'a pas ete trouve !",
]);
    exit;
}

$db = new Database();

require $config[$requesturl]['path'];