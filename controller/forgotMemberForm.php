<?php
/**
 * パスワード忘れ時メンバー情報検索条件入力画面表示クラス
 * 
 * パスワード忘れの場合に、メンバー情報検索のために入力画面を呼び出す
 * 
 * @author NowellGartelt
 * @access public
 * @package controller
 * @name forgotMemberForm
 */
session_start();

if (!$errorFlg) {
    $errorNoInput = false;
    $errorNoRegistration = false;
    $errorQuestionNotMatch = false;
    $errorAnswerNotMatch = false;
    
}

include '../view/forgotMemberForm.php';
