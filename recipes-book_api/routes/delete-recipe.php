<?php

header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');

$recipeID =  $_POST['recipeID'];

$db->delete('recipes', ['id'=>$recipeID]);
$db->delete('ingredients', ['recipe_id'=>$recipeID]);
$db->delete('steps', ['recipe_id'=>$recipeID]);

finish([
    'responseCode'=>200,
    'data'=> $recipeID,
]);