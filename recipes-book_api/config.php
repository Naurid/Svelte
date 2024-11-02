<?php
header("Access-Control-Allow-Origin: *");
$config = [
    "/get-recipes"=>[
        'path'=> "./routes/get-recipes.php"
    ],
    "/create-recipe"=>[
        'path'=> "./routes/create-recipe.php"
    ],
    "/edit-recipe"=>[
        'path'=> "./routes/edit-recipe.php"
    ],
];

$serverConfig = [
    'default'=> [
        'server'=> 'localhost',
        'user'=> 'root',
        'password'=> '',
        'db'=> 'recipe_book',
    ]
];