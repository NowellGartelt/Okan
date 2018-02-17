<?php
/**
 * モデルクラス
 * 
 * モデルクラスで使用する共通処理を記述する
 * 
 * @author NowellGartelt
 * @access public
 * @package model
 * @name model
 */
class model {
    
    /**
     * コンストラクタ
     * 
     * 何もしない
     * 
     * @access public
     */
    public function __construct() {
        
    }
    
    /**
     * DB接続情報取得
     * 
     * データベースへの接続情報を取得する
     * ※現在は使用していない
     * 
     * @access public
     */
    public function getDatabaseCon() {
        // DB接続情報取得
        require_once 'tools/databaseConnect.php';
        
    }

    /**
     * DB接続結果更新関数
     *
     * DBに接続した結果を更新する
     *
     * @param boolean $databaseConnect DB接続結果
     */
    public function setDBConnectResult(string $DBConnect) {
        $_SESSION['databaseConnect'] = $DBConnect;
        
    }
}
