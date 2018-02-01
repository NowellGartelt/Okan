<?php
/**
 * 支出総額検索クエリ実行クラス
 * 
 * ログインID、支出日(開始)、支出日(終了)を受け取り、DBに支出総額を検索するクエリを実行する
 * 
 * @author NowellGartelt
 * @access public
 * @package model
 * @name searchPaySum
 * @var string loginID ログインID
 * @var DateTime $payDateFrom 支出日(開始)
 * @var DateTime $payDateTo 支出日(終了)
 */

class searchPaySum {
    // インスタンス変数の定義
    private $loginID = null;
    private $payDateFrom = null;
    private $payDateTo = null;
    
    /**
     * コンストラクタ
     * 何もしない
     *
     * @access public
     */
    public function __construct() {
        
    }
    
    /**
     * 支出総額検索クエリ実行関数
     * 
     * ログインID、支出日(開始)、支出日(終了)を受け取り、DBに支出総額を検索するクエリを実行する
     * 
     * @access public
     * @param string loginID ログインID
     * @param DateTime $payDateFrom 支出日(開始)
     * @param DateTime $payDateTo 支出日(終了)
     * @return array $result_list 支出総額
     */
    public function searchPaySum($loginID, $payDateFrom, $payDateTo) {
	    // DB接続情報取得
		include '../model/tools/databaseConnect.php';
		
		$this->loginID = $loginID;
        $this->payDateFrom = $payDateFrom;
        $this->payDateTo = $payDateTo;
        
        // 指定された期間の総支出の取得
        $query_refPay = "SELECT SUM(payment) FROM paymentTable 
            WHERE payDate >= '$payDateFrom' AND payDate <= '$payDateTo' 
            AND loginID = '$loginID'";

        $result_refPay = mysqli_query ($link, $query_refPay);
        $result_list = array ();
		
        while ( $row = mysqli_fetch_assoc ($result_refPay) ) {
            array_push ($result_list, $row);
        }
        if ($result_list == null) {
            $result_list[0]['SUM(payment)'] = 0;
        }
        
        // DB切断
        mysqli_close($link);

        return $result_list;
    }
}
