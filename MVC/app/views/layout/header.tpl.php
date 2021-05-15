 
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <title><?=$title?></title>
    <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
<link rel="manifest" href="site.webmanifest">
    <link href="https://fonts.googleapis.com/css2?family=IM+Fell+Double+Pica&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?=$assetsBaseUri ?>css/reset.css">
    <link rel="stylesheet" href="<?=$assetsBaseUri ?>css/fontawesome/css/all.css">
    <link rel="stylesheet" href="<?=$assetsBaseUri ?>css/style.css">
</head>
<body> 
<div class="bg"></div>
<div class="wrapper">
    <header>
        <div class="div-home display-none"><a class="a-none" href="<?=$router->generate('main-home')?>"><i class="fas fa-torii-gate"></i></a></div>
        <div class="hbg-menu display-none">
            <div class="hbg-item1"></div>
            <div class="hbg-item2"></div>
            <div class="hbg-item3"></div>
        </div>

    <?php   require_once __DIR__ . '/../partials/nav.tpl.php'; ?>