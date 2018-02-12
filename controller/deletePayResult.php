<?php
/**
 * 支払い情報削除結果画面表示クラス
 * 
 * 支払い情報の削除処理を行い、削除結果を表示する
 * 
 * @author NowellGartelt
 * @access public
 * @package controller
 * @name deletePayResult
 */
session_start();

// コントローラの共通処理取得
require_once 'controller.php';
$controller = new controller();

// ログインIDとユーザID取得
$loginID = $controller -> getLoginID();
$userID = $controller -> getUserID();

$id = $_POST['ID'];
$payDate = $_POST['payDate'];
$payName = $_POST['payName'];
$payment = $_POST['payment'];

// 支出情報の削除
require_once '../model/deletePayByTrans.php';
$deletePayByTrans = new deletePayByTrans();
$payInfo = $deletePayByTrans -> deletePayByTrans($userID, $id);

include '../view/deletePayResult.php';
