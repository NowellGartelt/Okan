<?php
/**
 * 収入総額検索クエリ実行クラス
 * 
 * ログインID、収入日(開始)、収入日(終了)を受け取り、DBに指定期間の収入総額を検索するクエリを実行する
 * 
 * @author NowellGartelt
 * @access public
 * @package model
 * @name searchIncSum
 * @var string $loginID ログインID
 * @var DateTime $incDateFrom 収入日(開始)
 * @var DateTime $incDateTo 収入日(終了)
 */

class searchIncSum {
    // インスタンス変数の定義
    private $loginID = null;
    private $incDateFrom = null;
    private $incDateTo = null;
    
    /**
     * コンストラクタ
     * 何もしない
     *
     * @access public
     */
    public function __construct() {
        
    }
    
    /**
     * 収入総額検索クエリ実行関数
     * 
     * ログインID、収入日(開始)、収入日(終了)を受け取り、DBに指定期間の収入総額を検索するクエリを実行する
     * 
     * @access public
     * @param string $loginID ログインID
     * @param DateTime $incDateFrom 収入日(開始)
     * @param DateTime $incDateTo 収入日(終了)
     * @return array $incomeInfo 収入総額
     */
    public function searchIncSum($loginID, $incDateFrom, $incDateTo) {
	    // DB接続情報取得
		include '../model/tools/databaseConnect.php';
		
		$this->loginID = $loginID;
        $this->incDateFrom = $incDateFrom;
        $this->incDateTo = $incDateTo;
        
        if ($loginID == "" || $incDateFrom == "" || $incDateTo == "") {
            $incomeInfo = null;
            
        } else {
            // 指定された期間の総収入を取得する
            $query_refPay = 
                "SELECT SUM(income) FROM incomeTable 
                WHERE incDate >= '$incDateFrom' AND incDate <= '$incDateTo' 
                AND loginID = '$loginID'";
        
            $result_refPay = mysqli_query ($link, $query_refPay);
            $incomeInfo = array ();
		
            while ( $row = mysqli_fetch_assoc ($result_refPay) ) {
                array_push ($incomeInfo, $row);
            }
            if ($incomeInfo == null) {
                $incomeInfo[0]['SUM(income)'] = 0;
            }
        }
        
        // DB切断
        mysqli_close($link);

        return $incomeInfo;
    }
}
