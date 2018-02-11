<?php
/**
 * 支払い情報登録処理クラス
 * 
 * 入力された支払い情報を元に、情報の妥当性と登録処理の実施する
 * その結果を元に画面の呼び出しを行う
 * 
 * @author NowellGartelt
 * @access public
 * @package controller
 * @name registPayResult
 */
session_start();

// コントローラの共通処理取得
require_once 'controller.php';
$controller = new controller();

// ログインIDとユーザID取得
$loginID = $controller -> getLoginID();
$userID = $controller -> getUserID();

// 各モジュール使用フラグの取得
$moduleFlg = $controller -> getModuleFlg();
$moduleTaxCalcFlg = $moduleFlg['taxCalcFlg'];
$moduleNameFlg = $moduleFlg['nameFlg'];
$moduleCateFlg = $moduleFlg['cateFlg'];
$modulePayFlg = $moduleFlg['payFlg'];
$moduleMemoFlg = $moduleFlg['memoFlg'];

$payName = $_POST['payName'];
$payment = $_POST['payment'];
$payCategory = $_POST['payCategory'];
$payState = $_POST['payState'];
$payDate = $_POST['payDate'];
$taxFlg = $_POST['taxFlg'];
$tax = $_POST['tax'];
$methodOfPayment = $_POST['methodOfPayment'];

// エラー値の初期化
$_SESSION["errorInputPay"] = "";
$errorInputPay = "";

// 入力値チェック
if ($payName == "" || $payment == "" || $payCategory == "" || $payDate == "" || $payment < 0) {
    if ($payment < 0) {
        // 入力値不正でエラー、入力画面に戻す
        $_SESSION["errorInputPay"] = "minusInput";
    } else {
        // 入力項目不足でエラー、入力画面に戻す
        $_SESSION["errorInputPay"] = "lackInput";
    }
    $errorInputPay = $_SESSION["errorInputPay"];
    
    // ユーザのデフォルト税率設定の取得
    require_once '../model/searchDefTaxByID.php';
    $searchDefTaxByID = new searchDefTaxByID();
    $tax = $searchDefTaxByID -> searchDefTaxByID($userID);
    
    // 支払方法一覧の取得
    require_once '../model/searchMethodOfPayment.php';
    $searchMethodOfPayment = new searchMethodOfPayment();
    $mopList = $searchMethodOfPayment -> getMethodOfPayment();
    
    // 支出カテゴリ一覧の取得
    require_once '../model/searchPayCategory.php';
    $searchPayCategory = new searchPayCategory();
    $cateList = $searchPayCategory -> searchPayCategory($userID);
    
    // 支出カテゴリ数取得
    require_once '../model/searchPayCategoryCount.php';
    $searchPayCategoryCount = new searchPayCategoryCount();
    $cateCount = $searchPayCategoryCount -> searchPayCategoryCount($userID);
    $count = $cateCount[0]["COUNT(*)"];
    
    for ($i = 0; $i < $count; $i++) {
        // カテゴリ登録がなかった場合、空行を取り除く
        if ($cateList[$i]['categoryName'] == false || $cateList[$i]['categoryName'] == "") {
            unset($cateList[$i]);
        }
    }
    
    include '../view/registPayForm.php';
    
} else {
    // スクリプト挿入攻撃、XSS対策
    // パスワードの特殊文字をHTMLエンティティ文字へ変換する。
    $payName = htmlspecialchars($payName, ENT_QUOTES);
    $payment = htmlspecialchars($payment, ENT_QUOTES);
    $payState = htmlspecialchars($payState, ENT_QUOTES);
    $payCategory = htmlspecialchars($payCategory, ENT_QUOTES);
    $taxFlg = htmlspecialchars($taxFlg, ENT_QUOTES);
    $tax = htmlspecialchars($tax, ENT_QUOTES);
 
    $registDate = date("Y-m-d H:i:s");
    
    // 税率が入力されてるとき、自動で税率計算を行う
    // 消費税分を掛け算、小数点以下を切り捨てる
    if ($taxFlg == 1) {
        require_once 'tools/taxCalc.php';
        $taxCalc = new taxCalc();
        $payment = $taxCalc -> taxCalc($payment, $tax);
        
    } else {
        $taxFlg = 0;
        $tax = 0;
        
    }
    
    // 支出情報の登録
    require_once '../model/registPayByTrans.php';
    $registPayByTrans = new registPayByTrans();
    $regiResult = $registPayByTrans -> registPayByTrans($userID, $payName, 
            $payment, $payCategory, $payState, $payDate, $registDate, 
            $taxFlg, $tax, $methodOfPayment);
    
    // 支出の小言取得
    require_once '../model/searchPayKogoto.php';
    $searchPayKogoto = new searchPayKotgoto();
    $kogoto = $searchPayKogoto -> searchPayKogoto($payment);
    
    include '../view/registPayResult.php';

}
$_SESSION["errorInputPay"] = "";
