<?php

header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');

$inputData = $_POST; 

$recipeId = $db->create('recipes',[
    'name'=>$_POST['recipe']['title']
]);

foreach ($_POST['recipe']['subtitle'] as $subtitle) {
    $subtitleName = $subtitle['name'];
    foreach ($subtitle['ingredients'] as $key => $ingredient) {
        $db->create('ingredients',[
            'recipe_id'=>$recipeId,
            'subtitle'=>$subtitleName,
            'name'=>$ingredient['name'],
            'quantity'=>$ingredient['quantity']
        ]);
    }
}

finish([
    'responseCode'=>200,
    'data'=> $_POST,
]);