<?php
/**
* 収入情報削除確認画面表示クラス
* 
* 収入情報の削除前の確認として、削除対象の情報を表示する画面を呼び出す
* 
* @access public
* @package controller
* @name deleteIncForm
*/

session_start();

include '../model/tools/judgeIsLogined.php';
$judgeIsLoginedAction = new judgeIsLogined();

$loginID = $_SESSION['loginID'];

$id = $_POST['ID'];

include '../model/searchIncByID.php';

$result = new searchIncByID();
$searchIncByID = $result -> searchIncByID($loginID, $id);
$incInfo = $searchIncByID;

$incInfoDateYear = mb_substr($incInfo['incDate'], 0, 4);
$incInfoDateMonth = mb_substr($incInfo['incDate'], 5, 2);
$incInfoDateDay = mb_substr($incInfo['incDate'], 8, 2);

include '../view/deleteIncForm.php';
?>