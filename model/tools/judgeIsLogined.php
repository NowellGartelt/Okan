<?php 
/**
 * ログイン判定クラス
 * 
 * ログイン済みかどうかを判定するクラス
 * ログイン済み出なかった場合、ログイン画面にリダイレクトされる
 * controllerで最初にincludeして使用する
 * ログイン後に使用されるすべてのcontrollerクラスは、このクラスをincludeしなければならない
 * 
 * @author NowellGartelt
 * @access public
 * @package model/tools
 * @name judgeIsLogined
 * @var string loginID ログインID
 */
class judgeIsLogined {
    // インスタンス変数の定義
    private $loginID = null;
    
    /**
     * コンストラクタ
     * 
     * includeされると自動で実行され、ログイン済みかどうか確認する
     * ログイン済み出なかった場合、ログイン画面にリダイレクトされる
     * 
     * @access public
     */
    public function __construct() {
        if (isset($_SESSION['loginID'])) {
            $loginID = $_SESSION['loginID'];
        } else {
            $loginID = null;
        }
        
        if ($loginID == null) {
            header( 'Location: ../../Okan/login.php' );
            exit();
        }
    }
}
