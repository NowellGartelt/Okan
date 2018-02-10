<?php
/**
 * 支出の小言取得クラス
 * 
 * 支出金額を受け取り、金額に見合った小言を受け取る
 * 
 * @author NowellGartelt
 * @access public
 * @package model
 * @name searchPayKogoto
 */
class searchPayKotgoto {
    // インスタンス変数の定義
    private $payment = "";
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
     * 支出の小言取得関数
     * 
     * 支出金額を受け取り、金額に見合った小言を受け取る
     * 
     * @access public
     * @param int $payment
     * @return array|null 支出の小言
     */
    public function searchPayKogoto(int $payment) {
        $this->payment = $payment;
        
        if ($payment == null) {
            $this->result = null;
            
        } else {
            // DB接続情報取得
            include 'tools/databaseConnect.php';
            
            // IDで一致する小言情報の取得
            $query = "
                    SELECT * FROM payKogoto 
                    WHERE $payment >= payKogoto.lower_payment
                    ORDER BY lower_payment ASC
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