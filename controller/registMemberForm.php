<?php
/**
 * メンバー情報登録画面表示クラス
 * 
 * メンバー情報を入力する画面を呼び出す
 * 
 * @author NowellGartelt
 * @access public
 * @package contoller
 * @name registPayForm
 */
session_start();

// 入力内容エラーによる再表示ではない場合、エラーフラグをすべてリセットする。
if (!$errFlg) {
    $errInput = "";
    
}

include '../view/registMemberForm.php';
