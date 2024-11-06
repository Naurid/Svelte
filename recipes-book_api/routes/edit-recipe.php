<?php

header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');

$inputData = $_POST;
$recipeID = $inputData['recipeID'];

//Ajouter les champs en plus si il y en a
//check si il y a plus d'ingredients ou pas
// $ingredientsForm = $_POST['recipe']['subtitle'];
// echo $ingredientsForm;
// $ingredientsDB = $db->read('ingredients','*', ['recipe_id'=>$recipeID]);
// echo $ingredientsDB;

$db->update('recipes',[
    'name'=>$inputData['recipe']['title'],
    'video_url'=> $inputData['recipe']['videoURL'],
],
['id'=> $inputData['recipeID']]);

// Vérifie si un fichier a bien été uploadé
if (isset($_FILES['recipePicture']) && $_FILES['recipePicture']['error'] === 0) {

    // Récupère les informations sur le fichier
    $file = $_FILES['recipePicture'];
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];
    $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

    // Vérifie la taille du fichier (ici, limité à 5 Mo)
    $maxFileSize = 5 * 1024 * 1024;
    if ($fileSize > $maxFileSize) {
        echo "Le fichier est trop volumineux. La taille maximale autorisée est de 5 Mo.";
        exit;
    }

    // Vérifie si le fichier est bien une image
    $fileInfo = getimagesize($fileTmpName);
    if ($fileInfo === false) {
        echo "Le fichier n'est pas une image.";
        exit;
    }

    // Autoriser seulement certains types d'images (jpg, jpeg, png, gif)
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    if (!in_array($fileInfo['mime'], $allowedTypes)) {
        echo "Seuls les fichiers JPG, PNG et GIF sont autorisés.";
        exit;
    }

    // Déplace le fichier vers un répertoire de destination
    $uploadDir = 'public/recipePictures';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }
    $destination = $uploadDir . 'image_'.$recipeID.'.'.$fileExtension;

    if (!move_uploaded_file($fileTmpName, $destination)) {
        finish([
            'responseCode' => 400,
            'message' => 'une erreur s\'est produite lors de l\'upload de l\'image',
        ]);
    }
    $db->update('recipes', [
        'image_path' => $destination
    ], ['id' => $recipeID]);

}

foreach ($_POST['recipe']['subtitle'] as $subtitle) {
    $subtitleName = $subtitle['name'];
    foreach ($subtitle['ingredients'] as $key => $ingredient) {
        $db->update('ingredients', [
            'recipe_id' => $recipeID,
            'subtitle' => $subtitleName,
            'name' => $ingredient['name'],
            'quantity' => $ingredient['quantity'],
            'ingredient_type' => $ingredient['ingredient_type']
        ], ['id'=> $key]);
    }
}

foreach ($_POST['recipe']['subtitle'] as $subtitle) {
    $subtitleName = $subtitle['name'];
    foreach ($subtitle['ingredients'] as $key => $ingredient) {
        $isitset = $key != 'undefined'; 
        if($isitset) continue;
        $db->create('ingredients', [
            'recipe_id' => $recipeID,
            'subtitle' => $subtitleName,
            'name' => $ingredient['name'],
            'quantity' => $ingredient['quantity'],
            'ingredient_type' => $ingredient['ingredient_type']
        ]);
    }
}

for ($i = 0; $i < count($_POST['recipe']['steps']); $i++) {
    $step = $_POST['recipe']['steps'][$i];
    $stepID = $step['Id'];
        $db->update('steps', [
            'recipe_id' => $recipeID,
            'step_position' => $i + 1,
            'steps_description' => $step['content']
        ],['id'=> $stepID]);
}

for ($i = 0; $i < count($_POST['recipe']['steps']); $i++) {
    $step = $_POST['recipe']['steps'][$i];
    $stepID = $step['Id'];
    if($stepID == 'undefined') continue;
        $db->create('steps', [
            'recipe_id' => $recipeID,
            'step_position' => $i + 1,
            'steps_description' => $step['content']
        ]);
}

finish([
    'responseCode' => 200,
    'data' => $_POST,
]);