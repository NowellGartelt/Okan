<?php
/**
 * パスワード忘れ時メンバー情報検索結果画面表示クラス
 * 
 * パスワード忘れの場合に、メンバー情報として入力された値の妥当性チェック、パスワード再登録画面を呼び出す
 * reRegistMemberFormを呼び出す
 * 
 * @author NowellGartelt
 * @access public
 * @package controller
 * @name forgotMemberResult
 */
if (!isset($_SESSION)) {
    session_start();
    
}

// 入力情報の取得
$loginID = $_POST['loginID'];
$question = $_POST['question'];
$answer = $_POST['answer'];

// 変更実施の有無のフラグリセット
$chkChangeNameFlg = false;
$changelogIDFlg = false;
$chkChangePassFlg = false;
$changeNameFlg = false;
$changelogIDFlg = false;
$changePasswordFlg = false;

// エラー変数の初期化
$errFlg = false;
$errInput = "";
$errGetInfo = "";

// ログインID、秘密の質問、答えのいずれかが入力がなかった場合
if ($loginID == "" || $question == "" || $answer == "") {
    // エラーで入力画面に戻す
    $errFlg = true;
    $errInput = "noInput";
    
// すべて入力されていた場合
} else {
    // スクリプト挿入攻撃、XSS対策
    // パスワードの特殊文字をHTMLエンティティ文字へ変換する。
    $loginID = htmlspecialchars($loginID, ENT_QUOTES);
    $question = htmlspecialchars($question, ENT_QUOTES);
    $answer = htmlspecialchars($answer, ENT_QUOTES);
    
    // ログインIDからメンバー登録の有無の確認
    require_once '../model/searchMemberByID.php';
    $searchMemberByID = new searchMemberByID();
    $memberInfo = $searchMemberByID -> searchMemberByID($loginID);
    $DBConnect = $_SESSION['databaseConnect'];
    
    // DB接続に失敗した場合
    if ($DBConnect == "failed") {
        $errFlg = true;
        $errResult = "emptyList";
        
    } else {
        // メンバー登録がなかった場合
        if ($memberInfo == null) {
            // メンバー登録なしエラー、入力画面へ戻す
            $errFlg = true;
            $errInput = "noRegistration";
            
        // メンバー登録があった場合
        } else {
            // ログインIDから秘密の質問、答えの取得
            require_once '../model/searchQuestionAndAnswerByID.php';
            $searchQuestionAndAnswerByID = new searchQuestionAndAnswerByID();
            $memberInfo = $searchQuestionAndAnswerByID -> searchQuestionAndAnswerByID($loginID);
            $DBConnect = $_SESSION['databaseConnect'];
            
            // DB接続に失敗した場合
            if ($DBConnect == "failed") {
                $errFlg = true;
                $errGetInfo = "emptyList";
                
            } else {
                // 登録済みの秘密の質問と入力された質問が一致しなかった場合
                if ($question !== $memberInfo['question']) {
                    // 秘密の質問の不一致エラー、入力画面へ戻す
                    $errFlg = true;
                    $errInput = "errQuestionNoMatch";
                    
                // 一致した場合
                } else {
                    // 登録済みの答えと入力された答えが一致しなかった場合
                    if ($answer !== $memberInfo['answer']) {
                        // 質問の答え不一致エラー、入力画面へ戻す
                        $errFlg = true;
                        $errInput = "errAnswerNotMatch";
                        
                    }
                }
            }
        }
    }
}

// エラーがあった場合
if ($errFlg == true) {
    if ($errInput !== "" || $errGetInfo !== "") {
        // 入力フォームの再表示
        include '../view/forgotMemberForm.php';
        
    }            
} else {
    // パスワード再登録画面を表示する
    include '../view/reRegistMemberForm.php';
    
}
