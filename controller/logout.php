<?php
/**
 * ログアウト処理クラス
 * 
 * セッションを破棄し、ログアウト画面を表示する
 * 
 * @author NowellGartelt
 * @access public
 * @package controller
 * @neme logout
 */
if (!isset($_SESSION)) {
    session_start();
    
}

$_SESSION["login"] = null;

// セッション破棄
session_destroy();

// 画面の表示
include '../view/logout.php';
