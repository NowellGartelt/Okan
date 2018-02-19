<?php
/**
 * メンバー情報更新画面表示クラス
 * 
 * メンバー情報の更新時、情報入力のための画面を呼び出す
 * 
 * @author NowellGartelt
 * @access public
 * @package controller
 * @name updateMemberForm
 */
session_start();

// コントローラの共通処理取得
require_once 'controller.php';
$controller = new controller();

// ログインIDとユーザID取得
$loginID = $controller -> getLoginID();
$userID = $controller -> getUserID();
$fromPage = $controller -> getFromPage(); 

if ($fromPage !== "updateMemberResult") {
    $errInput = "";
    $errFlg = false;
    
}

// 移動元ページの設定
$fromPage = "updateMemberForm";
$controller -> setFromPage($fromPage);

// ログイン中のメンバー情報の取得
require_once '../model/searchMemberByMemberID.php';
$searchMemberByMemberID = new searchMemberByMemberID();
$memberInfo = $searchMemberByMemberID -> searchMemberByMemberID($userID);
$DBConnect = $controller -> getDBConnectResult();

if ($DBConnect == false) {
    $errFlg = true;
    $errGetInfo= "emptyList";
    
} else {
    
}
// 画面の表示
include '../view/updateMemberForm.php';
