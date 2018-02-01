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
 * 
 */

session_start();

include_once '../model/searchMemberByLogIdAndPass.php';

$loginID = $_POST['loginID'];
$loginPassword = $_POST['loginPassword'];

$loginID = htmlspecialchars($loginID, ENT_QUOTES);
$loginPassword = htmlspecialchars($loginPassword, ENT_QUOTES);

if (empty($loginID) || empty($loginPassword)) {
    $_SESSION['login'] = 'emptyIDorPass';
    include '../../Okan/controller/login.php';

} else {
    $searchMemberByLogIdAndPass = new searchMemberByLogIdAndPass();
    $login = $searchMemberByLogIdAndPass -> searchMemberByLogIdAndPass($loginID, $loginPassword);

    if ($login == 'login') {
        $_SESSION['login'] = 'login';
        $_SESSION['loginID'] = $loginID;
        $_SESSION["errorInputPay"] = false;

        include '../view/menu.php';

    } else {
        $_SESSION['login'] = 'noRegistration';
        include '../../Okan/controller/login.php';
        
    }
}
