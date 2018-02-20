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

$login = "";
unset($_SESSION['login']);

// ログインIDかパスワードが空だった場合
if (empty($loginID) || empty($password)) {
    $login = "emptyIDorPass";

} else {
    // ログインIDとパスワードの引き当て
    require_once '../model/searchMemberByLogIdAndPass.php';
    $searchMemberByLogIdAndPass = new searchMemberByLogIdAndPass();
    $getPassword = $searchMemberByLogIdAndPass -> searchMemberByLogIdAndPass($loginID, $password);
    $DBConnect = $controller -> getDBConnectResult();
    
    // DB接続に失敗した場合
    if ($DBConnect == "failed") {
        $errFlg = true;
        $errGetInfo = "emptyList";
        
    } else {
        if (password_verify($password, $getPassword)) {
            // ユーザIDの引き当て
            require_once '../model/searchMemberIDByID.php';
            $searchMemberIDByID = new searchMemberIDByID();
            $result = $searchMemberIDByID -> searchMemberIDByID($loginID);
            $userID = $result['userID'];
            $DBConnect = $controller -> getDBConnectResult();
            
            // DB接続に失敗した場合
            if ($DBConnect == "failed") {
                $errFlg = true;
                $errGetInfo = "emptyList";
                
            } else {
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
                $login = "login";
                $_SESSION['login'] = "login";
                
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
                
                // 移動元ページの設定
                $fromPage = "loginAction";
                $controller -> setFromPage($fromPage);
                
            }
        } else {
            $login = "noRegistration";
        
        }
    }
}

// エラーがあった場合
if ($login !== "login" || $errFlg !== "") {
    // ログイン画面に戻す
    include '../../Okan/controller/login.php';
    
// エラーがなかった場合    
} else {
    // ログイン完了、メニュー表示
    include '../view/menu.php';
    
}
