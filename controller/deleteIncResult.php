<?php
/**
 * 収入情報削除結果画面表示クラス
 * 
 * 収入情報の削除後の確認画面を呼び出す
 * 
 * @author NowellGartelt
 * @access public
 * @package controller
 * @name deleteIncResult
 */
/* controller準備ここから */

session_start();

// コントローラの共通処理取得
require_once 'controller.php';
$controller = new controller();

// ログインIDとユーザID取得
$loginID = $controller -> getLoginID();
$userID = $controller -> getUserID();

// 値の取得
$id = $_POST['ID'];
$incName = $_POST['incName'];
$incDate = $_POST['incDate'];
$income = $_POST['income'];

// 移動元ページの設定
$fromPage = "deleteIncResult";
$controller -> setFromPage($fromPage);

/* controller準備ここまで */

/* 画面表示準備ここから */

// 収入情報の削除
require_once '../model/deleteIncByTrans.php';
$deleteIncByTrans = new deleteIncByTrans();
$incInfo = $deleteIncByTrans -> deleteIncByTrans($userID, $id);

// 画面表示
include '../view/deleteIncResult.php';

/* 画面表示準備ここまで */
