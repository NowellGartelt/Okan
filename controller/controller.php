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
     * 移動元ページ名取得関数
     * 
     * 移動元のページ名を返す
     * 
     * @return string
     */
    public function getFromPage() {
        //　移動元のページ名の取得
        $fromPage = $_SESSION['fromPage'];
        
        return $fromPage;
        
    }
    
    /**
     * 移動元ページ名更新関数
     * 
     * 移動元のページ名を更新する
     * 
     * @param string $fromPage
     */
    public function setFromPage(string $fromPage) {
        $_SESSION['fromPage'] = $fromPage;
        
    }
    
    /**
     * 各支出モジュールフラグ取得関数
     * 
     * 各支出モジュール使用フラグを取得する
     * 
     * @return array
     */
    public function getPayModuleFlg() {
        $modulePayFlg['taxCalcFlg'] = $_SESSION['taxCalcFlg'];
        $modulePayFlg['payNameFlg'] = $_SESSION['payNameFlg'];
        $modulePayFlg['payCateFlg'] = $_SESSION['payCateFlg'];
        $modulePayFlg['paymentFlg'] = $_SESSION['paymentFlg'];
        $modulePayFlg['payMemoFlg'] = $_SESSION['payMemoFlg'];
        
        return $modulePayFlg;
        
    }
    
    /**
     * 各収入モジュールフラグ取得関数
     *
     * 各収入モジュール使用フラグを取得する
     *
     * @return array
     */
    public function getIncModuleFlg() {
        $moduleIncFlg['incNameFlg'] = $_SESSION['incNameFlg'];
        $moduleIncFlg['incCateFlg'] = $_SESSION['incCateFlg'];
        $moduleIncFlg['incMemoFlg'] = $_SESSION['incMemoFlg'];
        
        return $moduleIncFlg;
        
    }
    
    /**
     * 各支出モジュールフラグ更新関数
     *
     * 各支出モジュール使用フラグを更新する
     *
     * @return array
     */
    public function setPayModuleFlg(int $moduleTaxCalcFlg, int $modulePayNameFlg,
            int $modulePayCateFlg, int $modulePaymentFlg, int $modulePayMemoFlg) {
        $_SESSION['taxCalcFlg'] = $moduleTaxCalcFlg;
        $_SESSION['payNameFlg'] = $modulePayNameFlg;
        $_SESSION['payCateFlg'] = $modulePayCateFlg;
        $_SESSION['paymentFlg'] = $modulePaymentFlg;
        $_SESSION['payMemoFlg'] = $modulePayMemoFlg;
        
    }
    
    /**
     * 各収入モジュールフラグ更新関数
     *
     * 各収入モジュール使用フラグを更新する
     *
     * @return array
     */
    public function setIncModuleFlg(int $moduleIncNameFlg, int $moduleIncCateFlg,
            int $moduleIncMemoFlg) {
        $_SESSION['incNameFlg'] = $moduleIncNameFlg;
        $_SESSION['incCateFlg'] = $moduleIncCateFlg;
        $_SESSION['incMemoFlg'] = $moduleIncMemoFlg;
        
    }
    
    /**
     * viewクラスフルパス取得関数
     * 
     * viewクラスのファイル名を受け取り、viewクラスのフルパスを返す
     * ※現在はまだ使用しない
     * 
     * @param string $viewPass
     */
    public function loadView(string $viewPass) {
        $this->$viewPass = $viewPass;
        $viewPassFull = '../view/'.$viewPass.'.php';
        return $viewPassFull;
        
    }
    
    /**
     * modelクラスフルパス取得関数
     * 
     * modelクラスのファイル名を受け取り、viewクラスのフルパスを返す
     * ※現在はまだ使用しない
     * 
     * @param string $modelPass
     */
    public function loadModel(string $modelPass) {
        $this->$modelPass = $modelPass;
        
        include '../../Okan/model/'.$modelPass.'.php';
        
    }
}