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
 * @var array $result クエリ実行結果
 */
class searchMethodOfPayment 
{
    // インスタンス変数の定義
    private $result = null;
    
    /**
     * コンストラクタ
     * 
     * DBに支払方法一覧を取得するクエリを実行する
     * 
     * @access public
     */
    public function __construct()
    {
        // DB接続情報取得
        require_once 'model.php';
        $model = new model();
        $link = $model -> getDatabaseCon();
        
        $query = "SELECT * FROM methodOfPayment";
        $queryResult = mysqli_query($link, $query);
        
        while ($row = mysqli_fetch_assoc($queryResult)) {
            array_push($this->result, $row);
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
     * @return array 支払方法一覧
     */
    public function getMethodOfPayment()
    {
        return $this->result;
        
    }
}
