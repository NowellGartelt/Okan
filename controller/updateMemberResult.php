<?php
/**
 * メンバー情報更新結果画面表示クラス
 * 
 * メンバー情報更新時、入力された値の妥当性チェック、および更新結果画面を呼び出す
 * 
 * @author NowellGartelt
 * @access public
 * @package controller
 * @name updateMemberResult
 * 
 */
session_start();

// コントローラの共通処理取得
require_once 'controller.php';
$controller = new controller();

// ログインIDとユーザID取得
$loginID = $controller -> getLoginID();
$userID = $controller -> getUserID();

// 入力情報の取得
$userID = $_POST['userID'];
$nameAfter = $_POST['name'];
$logIDAfter = $_POST['loginID'];
$passwordAfter = $_POST['password'];
$taxAfter = $_POST['tax'];

// 現在の登録情報の取得
$nameBefore = $_POST['nameBefore'];
$logIDBefore = $_POST['loginIDBefore'];
$passwordBefore = $_POST['passwordBefore'];
$taxBefore = $_POST['taxBefore'];

// 変更実施の有無のフラグリセット
$errFlg = false;
$chkChgNameFlg = false;
$chgNameFlg = false;
$chkChgLogIDFlg = false;
$chgLogIDFlg = false;
$chkChgPassFlg = false;
$chgPassFlg = false;
$chkChgTaxFlg = false;
$chgTaxFlg = false;

$errNoStatusChg = false;
$errShortLoginID = false;
$errRegistedLoginID = false;
$errPassCondition = false;
$errTaxRange = false;

$errInput = "";
$errFlg = false;

// 移動元ページの設定
$fromPage = "updateMemberResult";
$controller -> setFromPage($fromPage);

