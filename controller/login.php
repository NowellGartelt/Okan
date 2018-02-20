<?php
/**
 * ログイン画面表示クラス
 * 
 * ログイン画面を呼び出す
 * 
 * @author NowellGartelt
 * @access public
 * @package controller
 * @name login
 */
if (!isset($_SESSION)) {
    session_start();
    
}

$hat = array(
    'title' => 'Okan：ログイン',
    'description' => '「Okan」は毎日のお金の収入と支出を記録したり、記録した収支を検索・収支レポートを見ることができるサービスです。',
    'keywords' => '収支管理,おかん',
);

if (!$_POST['fromPage']) {
    $login = $_SESSION['login'];
    
} else {
    $login = null;
    
}

// 画面の表示
include '../closet/view/hat.php';
include '../view/login.php';
include '../closet/view/shoes.php';
