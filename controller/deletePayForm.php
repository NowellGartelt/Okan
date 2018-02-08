<?php
/**
 * 支払い情報削除確認画面表示クラス
 * 
 * 支払い情報削除前確認のため、支払い情報削除確認画面を呼び出す
 * 
 * @author NowellGartelt
 * @access public
 * @package controller
 * @name deletePayForm
 */
session_start();

// コントローラの共通処理取得
require_once 'controller.php';
$controller = new controller();

// ログインIDとユーザID取得
$loginID = $controller -> getLoginID();
$userID = $controller -> getUserID();

$id = $_POST['ID'];

// 支出情報の取得
require_once '../model/searchPayByID.php';
$searchPayByID = new searchPayByID();
$payInfo = $searchPayByID -> searchPayByID($loginID, $id);

$payInfoDateYear = mb_substr($payInfo['payDate'], 0, 4);
$payInfoDateMonth = mb_substr($payInfo['payDate'], 5, 2);
$payInfoDateDay = mb_substr($payInfo['payDate'], 8, 2);

include '../view/deletePayForm.php';
