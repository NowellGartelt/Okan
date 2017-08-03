<?php
/**
 * 収入更新情報入力画面表示クラス
 * 
 * 収入情報を更新時、情報を入力する画面を呼び出す
 * 
 * @access public
 * @package controller
 * @name updateIncForm
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

include '../view/updateIncForm.php';
?>