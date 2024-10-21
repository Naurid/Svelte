<?php

header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');

$inputData = $_POST; 


$recipes = $db->create('recipes',
                        $data=[
                            'id'=> NULL,
                            'name'=> $inputData['name'],
                                ]
);

finish([
    'responseCode'=>200,
    'data'=> $recipes,
]);