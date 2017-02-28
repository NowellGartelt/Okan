<!-- controller/loginAction.php -->
<?php
session_start();

include_once '../model/searchMemberByLogIdAndPass.php';

$loginID = $_POST['loginID'];
$loginPassword = $_POST['loginPassword'];

$loginID = htmlspecialchars($loginID, ENT_QUOTES);
$loginPassword = htmlspecialchars($loginPassword, ENT_QUOTES);

if(empty($loginID) || empty($loginPassword)){
    $_SESSION['login'] = 'emptyIDorPass';
    include '../controller/login.php';

} else {
    $checkLoginAction = new searchMemberByLogIdAndPass($loginID, $loginPassword);
    $login = $checkLoginAction -> searchMemberByLogIdAndPass($loginID, $loginPassword);

    if ($login == 'login') {
        $_SESSION['login'] = 'login';
        $_SESSION['loginID'] = $loginID;
        $_SESSION["errorInputPay"] = false;

        include '../view/menu.php';

    } else {
        $_SESSION['login'] = 'noRegistration';
        include '../controller/login.php';

    }
}
?>