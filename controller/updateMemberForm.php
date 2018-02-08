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

// ログイン中のメンバー情報の取得
require_once '../model/searchMemberByID.php';
$searchMemberByID = new searchMemberByID($loginID);
$memberInfo = $searchMemberByID -> searchMemberByID($loginID);

include '../view/updateMemberForm.php';
