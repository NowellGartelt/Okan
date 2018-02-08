<?php
/**
 * 支払い情報更新結果画面表示クラス
 * 
 * 変更された値を元に、入力値の妥当性検証と情報の更新、更新完了画面の呼び出しをする
 * 
 * @author NowellGartelt
 * @access public
 * @package controller
 * @name updatePayResult
 */
session_start();

// コントローラの共通処理取得
require_once 'controller.php';
$controller = new controller();

// ログインIDとユーザID取得
$loginID = $controller -> getLoginID();
$userID = $controller -> getUserID();

$payName = $_POST['payName'];
$paymentAfter = $_POST['payment'];
$payCategory = $_POST['payCategory'];
$payDate = $_POST['payDate'];
$payState = $_POST['payState'];
$id = $_POST['ID'];
$taxFlgAfter = $_POST['taxFlg'];
$taxAfter = $_POST['tax'];
$methodOfPayment = $_POST['methodOfPayment'];

// エラー値の初期化
$_SESSION["errorInputPay"] = "";
$errorInputPay = "";

// フラグの初期化
$taxCalcFlg = "";
$noChangeFlg = "";

// 入力値チェック
if ($payName == "" || $paymentAfter == "" || $payCategory == "" 
        || $payDate == "" || $paymentAfter < 0) {
    if ($paymentAfter < 0) {
        // 入力値不正でエラー、入力画面に戻す
        $_SESSION["errorInputPay"] = "minusInput";
    } else {
        // 入力項目不足でエラー、入力画面に戻す
        $_SESSION["errorInputPay"] = "lackInput";
    }
    $errorInputPay = $_SESSION["errorInputPay"];
    
    // 支出情報の取得
    require_once '../model/searchPayByID.php';
    $searchPayByID = new searchPayByID();
    $payInfo = $searchPayByID -> searchPayByID($loginID, $id);
    
    // 支払方法一覧の取得
    require_once '../model/searchMethodOfPayment.php';
    $searchMethodOfPayment = new searchMethodOfPayment();
    $mopList = $searchMethodOfPayment -> getMethodOfPayment();
    
    include '../view/updatePayForm.php';
    
} else {
    // スクリプト挿入攻撃、XSS対策
    // パスワードの特殊文字をHTMLエンティティ文字へ変換する。
    $payName = htmlspecialchars($payName, ENT_QUOTES);
    $paymentAfter = htmlspecialchars($paymentAfter, ENT_QUOTES);
    $payCategory = htmlspecialchars($payCategory, ENT_QUOTES);
    $payState = htmlspecialchars($payState, ENT_QUOTES);
    $taxFlgAfter = htmlspecialchars($taxFlgAfter, ENT_QUOTES);
    $taxAfter = htmlspecialchars($taxAfter, ENT_QUOTES);

    // 税率が入力されてるとき、自動で税率計算を行う
    require_once '../model/searchPayByID.php';
    $searchPayByID = new searchPayByID();
    $payInfoBefore = $searchPayByID -> searchPayByID($loginID, $id);
    
    $taxFlgBefore = $payInfoBefore['taxFlg'];
    $taxBefore = $payInfoBefore['tax'];
    
    // 税込フラグが更新前はOFF、更新後はONのとき、入力された税率で計算して支払い金額を更新
    if ($taxFlgBefore == 0 && $taxFlgAfter == 1) {
        $taxCalcFlg = true;
        
    // 税込フラグが更新前はON、更新後もONのとき、入力された税率で再計算して支払い金額を更新
    } elseif ($taxFlgBefore == 1 && $taxFlgAfter == 1) {
        // 更新前の支払い金額の取得
        $paymentBefore = $payInfoBefore['payment'];
        
        // 税率だけ変更になったとき
        if ($taxBefore !== $taxAfter && $paymentBefore == $paymentAfter) {
            // 新しい税率で再計算
            $paymentAfter = (int) ceil($paymentAfter / (1 + ($taxBefore / 100)));
            $taxCalcFlg = true;
            
        // 金額のみ変更された場合と、税率も金額も変更された場合
        } elseif (($taxBefore !== $taxAfter && $paymentBefore !== $paymentAfter)
                || ($taxBefore == $taxAfter && $paymentBefore !== $paymentAfter)) {
            // 新しい税率と金額で再計算する
            $taxCalcFlg = true;
            
        } else {
            $noChangeFlg = true;
            
        }
    }
        
    // 税率が入力されてるとき、自動で税率計算を行う
    // 消費税分を掛け算、小数点以下を切り捨てる
    if ($taxCalcFlg == true) {
        require_once 'tools/taxCalc.php';
        $taxCalc = new taxCalc();
        $paymentAfter = $taxCalc -> taxCalc($paymentAfter, $taxAfter);
        
    } elseif ($noChangeFlg !== true) {
        // 税別フラグのセット
        $taxFlgAfter = 0;
        $taxAfter = 0;
        
    }
    
    // 支出情報の更新
    require_once '../model/updatePayByTrans.php';
    $updatePayByTrans = new updatePayByTrans();
    $updResult = $updatePayByTrans -> updatePayByTrans($loginID, $payName,
            $paymentAfter, $payCategory, $payDate, $payState, $id,
            $taxFlgAfter, $taxAfter, $methodOfPayment);
    
    include '../view/updatePayResult.php';
}
