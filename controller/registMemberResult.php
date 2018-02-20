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
if (!isset($_SESSION)) {
    session_start();
    
}

// 入力値の取得
$loginID = $_POST['loginID'];
$password = $_POST['password'];
$name = $_POST['name'];
$question = $_POST['question'];
$answer = $_POST['answer'];
$defTax = $_POST['defTax'];

// Admin権限の有無、現時点では使用しない
$isAdmin = "0";

// 再表示の判断のエラーフラグの初期化。
$errFlg = false;

// ログインID、パスワード、名前のいずれかの項目が未入力の場合
if ($loginID == "" || $password == "" || $name == "" || $question == "" || $answer == "") {
    // 入力項目不足でエラー、入力画面に戻す
    $errFlg = true;
    $errInput = "lackInput";

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
    
    if ($checkLengthLoginID < 6 || $checkLengthLoginID > 10) {
        // ログインIDが5文字以下11文字以上の場合、入力画面に戻す
        $errFlg = true;
        $errInput = "errLengthLoginID";
        
    } elseif ($defTax < 0 || $defTax > 100) {
        // デフォルト税率の値が不正の場合、入力画面に戻す
        $errFlg = true;
        $errInput = "errTaxRange";
        
    } else {
        // ログインIDチェック、ログインIDが登録済みかどうか確認する。
        require_once '../model/searchMemberByID.php';
        $searchMemberByID = new searchMemberByID();
        $memberInfo = $searchMemberByID -> searchMemberByID($loginID);
        $DBConnect = $_SESSION['databaseConnect'];
        
        // DB接続に失敗した場合
        if ($DBConnect == "failed") {
            $errFlg = true;
            $errGetInfo = "emptyList";
            
        } else {
            if ($memberInfo !== null) {
                // ログインIDが登録済みだった場合、入力画面に戻す
                $errFlg = true;
                $errInput = "registedLoginID";
                
            } else {
                // Passwordチェック、規定の文字数やフォーマットを満たしているか確認
                // 0〜9、a〜z、A〜Z、記号(!, ?, -, _, @, +, &)からそれぞれ1文字づつ使用すること
                // 計6文字以上であること
                $checkPassworCondition = preg_match('/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[!?-_@+&])[0-9a-zA-Z!?-_@+&]{6,}$/', $password);
                
                if (!$checkPassworCondition) {
                    // パスワードチェック、パスワードが条件に合致してなかった場合、入力画面に戻す
                    $errFlg = true;
                    $errInput = "passwordCondition";
                    
                }
            }
        }
    }
}

if ($errFlg == true && $errInput !== "") {
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
    $DBConnect = $_SESSION['databaseConnect'];
    
    // DB接続に失敗した場合
    if ($DBConnect == "failed") {
        $errFlg = true;
        $errResult = "failedRegist";
        
    } else {
        // ユーザID取得処理
        $searchMemberIDByID = new searchMemberByID();
        $userInfo = $searchMemberIDByID -> searchMemberByID($loginID);
        $userID = $userInfo['userID'];
        $DBConnect = $_SESSION['databaseConnect'];
        
        // DB接続に失敗した場合
        if ($DBConnect == "failed") {
            $errFlg = true;
            $errResult = "failedRegist";
            
        } else {
            // 支出カテゴリ初期登録処理
            require_once '../model/registPayCategory.php';
            $registPayCategory = new registpayCategory();
            $regPayCategoryResult = $registPayCategory -> registPayCategory($userID, $registDate);
            $DBConnect = $_SESSION['databaseConnect'];
            
            // DB接続に失敗した場合
            if ($DBConnect == "failed") {
                $errFlg = true;
                $errResult = "failedRegist";
                
            } else {
                // 収入カテゴリ初期登録処理
                require_once '../model/registIncCategory.php';
                $registIncCategory = new registIncCategory();
                $regIncCategoryResult = $registIncCategory -> registIncCategory($userID, $registDate);
                $DBConnect = $_SESSION['databaseConnect'];
                
                // DB接続に失敗した場合
                if ($DBConnect == "failed") {
                    $errFlg = true;
                    $errResult = "failedRegist";
                    
                }
            }
        }
    }
    
    // エラーがあった場合
    if ($errFlg == true) {
        // エラー画面の表示
        if ($errResult !== "") {
            include '../view/errRegistResult.php';
            
        }
    } else {
        // 画面の表示
        include '../view/registMemberResult.php';
    
    }
}
