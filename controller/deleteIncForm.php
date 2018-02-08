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
$incInfo = $searchIncByID -> searchIncByID($loginID, $id);

$incInfoDateYear = mb_substr($incInfo['incDate'], 0, 4);
$incInfoDateMonth = mb_substr($incInfo['incDate'], 5, 2);
$incInfoDateDay = mb_substr($incInfo['incDate'], 8, 2);

include '../view/deleteIncForm.php';
