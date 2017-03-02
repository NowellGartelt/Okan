<!-- controller/updateMemberResult.php -->
<?php
session_start();

include '../model/tools/judgeIsLogined.php';
$judgeIsLoginedAction = new judgeIsLogined();

$loginID = $_SESSION['loginID'];

// 入力情報の取得
$userID = $_POST['userID'];
$nameAfter = $_POST['name'];
$loginIDAfter = $_POST['loginID'];
$passwordAfter = $_POST['password'];

// 現在の登録情報の取得
$nameBefore = $_POST['nameBefore'];
$loginIDBefore = $_POST['loginIDBefore'];
$passwordBefore = $_POST['passwordBefore'];

// 変更実施の有無のフラグリセット
$errorFlg = false;
$chkChangeNameFlg = false;
$changelogIDFlg = false;
$chkChangePassFlg = false;
$changeNameFlg = false;
$changelogIDFlg = false;
$changePasswordFlg = false;

$errorNoStatusChange = false;
$errorPasswordCondition = false;
$errorRegistedLoginID = false;
$errorShortLoginID = false;

// 名前、ログインID、パスワードのいずれも変更がなかった場合
// 変更なしエラーで入力画面に戻す
if ($nameAfter == "" && $loginIDAfter == "" && $passwordAfter == "") {
    $errorNoStatusChange = true;
    
    include '../model/searchMemberByID.php';
    
    $result = new searchMemberByID();
    $searchMemberByID = $result -> searchMemberByID($loginID);
    $memberInfo = $searchMemberByID;
    
    $errorFlg = true;
    include '../view/updateMemberForm.php';
    
} else {
    // 新名前と旧名前が一致しない場合
    // 名前変更チェックフラグを立てる
    if ($nameAfter !== "" && $nameAfter !== $nameBefore) {
        $chkChangeNameFlg = true;        
    }
    // 新ログインIDと旧ログインIDが一致しない場合
    // ログインID変更チェックフラグを立てる
    if ($loginIDAfter !== "" && $loginIDAfter !== $loginIDBefore) {
        $chkChangeLogIDFlg = true;
    }
    
    // パスワードの変更の有無の確認
    // 新パスワードと旧パスワードが一致すうるかどうかを確認
    $passwordCheck = password_verify($passwordAfter, $passwordBefore);
    
    // 新パスワードと旧パスワードが一致しない場合
    // パスワード変更チェックフラグを立てる
    if ($passwordAfter !== "" && !$passwordCheck) {
        $chkChangePassFlg = true;
    }
    
    // フラグがひとつも立っていない場合
    // 変更なしエラーで入力画面に戻す
    if ($chkChangeNameFlg == false && $chkChangeLogIDFlg == false && $chkChangePassFlg == false) {
        $errorNoStatusChange = true;
        
        include '../model/searchMemberByID.php';
        
        $result = new searchMemberByID();
        $searchMemberByID = $result -> searchMemberByID($loginID);
        $memberInfo = $searchMemberByID;
        
        $errorFlg = true;
        include '../view/updateMemberForm.php';

    // フラグがひとつ以上立っている場合
    } else {
        // 名前変更チェックフラグが立っている場合
        // 名前変更処理フラグを立てる
        if ($chkChangeNameFlg == true) {
            $changeNameFlg = true;
        }
        
        // ログインID変更チェックフラグが立っている場合
        // ログインID妥当性チェックを行う
        if ($chkChangeLogIDFlg == true) {
            $checkLengthLoginID = strlen($loginIDAfter);
            
            // ログインIDチェック、ログインIDが5文字以下の場合、エラーフラグを立てる
            if ($checkLengthLoginID < 6) {
                $errorShortLoginID = true;
                $errorFlg = true;
            
            } else {
                include '../model/searchMemberByID.php';
            
                // ログインIDチェック、ログインIDが登録済みかどうか確認する。
                $result = new searchMemberByID();
                $searchMember = $result -> searchMemberByID($loginIDAfter);
                $memberInfo = $searchMember;
            
                // ログインIDが登録済みだった場合、エラーフラグを立てる
                if ($memberInfo !== null) {
                    $errorRegistedLoginID = true;
                    $errorFlg = true;
                    
                // 妥当性チェックをクリアした場合
                // ログインID変更処理フラグを立てる
                } else {
                    $changeLogIDFlg = true;
                    
                }
            }
        }
        // パスワード変更チェックフラグが立っている場合
        // パスワードの妥当性チェックを行う
        if ($chkChangePassFlg == true) {
            // パスワードチェック、規定の文字数やフォーマットを満たしているか確認
            // 0〜9、a〜z、A〜Z、記号(!, ?, -, _, @, +, &)からそれぞれ1文字づつ使用すること
            // 計6文字以上であること
            $checkPassworCondition = preg_match('/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[!?-_@+&])[0-9a-zA-Z!?-_@+&]{6,}$/', $passwordAfter);
            
            var_dump($checkPassworCondition);
            
            // パスワードが条件に合致してなかった場合、エラーフラグを立てる
            if (!$checkPassworCondition) {
                $errorPasswordCondition = true;
                $errorFlg = true;

            // 妥当性チェックをクリアした場合、パスワード変更処理フラグを立てる
            } else {
                $changePasswordFlg = true;
                $passwordAfter = password_hash($passwordAfter, PASSWORD_DEFAULT);
                
            }
        }
        // エラーフラグが立っている場合、エラーで入力画面へ戻す
        if ($errorFlg == true) {
            include '../model/searchMemberByID.php';
            
            $result = new searchMemberByID();
            $searchMemberByID = $result -> searchMemberByID($loginID);
            $memberInfo = $searchMemberByID;
            
            include '../view/updateMemberForm.php';
            
        // エラーフラグが立っていない場合、ユーザ情報変更処理を行う
        } else {
            include '../model/updateMember.php';
            
            // ユーザー情報変更処理呼び出し
            $result = new updateMember();
            $resultUpdateMember = $result -> updateMember($nameAfter, $loginIDAfter, $passwordAfter, 
                    $changeNameFlg, $changeLogIDFlg, $changePasswordFlg, $userID, $loginIDBefore);
            $memberInfo = $resultUpdateMember;
            
            if ($changeLogIDFlg == true) {
                $_SESSION['loginID'] = $loginIDAfter;
                $loginID = $loginIDAfter;
                
            }
            
            include '../view/updateMemberResult.php';
            
        }
    }    
}

mysqli_close($link);
?>