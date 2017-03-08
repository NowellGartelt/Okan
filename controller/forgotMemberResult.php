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

// 名前、ログインID、パスワードのいずれも入力がなかった場合
// 変更なしエラーで入力画面に戻す
if ($loginID == "" || $question == "" || $answer == "") {
    $errorNoInput = true;
    $errorFlg = true;
    
    include '../view/forgotMemberForm.php';
    
} else {
    include '../model/searchMemberByID.php';
    
    $result = new searchMemberByID();
    $searchMember = $result -> searchMemberByID($loginID);
    $memberInfo = $searchMember;
    
    if ($memberInfo == null) {
        $errorNoRegistration = true;
        $errorFlg = true;
        include '../view/forgotMemberForm.php';
        
    } else {
        include '../model/searchQuestionAndAnswerByID.php';
        
        $result = new searchQuestionAndAnswerByID();
        $searchMember = $result -> searchQuestionAndAnswerByID($loginID);
        $memberInfo = $searchMember;
    
        if ($question !== $memberInfo['question']) {
            $errorQuestionNotMatch = true;
            $errorFlg = true;
            include '../view/forgotMemberForm.php';
            
        } else {
            if ($answer !== $memberInfo['answer']) {
                $errorAnswerNotMatch = true;
                $errorFlg = true;
                include '../view/forgotMemberForm.php';
                
            } else {
                include '../view/reRegistMemberForm.php';
                
            }
        }
    }
}

mysqli_close($link);
?>