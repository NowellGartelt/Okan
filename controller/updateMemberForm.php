<?php
/**
 * メンバー情報更新画面表示クラス
 * 
 * メンバー情報の更新時、情報入力のための画面を呼び出す
 * 
 * @access public
 * @package controller
 * @name updateMemberForm
 */

session_start();

include '../model/tools/judgeIsLogined.php';
$judgeIsLoginedAction = new judgeIsLogined();

$loginID = $_SESSION['loginID'];

include '../model/searchMemberByID.php';

// ログイン中のメンバー情報の取得
$result = new searchMemberByID($loginID);
$searchMemberByID = $result -> searchMemberByID($loginID);
$memberInfo = $searchMemberByID;

include '../view/updateMemberForm.php';
?>