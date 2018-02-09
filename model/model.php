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
     * 
     * @access public
     */
    public function getDatabaseCon() {
        // DB接続情報取得
        require_once 'tools/databaseConnect.php';
        
    }
}
