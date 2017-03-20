<!-- controller/forgotMemberResult.php -->
<?php
session_start();

// 入力情報の取得
$loginID = $_POST['loginID'];
$question = $_POST['question'];
$answer = $_POST['answer'];

// 変更実施の有無のフラグリセット
$errorFlg = false;
$chkChangeNameFlg = false;
$changelogIDFlg = false;
$chkChangePassFlg = false;
$changeNameFlg = false;
$changelogIDFlg = false;
$changePasswordFlg = false;

$errorNoInput = false;
$errorNoRegistration = false;
$errorQuestionNotMatch = false;
$errorAnswerNotMatch = false;

// ログインID、秘密の質問、答えのいずれかが入力がなかった場合
if ($loginID == "" || $question == "" || $answer == "") {
    // 変更なしエラーで入力画面に戻す
    $errorNoInput = true;
    $errorFlg = true;
    
    include '../view/forgotMemberForm.php';
    
// すべて入力されていた場合
} else {
    // スクリプト挿入攻撃、XSS対策
    // パスワードの特殊文字をHTMLエンティティ文字へ変換する。
    $loginID = htmlspecialchars($loginID, ENT_QUOTES);
    $question = htmlspecialchars($question, ENT_QUOTES);
    $answer = htmlspecialchars($answer, ENT_QUOTES);
    
    // ログインIDからメンバー登録の有無の確認
    include '../model/searchMemberByID.php';
    
    $result = new searchMemberByID();
    $searchMember = $result -> searchMemberByID($loginID);
    $memberInfo = $searchMember;
    
    // メンバー登録がなかった場合
    if ($memberInfo == null) {
        // メンバー登録なしエラー、入力画面へ戻す
        $errorNoRegistration = true;
        $errorFlg = true;
        include '../view/forgotMemberForm.php';
        
    // メンバー登録があった場合
    } else {
        // ログインIDから秘密の質問、答えの取得
        include '../model/searchQuestionAndAnswerByID.php';
        
        $result = new searchQuestionAndAnswerByID();
        $searchMember = $result -> searchQuestionAndAnswerByID($loginID);
        $memberInfo = $searchMember;
    
        // 登録済みの秘密の質問と入力された質問が一致しなかった場合
        if ($question !== $memberInfo['question']) {
            // 秘密の質問の不一致エラー、入力画面へ戻す
            $errorQuestionNotMatch = true;
            $errorFlg = true;
            include '../view/forgotMemberForm.php';
            
        // 一致した場合
        } else {
            // 登録済みの答えと入力された答えが一致しなかった場合
            if ($answer !== $memberInfo['answer']) {
                // 質問の答え不一致エラー、入力画面へ戻す
                $errorAnswerNotMatch = true;
                $errorFlg = true;
                include '../view/forgotMemberForm.php';
                
            // 一致した場合
            } else {
                // パスワード再登録画面を表示する
                include '../view/reRegistMemberForm.php';
                
            }
        }
    }
}

mysqli_close($link);
?>