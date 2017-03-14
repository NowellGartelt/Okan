<!-- controller/reRegistMemberResult.php -->
<?php
session_start();

include '../model/tools/databaseConnect.php';

// 入力値の取得
$loginID = $_POST['loginID'];
$password = $_POST['password'];
$passwordCheck = $_POST['passwordCheck'];

// 再表示の判断のエラーフラグの初期化。
$errorFlg = false;
$errorPasswordUnmatch = false; 
$errorPasswordCondition = false;

// ログインID、パスワード、名前のいずれかの項目が未入力の場合
if ($password == "" || $passwordCheck == "" ) {
    // 入力項目不足でエラー、入力画面に戻す
    $errorNoInput = true;

    $errorFlg = true;
    include '../view/reRegistMemberForm.php';

} else {
    // スクリプト挿入攻撃、XSS対策
    // パスワードの特殊文字をHTMLエンティティ文字へ変換する。
    $password = htmlspecialchars($password, ENT_QUOTES);
    $passwordCheck = htmlspecialchars($passwordCheck, ENT_QUOTES);
    
    if (strcasecmp($password, $passwordCheck) !== 0) {
        // パスワードとパスワード(確認)が一致しない場合、入力画面に戻す
        $errorPasswordUnmatch = true;
        
        $errorFlg = true;
        include '../view/reRegistMemberForm.php';
        
    } else {
        // Passwordチェック、規定の文字数やフォーマットを満たしているか確認
        // 0〜9、a〜z、A〜Z、記号(!, ?, -, _, @, +, &)からそれぞれ1文字づつ使用すること
        // 計6文字以上であること
        $checkPassworCondition = preg_match('/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[!?-_@+&])[0-9a-zA-Z!?-_@+&]{6,}$/', $password);
            
        if (!$checkPassworCondition) {
            // パスワードチェック、パスワードが条件に合致してなかった場合、入力画面に戻す
            $errorPasswordCondition = true;
                
            $errorFlg = true;
            include '../view/reRegistMemberForm.php';
                
        } else {
            // パスワード暗号化
            $password = password_hash($password, PASSWORD_DEFAULT);

            include '../model/updatePassWord.php';
            
            // メンバー情報登録処理
            $result = new updatePassWord();
            $updatePassWord = $result -> updatePassWord($loginID, $password);
            $updateInfo = $updatePassWord;

            include '../view/reRegistMemberResult.php';
                
        }
    }
}

mysqli_close($link);
?>