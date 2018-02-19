<?php
/**
 * 収入の小言取得クラス
 * 
 * 収入金額を受け取り、金額に見合った小言を受け取る
 * 
 * @author NowellGartelt
 * @access public
 * @package model
 * @name searchIncKogoto
 * @var object $model モデルクラス共通処理オブジェクト
 * @var int $income 収入額
 * @var array $result クエリ実行結果
 */
class searchIncKotgoto {
    // インスタンス変数の定義
    private $model = "";
    private $income = "";
    private $result = array();
    
    /**
     * コンストラクタ
     * 
     * @access public
     */
    public function __construct() {
        // モデルの共通処理取得
        require_once 'model.php';
        $this->model = new model();
        
    }
    
    /**
     * 収入の小言取得関数
     * 
     * 収入金額を受け取り、金額に見合った小言を受け取る
     * 
     * @access public
     * @param int $income
     * @return array|null 収入の小言
     */
    public function searchIncKogoto(int $income) {
        $this->income = $income;
        
        if ($income == null) {
            $this->result = null;
            
        } else {
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
                
                // IDで一致する小言情報の取得
                $query = "
                        SELECT * FROM incKogoto 
                        WHERE $income >= incKogoto.lower_income
                        ORDER BY lower_income ASC
                        LIMIT 1
                        ";
                $queryResult = mysqli_query($link, $query);
                $this->result = mysqli_fetch_assoc($queryResult);
                
            }
            // DB切断
            mysqli_close($link);
            
        }
        return $this->result;
        
    }
}