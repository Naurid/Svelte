<?php

header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');

$inputData = $_POST;

$recipeId = $db->create('recipes', [
    'name' => $_POST['recipe']['title'],
    'video_url' => $_POST['recipe']['videoURL'],
]);

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
    $destination = $uploadDir . 'image_'.$recipeId.'.'.$fileExtension;

    if (!move_uploaded_file($fileTmpName, $destination)) {
        finish([
            'responseCode' => 400,
            'message' => 'une erreur s\'est produite lors de l\'upload de l\'image',
        ]);
    }
    $db->update('recipes', [
        'image_path' => $destination
    ], ['id' => $recipeId]);

}

foreach ($_POST['recipe']['subtitle'] as $subtitle) {
    $subtitleName = $subtitle['name'];
    foreach ($subtitle['ingredients'] as $key => $ingredient) {
        $db->create('ingredients', [
            'recipe_id' => $recipeId,
            'subtitle' => $subtitleName,
            'name' => $ingredient['name'],
            'quantity' => $ingredient['quantity'],
            'ingredient_type' => $ingredient['ingredient_type']
        ]);
    }
}
for ($i = 0; $i < count($_POST['recipe']['steps']); $i++) {
    $step = $_POST['recipe']['steps'][$i]; {
        $db->create('steps', [
            'recipe_id' => $recipeId,
            'step_position' => $i + 1,
            'steps_description' => $step['content']
        ]);
    }
    # code...
}


finish([
    'responseCode' => 200,
    'data' => $_POST,
]);