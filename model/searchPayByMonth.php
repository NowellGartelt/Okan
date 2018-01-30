<!-- model/searchPayByMonth.php -->
<?php
class searchPayByMonth {
    // 変数初期化
    private $loginID = null;
    private $query_refPay = null;
    private $payName = null;
    private $payCategory = null;
    private $payDateFrom = null;
    private $payDateTo = null;
    private $choiceKey = null;
 
    // コンストラクタ、何もしない
    public function __construct() {
        
    }
    
    public function searchPayByMonth($loginID, $payName, $payCategory, 
            $payDateFrom, $payDateTo, $choiceKey) {
        // DB接続情報取得
        include '../model/tools/databaseConnect.php';

        $this->loginID = $loginID;
        $this->payName = $payName;
        $this->payCategory = $payCategory;
        $this->payDateFrom = $payDateFrom;
        $this->payDateTo = $payDateTo;
        $this->choiceKey = $choiceKey;

        // 年と月の分割
        // 検索範囲の開始日と終了日の両方で行う
        $payDateFromYear = mb_substr((string) $payDateFrom, 0, 4);
        $payDateFromMonth = mb_substr((string) $payDateFrom, 5, 2);
        $payDateToYear = mb_substr((string) $payDateTo, 0, 4);
        $payDateToMonth = mb_substr((string) $payDateTo, 5, 2);
  
        // 返り値の配列の初期化
        $result_list = array();
  
        // 検索範囲の分の回数だけ繰り返しSQL実行
        do {
            // 検索範囲の値が空値だった場合、繰り返しは行わない
            // include時に実行および引数なしで無限ループになるのを防ぐため
            if ($payDateFromYear == "" || $payDateFromMonth == "") {
                break;
            }

            // SQLによる検索のため、検索対象の文字列の結合
            $payDateFrom = $payDateFromYear."-".$payDateFromMonth;

            // 条件で名前を指定された場合
            if ($choiceKey == "payName") {
                $query_refPay = "SELECT SUM(payment) FROM paymentTable
                    WHERE payName LIKE '%{$payName}%' AND payDate LIKE '%{$payDateFrom}%' 
                    AND loginID = '$loginID'";
            // 条件でカテゴリを指定された場合
            } elseif ($choiceKey == "payCategory") {
                $query_refPay = "SELECT SUM(payment) FROM paymentTable
                    WHERE payName LIKE '%{$payCategory}%' AND payDate LIKE '%{$payDateFrom}%' 
                    AND loginID = '$loginID'";
            // 条件で何も指定されなかった場合
            } else {
                $query_refPay = "SELECT SUM(payment) FROM paymentTable
                    WHERE payDate LIKE '{$payDateFrom}%' AND loginID = '$loginID'";
            }

            $result_refPay = mysqli_query($link, $query_refPay);

            while ($row = mysqli_fetch_assoc($result_refPay)) {
                // 該当月が検索対象になく、変数にnullがセットされていた場合、0をセットする
                if ($row["SUM(payment)"] == null) {
                    $row["SUM(payment)"] = 0;
                }
   	            // キーとして検索対象月を配列にセットする
                $row["payDateMonth"] = $payDateFrom;
                array_push($result_list, $row);
            }

            // while文の評価のため、それぞれ文字列の結合を行う
            (string) $payDateFrom = $payDateFromYear."-".$payDateFromMonth;
            (string) $payDateTo = $payDateToYear."-".$payDateToMonth;
            
            // 検索対象範囲にまだ対象の月が残っていた場合、検索対象月を一月ズラす
            if ($payDateFrom !== $payDateTo) {
                // 検索対象月を一月ズラす
                $payDateFromMonth = (int) $payDateFromMonth + 1;
                //  足した結果13月となってしまった場合、スーパーの袋の年は加算し、13月を1月へ変更する。
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
        
        mysqli_close($link);

        return $result_list;
    }
}
?>