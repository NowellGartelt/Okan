<!-- controller/updatePayForm.php -->
<?php
session_start();

include '../model/tools/judgeIsLogined.php';
$judgeIsLoginedAction = new judgeIsLogined();

$loginID = $_SESSION['loginID'];

$id = $_POST['ID'];

include '../model/searchPayByID.php';

$result = new searchPayByID();
$searchPayByID = $result -> searchPayByID($loginID, $id);
$payInfo = $searchPayByID;

include '../view/updatePayForm.php';
?>