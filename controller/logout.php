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
session_start();

$_SESSION["login"] = null;

session_destroy();

include '../view/logout.php';
