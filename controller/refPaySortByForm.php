<?php
/**
 * まとめて支払い検索選択画面表示クラス
 * 
 * まとめて支払い検索の日ごと、月ごとを選択する画面を呼び出す
 * 
 * @access public
 * @package controller
 * @name refPaySortByForm
 */

session_start();

include '../model/tools/judgeIsLogined.php';
$judgeIsLoginedAction = new judgeIsLogined();

$loginID = $_SESSION['loginID'];

include '../view/refPaySortByForm.php';
?>