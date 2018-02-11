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
session_start();

// コントローラの共通処理取得
require_once 'controller.php';
$controller = new controller();

// ログインIDとユーザID取得
$loginID = $controller -> getLoginID();
$userID = $controller -> getUserID();

$id = $_POST['ID'];
$incName = $_POST['incName'];
$incDate = $_POST['incDate'];
$income = $_POST['income'];

// 収入情報の削除
require_once '../model/deleteIncByTrans.php';
$deleteIncByTrans = new deleteIncByTrans();
$incInfo = $deleteIncByTrans -> deleteIncByTrans($userID, $id);

include '../view/deleteIncResult.php';
