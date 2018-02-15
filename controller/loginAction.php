<?php
/**
 * ログイン処理クラス
 *
 * ログイン画面で入力された情報に基づき、情報の妥当性の検証とログイン処理を行う
 * 
 * @author NowellGartelt
 * @access public
 * @package controller
 * @name loginActon
 */
session_start();

$loginID = $_POST['loginID'];
$password = $_POST['loginPassword'];

$loginID = htmlspecialchars($loginID, ENT_QUOTES);
$password = htmlspecialchars($password, ENT_QUOTES);

$login = null;

// ログインIDかパスワードが空だった場合
if (empty($loginID) || empty($password)) {
    $_SESSION['login'] = 'emptyIDorPass';
    
    include '../../Okan/controller/login.php';

} else {
    // ログインIDとパスワードの引き当て
    require_once '../model/searchMemberByLogIdAndPass.php';
    $searchMemberByLogIdAndPass = new searchMemberByLogIdAndPass();
    $getPassword = $searchMemberByLogIdAndPass -> searchMemberByLogIdAndPass($loginID, $password);
    
    if (password_verify($password, $getPassword)) {
        // ユーザIDの引き当て
        require_once '../model/searchMemberIDByID.php';
        $searchMemberIDByID = new searchMemberIDByID();
        $result = $searchMemberIDByID -> searchMemberIDByID($loginID);
        $userID = $result['userID'];
        
        // 各支出モジュールフラグの取得
        $payNameFlg = $result['payNameFlg'];
        $payCateFlg = $result['payCateFlg'];
        $taxCalcFlg = $result['taxCalcFlg'];
        $paymentFlg = $result['paymentFlg'];
        $payMemoFlg = $result['payMemoFlg'];
        
        // 各支出モジュールフラグの取得
        $incNameFlg = $result['incNameFlg'];
        $incCateFlg = $result['incCateFlg'];
        $incMemoFlg = $result['incMemoFlg'];
        
        // セッション関数のセット
        $_SESSION['login'] = 'login';
        $_SESSION['loginID'] = $loginID;
        $_SESSION['userID'] = $userID;
        $_SESSION['fromPage'] = "loginAction";
        
        $_SESSION["errorInputPay"] = false;
        
        $_SESSION['payNameFlg'] = $payNameFlg;
        $_SESSION['payCateFlg'] = $payCateFlg;
        $_SESSION['taxCalcFlg'] = $taxCalcFlg;
        $_SESSION['paymentFlg'] = $paymentFlg;
        $_SESSION['payMemoFlg'] = $payMemoFlg;
        
        $_SESSION['incNameFlg'] = $incNameFlg;
        $_SESSION['incCateFlg'] = $incCateFlg;
        $_SESSION['incMemoFlg'] = $incMemoFlg;
        
        include '../view/menu.php';
        
    } else {
        $_SESSION['login'] = 'noRegistration';
        
        include '../../Okan/controller/login.php';
        
    }
}
