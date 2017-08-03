<?php
/**
 * 収入情報削除結果画面表示クラス
 * 
 * 収入情報の削除後の確認画面を呼び出す
 * @access public
 * @package controller
 * @name deleteIncResult
 */

session_start();

include '../model/tools/judgeIsLogined.php';
$judgeIsLoginedAction = new judgeIsLogined();

$loginID = $_SESSION['loginID'];

$id = $_POST['ID'];
$incName = $_POST['incName'];
$income = $_POST['income'];

include '../model/deleteIncByTrans.php';

$result = new deleteIncByTrans();
$deleteIncByTrans = $result -> deleteIncByTrans($loginID, $id);
$incInfo = $deleteIncByTrans;

include '../view/deleteIncResult.php';
?>