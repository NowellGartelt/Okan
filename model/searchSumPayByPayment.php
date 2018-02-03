<?php
/**
 * 支払方法別支出総額検索クエリ実行クラス
 * 
 * ログインID、支出日(開始)、支出日(終了)を受け取り、DBに支払方法別の支出総額を検索するクエリを実行する
 * 
 * @author NowellGartelt
 * @access public
 * @package model
 * @name searchSumPayByPayment
 * @var string $loginID ログインID
 * @var DateTime $payDateFrom 支出日(開始)
 * @var DateTime $payDateTo 支出日(終了)
 */
class searchSumPayByPayment {
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
     * 支払方法別支出総額検索クエリ実行関数
     * 
     * ログインID、支出日(開始)、支出日(終了)を受け取り、DBに支払方法別の支出総額を検索するクエリを実行する
     * 
     * @access public
     * @param string $loginID ログインID
     * @param DateTime $payDateFrom 支出日(開始)
     * @param DateTime $payDateTo　支出日(終了)
     * @return array $paymentInfo クエリ実行結果
     */
    public function searchSumPayByPayment($loginID, $payDateFrom, $payDateTo){
        // DB接続情報取得
        include '../model/tools/databaseConnect.php';
        $this->loginID = $loginID;
        $this->payDateFrom = $payDateFrom;
        $this->payDateTo = $payDateTo;
        
        if ($loginID == "" || $payDateFrom == "" || $payDateTo == "") {
            $paymentInfo = null;
            
        } else {
            // IDで対象のデータを引き当て
            // 指定された期間のカテゴリごとの支出額の取得、支出の多い順に並べる
            $query_getPayInfo =
                "SELECT paymentName, SUM(payment)
                FROM paymentTable 
                LEFT OUTER JOIN methodOfPayment ON paymentTable.mopID = methodOfPayment.mopID 
                WHERE loginID = '$loginID' AND payDate >= '$payDateFrom' AND payDate <= '$payDateTo'
                GROUP BY paymentName
                ORDER BY SUM(payment) DESC";
            $result_getPayInfo = mysqli_query($link, $query_getPayInfo);
            $paymentInfo = array();
            
            while($row = mysqli_fetch_assoc($result_getPayInfo)) {
                array_push($paymentInfo, $row);
            }
        }
        
        // DB切断
        mysqli_close($link);
        
        return $paymentInfo;
    }
}
