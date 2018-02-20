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
if (!isset($_SESSION)) {
    session_start();
    
}

// コントローラの共通処理取得
require_once 'controller.php';
$controller = new controller();

// ログインIDとユーザID取得
$loginID = $controller -> getLoginID();
$userID = $controller -> getUserID();

// 各モジュール使用フラグの取得
$modulePayFlg = $controller -> getPayModuleFlg();
$moduleTaxCalcFlg = $modulePayFlg['taxCalcFlg'];
$modulePayNameFlg = $modulePayFlg['payNameFlg'];
$modulePayCateFlg = $modulePayFlg['payCateFlg'];
$modulePaymentFlg = $modulePayFlg['paymentFlg'];
$modulePayMemoFlg = $modulePayFlg['payMemoFlg'];

// 値の取得
$payName = $_POST['payName'];
$payment = $_POST['payment'];
$payCategory = $_POST['payCategory'];
$payState = $_POST['payState'];
$payDate = $_POST['payDate'];
$taxFlg = $_POST['taxFlg'];
$tax = $_POST['tax'];
$methodOfPayment = $_POST['methodOfPayment'];

// エラー値の初期化
$errFlg = false;
$errInput = "";
$errGetInfo = "";

// 移動元ページの設定
$fromPage = "registPayResult";
$controller -> setFromPage($fromPage);

// 入力値チェック
if ($payment == "" || $payDate == "" || $payment < 0) {
    if ($payment < 0) {
        // 入力値不正でエラー、入力画面に戻す
        $errFlg = true;
        $errInput = "minusInput";
        
    } else {
        // 入力項目不足でエラー、入力画面に戻す
        $errFlg = true;
        $errInput = "lackInput";
        
    }
    
    // 入力画面呼び出し
    require_once 'registPayForm.php';
    
} else {
    // スクリプト挿入攻撃、XSS対策
    // パスワードの特殊文字をHTMLエンティティ文字へ変換する。
    $payName = htmlspecialchars($payName, ENT_QUOTES);
    $payment = htmlspecialchars($payment, ENT_QUOTES);
    $payState = htmlspecialchars($payState, ENT_QUOTES);
    $payCategory = htmlspecialchars($payCategory, ENT_QUOTES);
    $taxFlg = htmlspecialchars($taxFlg, ENT_QUOTES);
    $tax = htmlspecialchars($tax, ENT_QUOTES);
    
    // null値が入力された場合
    if ($payName == null) {
        $payName = "";
    }
    if ($payState == null) {
        $payState = "";
    }
    if ($payCategory == null) {
        $payCategory = 0;
    }
    if ($tax == null) {
        $tax = 0;
    }
    if ($methodOfPayment == null) {
        $methodOfPayment = 0;
    }
    
    // 登録日時取得
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
    
    // 支出カテゴリID取得
    require_once '../model/searchPayCategoryByID.php';
    $searchPayCategoryByID = new searchPayCategoryByID();
    $cateList = $searchPayCategoryByID -> searchPayCategoryByID((int)($userID), $payCategory);
    $cateID = $cateList['categoryID'];
    $DBConnect = $controller -> getDBConnectResult();
    
    // カテゴリ名取得に失敗したとき
    if ($DBConnect == "failed") {
        $errFlg = true;
        $errGetInfo = "emptyProperties";
        
    } else {
        // 支出情報の登録
        require_once '../model/registPayByTrans.php';
        $registPayByTrans = new registPayByTrans();
        $regiResult = $registPayByTrans -> registPayByTrans($userID, $payName, 
                $payment, $cateID, $payState, $payDate, $registDate, 
                $taxFlg, $tax, $methodOfPayment);
        $DBConnect = $controller -> getDBConnectResult();
        
        // 支出情報の登録に失敗したとき
        if ($DBConnect == "failed" || $regiResult == false) {
            $errFlg = true;
            $errGetInfo = "errRegist";
            
        } else {
            // 支出の小言取得
            require_once '../model/searchPayKogoto.php';
            $searchPayKogoto = new searchPayKotgoto();
            $kogoto = $searchPayKogoto -> searchPayKogoto($payment);
            
        }
    }
    
    // エラーがあった場合
    if ($errFlg == true) {
        // エラー画面表示
        if ($errGetInfo !== "") {
            include '../view/errRegistResult.php';
            
        }
    } else {
        // 画面表示
        include '../view/registPayResult.php';
    
    }
}
