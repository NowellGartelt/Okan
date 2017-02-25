<!-- controller/updateIncForm.php -->
<?php
session_start();

include '../model/tools/judgeIsLogined.php';
$judgeIsLoginedAction = new judgeIsLogined();

$loginID = $_SESSION['loginID'];

$id = $_POST['ID'];

include '../model/searchIncByID.php';

$result = new searchIncByID();
$searchIncByID = $result -> searchIncByID($loginID, $id);
$incInfo = $searchIncByID;

include '../view/updateIncForm.php';
?>