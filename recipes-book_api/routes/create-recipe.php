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
            'quantity'=>$ingredient['quantity'],
            'ingredient_type'=>$ingredient['ingredient_type']
        ]);
    }
}
for ($i=0; $i < count($_POST['recipe']['steps']); $i++) { 
    $step = $_POST['recipe']['steps'][ $i];
    {
        $db->create('steps',[
            'recipe_id'=>$recipeId,
            'step_position'=>$i+1,
            'steps_title'=>$step['title'],
            'steps_description'=>$step['content']
        ]);
    }
    # code...
}


finish([
    'responseCode'=>200,
    'data'=> $_POST,
]);