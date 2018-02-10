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
 */
class searchIncKotgoto {
    // インスタンス変数の定義
    private $income = "";
    private $result = array();
    
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
            
            // IDで一致する小言情報の取得
            $query = "
                    SELECT * FROM incKogoto 
                    WHERE $income >= incKogoto.lower_income
                    ORDER BY lower_income ASC
                    LIMIT 1
                    ";
            $queryResult = mysqli_query($link, $query);
            $this->result = mysqli_fetch_assoc($queryResult);
            
            // DB切断
            mysqli_close($link);
            
        }
        
        return $this->result;
        
    }
}