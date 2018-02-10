<?php
/**
 * 月ごとの支出情報検索クエリ実行クラス
 * 
 * 支出情報を受け取り、DBに検索するクエリを実行する
 * 月ごとの検索結果を返す
 * 
 * @author NowellGartelt
 * @access public
 * @package model
 * @name searchPayByMonth
 * @var int $userID ユーザID
 * @var string $payName 支出名
 * @var string $payCategory 支出カテゴリ 
 * @var DateTime $payDateFrom 支出日(開始)
 * @var DateTime $payDateTo 支出日(終了)
 * @var string $choiceKey 検索方法
 * @var string $methodOfPayment 支払方法
 * @var array $result クエリ実行結果
 */
class searchPayByMonth 
{
    // インスタンス変数の定義
    private $userID = "";
    private $payName = "";
    private $payCategory = "";
    private $payDateFrom = "";
    private $payDateTo = "";
    private $choiceKey = "";
    private $methodOfPayment = "";
    private $result = array();
 
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
     * 月ごとの支出情報検索クエリ実行関数
     * 
     * 支出情報を受け取り、DBに検索するクエリを実行する
     * 月ごとの検索結果を返す
     * 
     * @access public
     * @param int $userID ユーザID
     * @param string $payName 支出名
     * @param string $payCategory 支出カテゴリ 
     * @param string $payDateFrom 支出日(開始)
     * @param string $payDateTo 支出日(終了)
     * @param string $choiceKey 検索方法
     * @param int $methodOfPayment 支払方法
     * @return array 月ごとの支出情報
     */
    public function searchPayByMonth(int $userID, string $payName, string $payCategory, 
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
            
            // 年と月の分割
            // 検索範囲の開始日と終了日の両方で行う
            $payDateFromYear = mb_substr((string) $payDateFrom, 0, 4);
            $payDateFromMonth = mb_substr((string) $payDateFrom, 5, 2);
            $payDateToYear = mb_substr((string) $payDateTo, 0, 4);
            $payDateToMonth = mb_substr((string) $payDateTo, 5, 2);
            
            // 検索範囲の分の回数だけ繰り返しSQL実行
            do {
                // 検索範囲の値が空値だった場合、繰り返しは行わない
                // include時に実行および引数なしで無限ループになるのを防ぐため
                if ($payDateFromYear == "" || $payDateFromMonth == "") {
                    break;
                }
                
                // SQLによる検索のため、検索対象の文字列の結合
                $payDateFrom = $payDateFromYear."-".$payDateFromMonth;
                
                // SQL文初期設定
                $query = "";
                
                $querySelect = "SELECT SUM(payment) FROM paymentTable ";
                $queryWhere = "WHERE userID = '$userID' AND payDate LIKE '{$payDateFrom}%'";
                
                // 条件で名前を指定された場合、名前を条件に追記
                if ($choiceKey == "payName") {
                    $queryWhere .= " AND payName LIKE '%{$payName}%'";
                    
                // 条件でカテゴリを指定された場合、カテゴリを条件に追記
                } elseif ($choiceKey == "payCategory") {
                    $queryWhere .= " AND payCategory LIKE '%{$payCategory}%'";
                    
                // 条件で支払方法を指定された場合、支払方法を条件に追記
                } elseif ($choiceKey == "payment") {
                    $querySelect .= "LEFT OUTER JOIN methodOfPayment ON  paymentTable.mopID = methodOfPayment.mopID ";
                    $queryWhere .= " AND paymentTable.mopID LIKE '%{$methodOfPayment}%'";
                    
                // 条件で何も指定されなかった場合、何も追記しない
                } else {
                }
                
                // SQL文連結作成
                $query = $querySelect.$queryWhere;
                $queryResult = mysqli_query($link, $query);
                
                while ($row = mysqli_fetch_assoc($queryResult)) {
                    // 該当月が検索対象になく、変数にnullがセットされていた場合、0をセットする
                    if ($row["SUM(payment)"] == null) {
                        $row["SUM(payment)"] = 0;
                    }
                    
   	                // キーとして検索対象月を配列にセットする
                    $row["payDateMonth"] = $payDateFrom;
                    array_push($this->result, $row);
                }

                // while文の評価のため、それぞれ文字列の結合を行う
                (string) $payDateFrom = $payDateFromYear."-".$payDateFromMonth;
                (string) $payDateTo = $payDateToYear."-".$payDateToMonth;
                
                // 検索対象範囲にまだ対象の月が残っていた場合、検索対象月を一月ズラす
                if ($payDateFrom !== $payDateTo) {
                    // 検索対象月を一月ズラす
                    $payDateFromMonth = (int) $payDateFromMonth + 1;
                    
                    //  足した結果13月となってしまった場合、年を加算し、13月を1月へ変更する。
                    if ($payDateFromMonth > 12) {
                        $payDateFromYear = (int) $payDateFromYear + 1;
                        $payDateFromMonth = 1;
                    }
                    
                    // 検索対象月が1〜9月の場合、0を頭につけて桁埋めをする
                    if ($payDateFromMonth <= 9) {
                        $payDateFromMonth = sprintf("%02d", (string) $payDateFromMonth);
                    }
                    
                // 検索対象月が末端までたどり着いた時、ループを終了する。
                } else {
                    break;
                }
                
            // 開始日と終了日が一致しない限り繰り返し実行する
            } while ($payDateFrom !== $payDateTo);
        
            // DB切断
            mysqli_close($link);
        
        }

        return $this->result;
        
    }
}
