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
 * @var object $model モデルクラス共通処理オブジェクト
 * @var array $result クエリ実行結果
 */
class searchMethodOfPayment 
{
    // インスタンス変数の定義
    private $model = "";
    private $result = array();
    
    /**
     * コンストラクタ
     * 
     * DBに支払方法一覧を取得するクエリを実行する
     * 
     * @access public
     */
    public function __construct()
    {
        // モデルの共通処理取得
        require_once 'model.php';
        $this->model = new model();
        
        // DB接続情報取得
        include 'tools/databaseConnect.php';
        
        // DB接続に失敗した場合
        if ($link == false) {
            $DBConnect = "failed";
            $this->model -> setDBConnectResult($DBConnect);
            $this->result = null;
            
            
        } else {
            $DBConnect = "success";
            $this->model -> setDBConnectResult($DBConnect);

            $query = "SELECT * FROM methodOfPayment";
            $queryResult = mysqli_query($link, $query);
            
            while ($row = mysqli_fetch_assoc($queryResult)) {
                array_push($this->result, $row);
                
            }
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