// 名前、ログインID、パスワードのいずれも変更がなかった場合
// 変更なしエラーで入力画面に戻す
if ($nameAfter == "" && $logIDAfter == "" && $passwordAfter == "") {
    $errInput = "noStatusChg";
    $errFlg = true;
    
    require_once 'updateMemberForm.php';
    
} else {
    // スクリプト挿入攻撃、XSS対策
    // 特殊文字をHTMLエンティティ文字へ変換する。
    $nameAfter = htmlspecialchars($nameAfter, ENT_QUOTES);
    $logIDAfter = htmlspecialchars($logIDAfter, ENT_QUOTES);
    $passwordAfter = htmlspecialchars($passwordAfter, ENT_QUOTES);
    $taxAfter = htmlspecialchars($taxAfter, ENT_QUOTES);
    
    // 新名前と旧名前が一致しない場合
    // 名前変更チェックフラグを立てる
    if ($nameAfter !== "" && $nameAfter !== $nameBefore) {
        $chkChgNameFlg = true;        
    }
    // 新ログインIDと旧ログインIDが一致しない場合
    // ログインID変更チェックフラグを立てる
    if ($logIDAfter !== "" && $logIDAfter !== $logIDBefore) {
        $chkChgLogIDFlg = true;
    }
    
    // パスワードの変更の有無の確認
    // 新パスワードと旧パスワードが一致すうるかどうかを確認
    $passwordChk = password_verify($passwordAfter, $passwordBefore);
    
    // 新パスワードと旧パスワードが一致しない場合
    // パスワード変更チェックフラグを立てる
    if ($passwordAfter !== "" && !$passwordChk) {
        $chkChgPassFlg = true;
    }
    
    // 新税率と旧税率が一致する場合、もしくは変更前が
    // 税率変更チェックフラグを立てる
    if ($taxAfter !== $taxBefore) {
        $chkChgTaxFlg = true;
    } elseif (($taxAfter == 0 || $taxAfter == "") && ($taxBefore == 0 || $taxBefore == "")) {
        $chkChgTaxFlg = false;
    }
    
    var_dump($taxBefore);
    var_dump($taxAfter);
    var_dump($chkChgTaxFlg);
    
    // フラグがひとつも立っていない場合
    // 変更なしエラーで入力画面に戻す
    if ($chkChgNameFlg == false && $chkChgLogIDFlg == false 
            && $chkChgPassFlg == false && $chkChgTaxFlg == false) {
        $errInput = "noStatusChg";
        $errFlg = true;
        
        require_once 'updateMemberForm.php';
        
    // フラグがひとつ以上立っている場合
    } else {
        // 名前変更チェックフラグが立っている場合
        // 名前変更処理フラグを立てる
        if ($chkChgNameFlg == true) {
            $chgNameFlg = true;
        }
        
        // ログインID変更チェックフラグが立っている場合
        // ログインID妥当性チェックを行う
        if ($chkChgLogIDFlg == true) {
            $chkLengthLoginID = strlen($logIDAfter);
            
            // ログインIDチェック、ログインIDが5文字以下の場合、エラーフラグを立てる
            if ($chkLengthLoginID < 6 || $chkLengthLoginID >10) {
                $errInput = "errLengthLoginID";
                $errFlg = true;
            
            } else {
                // ログインIDチェック、ログインIDが登録済みかどうか確認する。
                require_once '../model/searchMemberByID.php';
                $result = new searchMemberByID();
                $memberInfo = $searchMemberByID-> searchMemberByID($logIDAfter);
            
                // ログインIDが登録済みだった場合、エラーフラグを立てる
                if ($memberInfo !== null) {
                    $errInput = "registedLoginID";
                    $errFlg = true;
                    
                // 妥当性チェックをクリアした場合
                // ログインID変更処理フラグを立てる
                } else {
                    $chgLogIDFlg = true;
                    
                }
            }
        }
        // パスワード変更チェックフラグが立っている場合
        // パスワードの妥当性チェックを行う
        if ($chkChgPassFlg == true) {
            // パスワードチェック、規定の文字数やフォーマットを満たしているか確認
            // 0〜9、a〜z、A〜Z、記号(!, ?, -, _, @, +, &)からそれぞれ1文字づつ使用すること
            // 計6文字以上であること
            $chkPassworCondition = preg_match(
                    '/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[!?-_@+&])[0-9a-zA-Z!?-_@+&]{6,}$/', 
                    $passwordAfter
                    );
            
            // パスワードが条件に合致してなかった場合、エラーフラグを立てる
            if (!$chkPassworCondition) {
                $errInput = "passCondition";
                $errFlg = true;

            // 妥当性チェックをクリアした場合、パスワード変更処理フラグを立てる
            } else {
                $chgPassFlg = true;
                $passwordAfter = password_hash($passwordAfter, PASSWORD_DEFAULT);
                
            }
        }
        // 税率変更チェックフラグが立っている場合
        // 税率チェックおよびアップデート準備をする
        if ($chkChgTaxFlg == true) {
            // 税率が0-100か確認、NGならエラー
            if ($taxAfter < 0 || $taxAfter >100) {
                $errInput = "errTaxRange";
                $errFlg = true;
                
            } else {
                $chgTaxFlg = true;
                
                // 税率が空欄の場合、0をセット
                if ($taxAfter == "") {
                    $taxAfter = 0;
                    
                }
            }
        }
    }
}

// エラーフラグが立っている場合、エラーで入力画面へ戻す
if ($errFlg == true) {
    require_once 'updateMemberForm.php';
    
// エラーフラグが立っていない場合、ユーザ情報変更処理を行う
} else {
    // 更新日時取得
    $updateDate = date("Y-m-d H:i:s");
    
    // ユーザー情報変更処理呼び出し
    require_once '../model/updateMember.php';
    $updateMember= new updateMember();
    $updResult = $updateMember -> updateMember(
            $nameAfter, $logIDAfter, $passwordAfter, $taxAfter, 
            $chgNameFlg, $chgLogIDFlg, $chgPassFlg, $chgTaxFlg, 
            $userID, $logIDBefore, $updateDate
            );
            
    if ($chgLogIDFlg == true) {
        $_SESSION['loginID'] = $logIDAfter;
        $loginID = $logIDAfter;
        
    }
    
    include '../view/updateMemberResult.php';
    
}
