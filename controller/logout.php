<!-- controller/logout.php -->
<?php
session_start();

$_SESSION["login"] = "";

session_destroy();

include '../view/logout.php';
?>