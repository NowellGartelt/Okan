<!-- controller/deleteIncResult.php -->
<?php
session_start();

include '../model/tools/judgeIsLogined.php';
$judgeIsLoginedAction = new judgeIsLogined();

$loginID = $_SESSION['loginID'];

$id = $_POST['ID'];
$incName = $_POST['incName'];
$income = $_POST['income'];

include '../model/deleteIncByTrans.php';

$result = new deleteIncByTrans();
$deleteIncByTrans =
$result -> deleteIncByTrans($loginID, $id);
$incInfo = $deleteIncByTrans;

include '../view/deleteIncResult.php';
?>