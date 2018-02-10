<?php
/**
 * メンバー情報登録結果画面表示クラス
 * 
 * メンバー情報として入力された値の妥当性チェック、および登録結果を表示する画面を呼び出す
 * 
 * @author NowellGartelt
 * @access public
 * @package controller
 * @name registMemberResult
 */
session_start();

// 入力値の取得
$loginID = $_POST['loginID'];
$password = $_POST['password'];
$name = $_POST['name'];
$question = $_POST['question'];
$answer = $_POST['answer'];
$defTax = $_POST['defTax'];

// Admin権限の有無、現時点では使用しない
$isAdmin = 0;

// 再表示の判断のエラーフラグの初期化。
$errorFlg = false;

// ログインID、パスワード、名前のいずれかの項目が未入力の場合
if ($loginID == "" || $password == "" || $name == "" || $question == "" || $answer == "") {
    // 入力項目不足でエラー、入力画面に戻す
    $errorInputInfo = true;

    $errorFlg = true;
    include '../view/registMemberForm.php';

} else {
    // スクリプト挿入攻撃、XSS対策
    // ログインID、パスワード、名前の特殊文字をHTMLエンティティ文字へ変換する。
    $loginID = htmlspecialchars($loginID, ENT_QUOTES);
    $password = htmlspecialchars($password, ENT_QUOTES);
    $name = htmlspecialchars($name, ENT_QUOTES);
    $question = htmlspecialchars($question, ENT_QUOTES);
    $answer = htmlspecialchars($answer, ENT_QUOTES);
    
    // loginIDチェック、規定の文字数に足りてるか確認
    $checkLengthLoginID = strlen($loginID);
    
    if ($checkLengthLoginID < 6) {
        // ログインIDが5文字以下の場合、入力画面に戻す
        $errorShortLoginID = true;
        
        $errorFlg = true;
        include '../view/registMemberForm.php';
        
    } else {
        // ログインIDチェック、ログインIDが登録済みかどうか確認する。
        require_once '../model/searchMemberByID.php';
        $searchMemberByID = new searchMemberByID();
        $memberInfo = $searchMemberByID -> searchMemberByID($loginID);

        if ($memberInfo !== null) {
            // ログインIDが登録済みだった場合、入力画面に戻す
            $errorRegistedLoginID = true;
        
            $errorFlg = true;
            include '../view/registMemberForm.php';
        
        } else {
            // Passwordチェック、規定の文字数やフォーマットを満たしているか確認
            // 0〜9、a〜z、A〜Z、記号(!, ?, -, _, @, +, &)からそれぞれ1文字づつ使用すること
            // 計6文字以上であること
            $checkPassworCondition = preg_match('/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[!?-_@+&])[0-9a-zA-Z!?-_@+&]{6,}$/', $password);
            
            if (!$checkPassworCondition) {
                // パスワードチェック、パスワードが条件に合致してなかった場合、入力画面に戻す
                $errorPasswordCondition = true;
                
                $errorFlg = true;
                include '../view/registMemberForm.php';
                
            } else {
                // パスワード暗号化
                $password = password_hash($password, PASSWORD_DEFAULT);
 
                // 登録日時取得
                $registDate = date("Y-m-d H:i:s");

                // メンバー情報登録処理
                require_once '../model/registMember.php';
                $registMember = new registMember();
                $regMemberResult = $registMember -> registMember($loginID, $password, $name, $registDate, 
                        $isAdmin, $question, $answer, $defTax);
                
                // ユーザID取得処理
                require_once '../model/searchMemberIDByID.php';
                $searchMemberIDByID = new searchMemberIDByID();
                $userInfo = $searchMemberIDByID -> searchMemberIDByID($loginID);
                $userID = $userInfo['userID'];
                
                // 支出カテゴリ初期登録処理
                require_once '../model/registPayCategory.php';
                $registPayCategory = new registpayCategory();
                $regPayCategoryResult = $registPayCategory -> registPayCategory($userID, $registDate);
                
                // 収入カテゴリ初期登録処理
                require_once '../model/registIncCategory.php';
                $registIncCategory = new registIncCategory();
                $regIncCategoryResult = $registIncCategory -> registIncCategory($userID, $registDate);
                
                include '../view/registMemberResult.php';
                
            }
        }
    }
}
