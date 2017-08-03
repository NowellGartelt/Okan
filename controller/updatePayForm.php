<?php
/**
 * 支払い情報更新画面表示クラス
 * 
 * 登録済み支払い情報を呼び出し、支払い情報更新画面を呼び出す
 * 
 * @access public
 * @package controller
 * @name updatePayForm
 */

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