<!-- model/searchPaymentByMonth.php -->
<?php
class searchPaymentByMonth {
 // 変数初期化
    private $query_referencePay = null;
    private $payName = null;
    private $payCategory = null;
    private $payDateFrom = null;
    private $payDateTo = null;
    private $choiceKey = null;

    private $query_refPay = null;
 
 public function searchPaymentByMonth($payName, $payCategory, $payDateFrom, $payDateTo, $choiceKey) {
    // DB接続情報取得
    include '../model/tools/databaseConnect.php';
  
    $this->payName = $payName;
    $this->payCategory = $payCategory;
    $this->payDateFrom = $payDateFrom;
    $this->payDateTo = $payDateTo;
    $this->choiceKey = $choiceKey;

    // 年と月の分割
    // 検索範囲の最古と最新の両方で行う
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
   
    // 名前で検索
    if ($choiceKey == "payName") {
        $query_refPay = "SELECT SUM(payment) FROM paymenttable
            WHERE payName LIKE '%{$payName}%' AND payDate LIKE '%{$payDateFrom}%'";
    // カテゴリで検索
    } elseif ($choiceKey == "payCategory") {
        $query_refPay = "SELECT SUM(payment) FROM paymenttable
            WHERE payName LIKE '%{$payCategory}%' AND payDate LIKE '%{$payDateFrom}%'";
    // 全件検索
    } else {
        $query_refPay = "SELECT SUM(payment) FROM paymenttable
            WHERE payDate LIKE '{$payDateFrom}%'";
    }
   
    $result_refPay = mysqli_query($link, $query_refPay);
      
    while ($row = mysqli_fetch_assoc($result_refPay)) {
        // 該当月が検索対象になく、変数にnullがセットされていた場合、0をセットする
        if ($row["SUM(payment)"] == null) {
            $row["SUM(payment)"] = 0;
        }
   	    // キーとして検索対象付きを配列にセットする
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
        if ($payDateFromMonth < 13) {
            $payDateFromYear = (int) $payDateFromYear + 1;
            $payDateFromMonth = 1;
        }    
        if ($payDateFromMonth <= 9) {
            $payDateFromMonth = sprintf("%02d", (string) $payDateFromMonth);
        }
        // 検索対象月が末端までたどり着いた時、ループを終了する。
        } else {
            break;
        }
        } while ($payDateFrom !== $payDateTo);

        return $result_list;
    }
}
?>