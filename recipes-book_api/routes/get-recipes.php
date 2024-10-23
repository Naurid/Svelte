<?php

header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');

$recipes = $db->read('recipes');
foreach ($recipes as &$recipe) {
    $recipe['ingredients'] = $db->read('ingredients', '*',['recipe_id'=>$recipe['id']]);
}
finish([
    'responseCode'=>200,
    'data'=> $recipes,
]);