<?php

// ==================================================
// Ce fichier permet de centraliser
// la gestion des règles de sécurités
// On pourrait à terme stocker ces règles dans une BDD
// et mettre en place un formulaire pour les modifier
// 
// Compléter ce fichier avec vos propres routes à sécuriser
//===================================================

// ACL : Access Control List
// Permet de centraliser la gestion des autorisations
$acl = [
    // 'Ressource' => 'les personnes (rôles) qui peuvent y accéder'
    
    'yokai-backlist' => ['admin', 'manager'],
    'yokai-add' => ['admin', 'manager'],
    'yokai-update' => ['admin', 'manager'],
    'yokai-create' => ['admin', 'manager'],
    'yokai-modify' => ['admin', 'manager'],
    'yokai-delete' => ['admin', 'manager'],

    
    'user-add' => ['admin'],
    'user-create' => ['admin'],
    'user-update' => ['admin'],
    'user-modify' => ['admin'],
    'user-delete' => ['admin'],
    'user-list' => ['admin']

    // ...
];


// Liste des routes à protéger contre les attaques de type CSRF
// Pour générer les tokens à envoyer aux vues, on peut utiliser la méthode
// generateToken du CoreController
$csrfTokenToCheck = [

    // Routes en POST
    'user-create',
    'yokai-create',
    'yokai-modify',


    // Routes en GET
    'user-delete'
    // etc.
];