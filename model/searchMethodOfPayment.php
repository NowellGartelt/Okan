<?php
/**
 * 支払方法一覧取得クエリ実行クラス
 * 
 * DBに支払方法一覧を取得するクエリを実行する
 * 
 * @author NowellGartelt
 * @access public
 * @package model
 * @name searchMethodOfPayment
 */

class searchMethodOfPayment {
    // インスタンス変数の定義
    private $resultList = array();
    
    /**
     * コンストラクタ
     * 
     * DBに支払方法一覧を取得するクエリを実行する
     * 
     * @access public
     */
    public function __construct(){
        // DB接続情報取得
        include '../model/tools/databaseConnect.php';
        
        $query = "SELECT * FROM methodOfPayment";
        
        $result = mysqli_query($link, $query);
        
        while($row = mysqli_fetch_assoc($result)) {
            array_push($this->resultList, $row);
        }
        
        // DB切断
        mysqli_close($link);
        
    }
    
    /**
     * 支払方法一覧取得関数
     * 
     * コンストラクタでDBから取得した支払方法一覧を戻り値として渡す
     * 
     * @access public
     * @return array
     */
    public function getMethodOfPayment(){
        return $this->resultList;
        
    }
}