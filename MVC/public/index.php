<?php
use App\Utils\Application;
// On veut charger toutes les dépendances fournies par Composer
// Pour cela, 1 seul et unique fichier à inclure
require __DIR__.'/../vendor/autoload.php';
// Load session
session_start();
// On lance l'application
$app = new Application('App\Controllers');
$app->run();