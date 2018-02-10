<?php
/**
 * コントローラクラス
 * 
 * コントローラクラスで使用する共通処理を記述する
 * 
 * @author NowellGartelt
 * @access public
 * @package controller
 * @name controller
 */
class controller {
    // インスタンス変数の定義
    private $viewPass = null;
    private $modelPass = null;
    
    /**
     * コンストラクタ
     * 
     * @access public
     */
    public function __construct() {
        // ログインチェック
        // ログイン済みかどうか確認実施
        require_once '../model/tools/judgeIsLogined.php';
        $judgeIsLoginedAction = new judgeIsLogined();
        
    }
    
    /**
     * ログインID取得関数
     * 
     * ログインIDを返す
     * 
     * @access public
     * @return string
     */
    public function getLoginID() {
        // ログインID取得
        $loginID = $_SESSION['loginID'];
        
        return $loginID;
        
    }
    
    /**
     * ユーザID取得関数
     * 
     * ユーザIDを返す
     * 
     * @access public
     * @return string
     */
    public function getUserID() {
        // ログインID取得
        $userID = $_SESSION['userID'];
        
        return $userID;
        
    }
    
    /**
     * 
     * @param unknown $viewPass
     */
    public function loadView(string $viewPass) {
        $this->$viewPass = $viewPass;
        $viewPassFull = '../view/'.$viewPass.'.php';
        return $viewPassFull;
        
    }
    
    /**
     * 
     * @param string $modelPass
     */
    public function loadModel(string $modelPass) {
        $this->$modelPass = $modelPass;
        
        include '../../Okan/model/'.$modelPass.'.php';
        
    }
}