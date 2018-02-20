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
 * @var object $model モデルクラス共通処理オブジェクト
 * @var int $userID ユーザID
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
    private $model = "";
    private $userID =  "";
    private $payName = "";
    private $payCategory = "";
    private $payDateFrom = "";
    private $payDateTo = "";
    private $choiceKey = "";
    private $methodOfPayment = "";
    private $result = array();
    
    /**
     * コンストラクタ
     *
     * @access public
     */
    public function __construct() 
    {
        // モデルの共通処理取得
        require_once 'model.php';
        $this->model = new model();
        
    }
    
    /**
     * 日ごとの支出情報検索クエリ実行関数
     * 
     * 支出情報を受け取り、DBに検索するクエリを実行するクラス
     * 日ごとの検索結果を返す
     * 
     * @access public
     * @param int $userID ユーザID
     * @param string $payName 支出名
     * @param string $payCategory 支出カテゴリ 
     * @param string $payDateFrom 支出日(開始)
     * @param string $payDateTo 支出日(終了)
     * @param string $choiceKey 検索方法
     * @param int $methodOfPayment 支払方法
     * @return array 日ごとの支出情報
     */
    public function searchPayByDay(int $userID, string $payName, string $payCategory, 
            string $payDateFrom, string $payDateTo, string $choiceKey, int $methodOfPayment) 
    {
		// 引き渡された値の取得
        $this->userID = $userID;
        $this->payName = $payName;
        $this->payCategory = $payCategory;
        $this->payDateFrom = $payDateFrom;
        $this->payDateTo = $payDateTo;
        $this->choiceKey = $choiceKey;
        $this->methodOfPayment = $methodOfPayment;
        
        // いずれかの値が空だった場合、nullを返す
        if ($userID == null || $payDateFrom == null || $payDateTo == null) {
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
                
                // 日ごとの支出額の合計の取得
                // SQL文初期設定
                $query = "";
                $querySelect = "SELECT payDate, SUM(payment) FROM paymentTable ";
                $queryWhere = "
                        WHERE userID = '$userID' 
                        AND payDate >= '$payDateFrom'
                        AND payDate <= '$payDateTo' ";
                $queryGroupBy = "GROUP BY payDate";
                
                // 検索条件で名前が指定された場合、名前を条件に追記
                if ($choiceKey == "payName") {
                    $queryWhere .= "AND payName LIKE '%{$payName}%' ";
                    
                // 検索条件でカテゴリを指定された場合、カテゴリを条件に追記
                } elseif ($choiceKey == "payCategory") {
                    $queryWhere .= "AND payCategory = '$payCategory' ";
                    
                // 検索条件で支払方法を指定された場合、支払方法を条件に追記
                } elseif ($choiceKey == "payment") {
                    $querySelect .= "LEFT OUTER JOIN methodOfPayment ON  paymentTable.mopID = methodOfPayment.mopID ";
                    $queryWhere .= "AND paymentTable.mopID = '$methodOfPayment' ";
                    
                // 検索条件で何も指定されなかった場合は何も追記しない
                } else {
                }
            
                // SQL文連結作成
                $query = $querySelect.$queryWhere.$queryGroupBy;
                $queryResult = mysqli_query($link, $query);
		          
                while ($row = mysqli_fetch_assoc($queryResult)) {
                    array_push($this->result, $row);
                    
                }
            }
            // DB切断
            mysqli_close($link);
            
        }
        return $this->result;
        
    }
}
