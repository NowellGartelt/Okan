<?php
/**
* 収入情報削除確認画面表示クラス
* 
* 収入情報の削除前の確認として、削除対象の情報を表示する画面を呼び出す
* 
* @author NowellGartelt
* @access public
* @package controller
* @name deleteIncForm
*/
session_start();

// コントローラの共通処理取得
require_once 'controller.php';
$controller = new controller();

// ログインIDとユーザID取得
$loginID = $controller -> getLoginID();
$userID = $controller -> getUserID();

$id = $_POST['ID'];

// 収入情報の取得
require_once '../model/searchIncByID.php';
$searchIncByID = new searchIncByID();
$incList = $searchIncByID -> searchIncByID($userID, $id);

// 使ったものの名前が空のとき、(登録なし)を入れる
if ($incList['incName'] == "") {
    $incList['incName'] = "(登録なし)";
}
// 一言メモが空のとき、(登録なし)を入れる
if ($incList['incState'] == "") {
    $incList['incState'] = "(登録なし)";
}
// カテゴリ名が空のとき、(登録なし)を入れる
if ($incList['categoryName'] == "") {
    $incList['categoryName'] = "(登録なし)";
}

$incInfoDateYear = mb_substr($incList['incDate'], 0, 4);
$incInfoDateMonth = mb_substr($incList['incDate'], 5, 2);
$incInfoDateDay = mb_substr($incList['incDate'], 8, 2);

include '../view/deleteIncForm.php';
