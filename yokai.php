
<?php
include 'inc/data.php';
$yokai=$_GET["yokai"];
$title= $yokais[$yokai]["nom"];
include "inc/head.tpl.php";
include 'inc/hbg-home.tpl.php';
include 'inc/nav.tpl.php';
include 'inc/yokai.tpl.php';
include 'inc/footer.tpl.php';
?>