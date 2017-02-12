<!-- controller/logout.php -->
<?php
session_start();

$_SESSION["login"] = null;

session_destroy();

include '../view/logout.php';
?>