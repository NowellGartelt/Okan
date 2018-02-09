<?php
/**
 * 日ごとの支出情報検索クエリ実行クラス
 * 
 * 支出情報を受け取り、DBに検索するクエリを実行するクラス
 * 日ごとの検索結果を返す
 * 
 * @author NowellGartelt
 * @access public
 * @package model
 * @name searchPayByDay
 * @var string $loginID ログインID
 * @var string $payName 支出名
 * @var string $payCategory 支出カテゴリ 
 * @var DateTime $payDateFrom 支出日(開始)
 * @var DateTime $payDateTo 支出日(終了)
 * @var string $choiceKey 検索方法
 * @var string $methodOfPayment 支払方法
 * @var array $result クエリ実行結果
 */
class searchPayByDay 
{
    // インスタンス変数の定義
    private $loginID = NULL;
    private $payName = null;
    private $payCategory = null;
    private $payDateFrom = null;
    private $payDateTo = null;
    private $choiceKey = null;
    private $methodOfPayment = null;
    private $result = null;
    
    /**
     * コンストラクタ
     * 何もしない
     *
     * @access public
     */
    public function __construct() 
    {
        
    }
    
    /**
     * 日ごとの支出情報検索クエリ実行関数
     * 
     * 支出情報を受け取り、DBに検索するクエリを実行するクラス
     * 日ごとの検索結果を返す
     * 
     * @access public
     * @param string $loginID ログインID
     * @param string $payName 支出名
     * @param string $payCategory 支出カテゴリ 
     * @param string $payDateFrom 支出日(開始)
     * @param string $payDateTo 支出日(終了)
     * @param string $choiceKey 検索方法
     * @param int $methodOfPayment 支払方法
     * @return array 日ごとの支出情報
     */
    public function searchPayByDay(string $loginID, string $payName, string $payCategory, 
            string $payDateFrom, string $payDateTo, string $choiceKey, int $methodOfPayment) 
    {
		// 引き渡された値の取得
        $this->loginID = $loginID;
        $this->payName = $payName;
        $this->payCategory = $payCategory;
        $this->payDateFrom = $payDateFrom;
        $this->payDateTo = $payDateTo;
        $this->choiceKey = $choiceKey;
        $this->methodOfPayment = $methodOfPayment;
        
        // いずれかの値が空だった場合、nullを返す
        if ($loginID == null || $payDateFrom == null || $payDateTo == null) {
            $this->result = null;
            
        } else {
            // DB接続情報取得
            require_once 'model.php';
            $model = new model();
            $link = $model -> getDatabaseCon();
            
            // 日ごとの支出額の合計の取得
            
            // 検索条件で名前が指定された場合
            if ($choiceKey == "payName") {
                $query = "SELECT payDate, SUM(payment) FROM paymentTable 
                    WHERE payName LIKE '%{$payName}%' AND payDate >= '$payDateFrom' 
                    AND payDate <= '$payDateTo' AND loginID = '$loginID' 
                    GROUP BY payDate";
            
            // 検索条件でカテゴリを指定された場合
            } elseif ($choiceKey == "payCategory") {
                $query = "SELECT payDate, SUM(payment) FROM paymentTable 
                    WHERE payCategory LIKE '%{$payCategory}%' AND payDate >= '$payDateFrom' 
                    AND payDate <= '$payDateTo' AND loginID = '$loginID' 
                    GROUP BY payDate";
            
            // 検索条件で支払方法を指定された場合
            } elseif ($choiceKey == "payment") {
                $query = "SELECT payDate, SUM(payment) FROM paymentTable
                    LEFT OUTER JOIN methodOfPayment ON  paymentTable.mopID = methodOfPayment.mopID 
                    WHERE paymentTable.mopID LIKE '%{$methodOfPayment}%' AND payDate >= '$payDateFrom'
                    AND payDate <= '$payDateTo' AND loginID = '$loginID'
                    GROUP BY payDate";
            
            // 検索条件で何も指定されなかった場合
            } else {
                $query = "SELECT payDate, SUM(payment) FROM paymentTable
                    WHERE payDate >= '$payDateFrom' AND payDate <= '$payDateTo' AND loginID = '$loginID' 
                    GROUP BY payDate";
            }
            
            $queryResult = mysqli_query($link, $query);
            $this->result = array ();
		  
            while ($row = mysqli_fetch_assoc($queryResult)) {
                array_push($this->result, $row);
            }
            
            // DB切断
            mysqli_close($link);
            
        }
        
        return $this->result;
        
    }
}
