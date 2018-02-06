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
    private $viewParam = null;
    private $modelPass = null;
    private $modelParam = null;
    
    /**
     * コンストラクタ
     */
    public function __construct() {
        // ログインチェック
        // ログイン済みかどうか確認実施
        require_once '../model/tools/judgeIsLogined.php';
        $judgeIsLoginedAction = new judgeIsLogined();
        
        // ログインID取得
        $loginID = $_SESSION['loginID'];
        
        return $loginID;
        
    }
    
    public function getLoginID() {
        // ログインID取得
        $loginID = $_SESSION['loginID'];
        
        return $loginID;
        
    }
    
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
        
        include '../view/'.$viewPass.'.php';
        
    }
    
    /**
     * 
     * @param string $viewPass
     * @param array $result
     */
    public function loadViewWithParam(string $viewPass, array $viewParam) {
        $this->viewPass = $viewPass;
        $this->viewParam = $viewParam;
        
        include '../view/'.$viewPass.'.php';
        
    }
    
    /**
     * 
     * @param string $modelPass
     */
    public function loadModel(string $modelPass) {
        $this->$modelPass = $modelPass;
        
        include '../../Okan/model/'.$modelPass.'.php';
        
    }
    
    /**
     * 
     * @param string $modelPass
     * @param array $modelParam
     */
    public function loadModelWithParam(string $modelPass, array $modelParam) {
        $this->$modelPass = $modelPass;
        $this->modelParam = $modelParam;
        
        include '../../Okan/model/'.$modelPass.'.php';
        
    }

}