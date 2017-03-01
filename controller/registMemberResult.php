<!-- controller/registPayResult.php -->
<?php
session_start();

include '../model/tools/databaseConnect.php';

// 入力値の取得
$loginID = $_POST['loginID'];
$password = $_POST['password'];
$name = $_POST['name'];
// Admin権限の有無、現時点では使用しない
$isAdmin = 0;

// 再表示の判断のエラーフラグの初期化。
$errorFlg = false;

// ログインID、パスワード、名前のいずれかの項目が未入力の場合
if ($loginID == "" || $password == "" || $name == "") {
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
    
    // loginIDチェック、規定の文字数に足りてるか確認
    $checkLengthLoginID = strlen($loginID);
    
    if ($checkLengthLoginID < 6) {
        // ログインIDが5文字以下の場合、入力画面に戻す
        $errorShortLoginID = true;
        
        $errorFlg = true;
        include '../view/registMemberForm.php';
        
    } else {
        include '../model/searchMemberByID.php';

        // ログインIDチェック、ログインIDが登録済みかどうか確認する。
        $result = new searchMemberByID();
        $searchMember = $result -> searchMemberByID($loginID);
        $memberInfo = $searchMember;

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

                include '../model/registMember.php';

                // メンバー情報登録処理
                $result = new registMember();
                $registMember = $result -> registMember($loginID, $password, $name, $registDate, $isAdmin);
                $registInfo = $registMember;

                include '../view/registMemberResult.php';
                
            }
        }
    }
}
$_SESSION["errorInputInfo"] = "";

mysqli_close($link);
?>