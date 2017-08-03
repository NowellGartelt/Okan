<?php
/**
 * 支払い情報削除結果画面表示クラス
 * 
 * 支払い情報の削除処理を行い、削除結果を表示する
 * 
 * @access public
 * @package controller
 * @name deletePayResult
 */

session_start();

include '../model/tools/judgeIsLogined.php';
$judgeIsLoginedAction = new judgeIsLogined();

$loginID = $_SESSION['loginID'];

$id = $_POST['ID'];
$payName = $_POST['payName'];
$payment = $_POST['payment'];

include '../model/deletePayByTrans.php';

$result = new deletePayByTrans($loginID, $id);
$deletePayByTrans = $result -> deletePayByTrans($loginID, $id);
$payInfo = $deletePayByTrans;

include '../view/deletePayResult.php';
?>