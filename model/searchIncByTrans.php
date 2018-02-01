<?php
/**
 * 収入情報検索クエリ実行クラス
 * 
 * 各種収入情報を受け取り、DBに検索するクエリを実行する
 * 
 * @author NowellGartelt
 * @access public
 * @package model
 * @name searchIncByTrans
 * 
 * @var string $loginID ログインID
 * @var string $query_refInc 収入情報検索クエリ
 * @var string $incName 収入名
 * @var string $incCategory 収入カテゴリ
 * @var string $incState 収入一言メモ(Stateなのはもともと場所情報を保持するためだったことに由来する)
 * @var DateTime $incDateFrom 収入日(開始)
 * @var DateTime $incDateTo 収入日(終了)
 */

class searchIncByTrans {
    // インスタンス変数の定義
    private $loginID = null;
    private $query_refInc = null;
    private $incName = null;
    private $incCategory = null;
    private $incState = null;
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
     * 収入情報検索クエリ実行関数
     * 
     * 各種収入情報を受け取り、DBに検索するクエリを実行する
     * 
     * @access public
     * @param string $loginID ログインID
     * @param string $incName 収入名
     * @param string $incCategory 収入カテゴリ
     * @param string $incState 収入一言メモ(Stateなのはもともと場所情報を保持するためだったことに由来する)
     * @param DateTime $incDateFrom 収入日(開始)
     * @param DateTime $incDateTo 収入日(終了)
     * @return array $result_list 収入情報
     */
    public function searchIncByTrans($loginID, $incName, $incCategory, 
            $incState, $incDateFrom, $incDateTo){
        // DB接続情報取得
        include '../model/tools/databaseConnect.php';

        $this->loginID = $loginID;
        $this->incName = $incName;
        $this->incCategory = $incCategory;
        $this->incState = $incState;
        $this->incDateFrom = $incDateFrom;
        $this->incDateTo = $incDateTo;
        
        // 入力された条件に合致する収入情報をすべて取得

        // 5つすべて入力されている場合
        // 5から5を選択する組み合わせ
        // x = 5! / 5! * (5 - 5)!
        // x = 5 * 4 * 3 * 2 * 1 / 5 * 4 * 3 * 2 * 1 * 1
        // x = 120 /120
        // x = 1
        if($incName !== ""  && $incCategory !== "" && $incState !=="" && $incDateFrom !== "" && $incDateTo !== ""){
            $query_refInc = "SELECT * FROM incomeTable WHERE incName LIKE '%{$incName}%' 
                AND incState LIKE '%{$incState}%' AND incCategory LIKE '%{$incCategory}%' 
                AND incDate >= '$incDateFrom' AND incDate <= '$incDateTo' AND loginID = '$loginID' 
                ORDER BY incDate ASC";

        // 4つ入力されている場合
        // 5から4を選択する組み合わせ
        // x = 5! / 4! * (5 - 4)!
        // x = 5 * 4 * 3 * 2 * 1 / 4 * 3 * 2 * 1 * 1
        // x = 120 / 24
        // x = 5
        } elseif($incName !== ""  && $incCategory !== "" && $incDateFrom !== "" && $incDateTo !== ""){
            $query_refInc = "SELECT * FROM incomeTable WHERE incName LIKE '%{$incName}%' 
                AND incCategory LIKE '%{$incCategory}%' AND incDate >= '$incDateFrom' 
                AND incDate <= '$incDateTo' AND loginID = '$loginID' 
                ORDER BY incDate ASC";
        } elseif($incName !== ""  && $incState !== "" && $incDateFrom !== "" && $incDateTo !== ""){
            $query_refInc = "SELECT * FROM incomeTable WHERE incName LIKE '%{$incName}%' 
                AND incState LIKE '%{$incState}%' AND incDate >= '$incDateFrom' 
                AND incDate <= '$incDateTo' AND loginID = '$loginID' 
                ORDER BY incDate ASC";
        } elseif($incCategory !== "" && $incState !== "" && $incDateFrom !== "" && $incDateTo !== ""){
            $query_refInc = "SELECT * FROM incomeTable WHERE incCategory LIKE '%{$incCategory}%' 
                AND incState LIKE '%{$incState}%' AND incDate >= '$incDateFrom' 
                AND incDate <= '$incDateTo' AND loginID = '$loginID' 
                ORDER BY incDate ASC";
        } elseif($incName !== ""  && $incCategory !== "" && $incState !== "" && $incDateTo !== ""){
            $query_refInc = "SELECT * FROM incomeTable WHERE incName LIKE '%{$incName}%' 
                AND incCategory LIKE '%{$incCategory}%' AND incState LIKE '%{$incState}%' 
                AND incDate <= '$incDateTo' AND loginID = '$loginID' 
                ORDER BY incDate ASC";
        } elseif($incName !== ""  && $incCategory !== "" && $incDateFrom !== "" && $incState !== ""){
            $query_refInc = "SELECT * FROM incomeTable WHERE incName LIKE '%{$incName}%' 
                AND incCategory LIKE '%{$incCategory}%' AND incDate >= '$incDateFrom' 
                AND incState LIKE '%{$incState}%' AND loginID = '$loginID' 
                ORDER BY incDate ASC";

        // 3つ入力されている場合
        // 5から3を選択する組み合わせ
        // x = 5! / 3! * (5 - 3)!
        // x = 5 * 4 * 3 * 2 * 1 / 3 * 2 * 1 * 2 * 1
        // x = 120 / 12
        // x = 10
        } elseif($incName !== "" && $incCategory !== "" && $incState !== ""){
            $query_refInc = "SELECT * FROM incomeTable WHERE incName LIKE '%{$incName}%' 
                AND incCategory LIKE '%{$incCategory}%' AND incState LIKE '%{$incState}%' 
                AND loginID = '$loginID' ORDER BY incDate ASC";
        } elseif($incName !== "" && $incCategory !== "" && $incDateFrom !== ""){
            $query_refInc = "SELECT * FROM incomeTable WHERE incName LIKE '%{$incName}%' 
                AND incCategory LIKE '%{$incCategory}%' AND incDate <= '$incDateFrom' 
                AND loginID = '$loginID' ORDER BY incDate ASC";
        } elseif($incName !== "" && $incState !== "" && $incDateFrom !== ""){
            $query_refInc = "SELECT * FROM incomeTable WHERE incName LIKE '%{$incName}%' 
                AND incState LIKE '%{$incState}%' AND incDate <= '$incDateFrom' 
                AND loginID = '$loginID' ORDER BY incDate ASC";
        } elseif($incCategory !== "" && $incState !== "" && $incDateFrom !== ""){
            $query_refInc = "SELECT * FROM incomeTable WHERE incCategory LIKE '%{$incCategory}%' 
                AND incState LIKE '%{$incState}%' AND incDate <= '$incDateFrom' 
                AND loginID = '$loginID' ORDER BY incDate ASC";
        } elseif($incName !== "" && $incCategory !== "" && $incDateTo !== ""){
            $query_refInc = "SELECT * FROM incomeTable WHERE incName LIKE '%{$incName}%' 
                AND incCategory LIKE '%{$incCategory}%' AND incDate <= '$incDateTo' 
                AND loginID = '$loginID' ORDER BY incDate ASC";
        } elseif($incName !== "" && $incState !== "" && $incDateTo !== ""){
            $query_refInc = "SELECT * FROM incomeTable WHERE incName LIKE '%{$incName}%' 
                AND incState LIKE '%{$incState}%' AND incDate <= '$incDateTo' 
                AND loginID = '$loginID' ORDER BY incDate ASC";
        } elseif($incCategory !== "" && $incState !== "" && $incDateTo !== ""){
            $query_refInc = "SELECT * FROM incomeTable WHERE incCategory LIKE '%{$incCategory}%' 
                AND incState LIKE '%{$incState}%' AND incDate <= '$incDateTo' 
                AND loginID = '$loginID' ORDER BY incDate ASC";
        } elseif($incName !== "" && $incDateFrom !== "" && $incDateTo !== ""){
            $query_refInc = "SELECT * FROM incomeTable WHERE incName LIKE '%{$incName}%' 
                AND incDate >= '$incDateFrom' AND incDate <= '$incDateTo' 
                AND loginID = '$loginID' ORDER BY incDate ASC";
        } elseif($incCategory !== "" && $incDateFrom !== "" && $incDateTo !== ""){
            $query_refInc = "SELECT * FROM incomeTable WHERE incCategory LIKE '%{$incCategory}%' 
                AND incDate >= '$incDateFrom' AND incDate <= '$incDateTo' 
                AND loginID = '$loginID' ORDER BY incDate ASC";
        } elseif($incState !== "" && $incDateFrom !== "" && $incDateTo !== ""){
            $query_refInc = "SELECT * FROM incomeTable WHERE incState LIKE '%{$incState}%' 
                AND incDate >= '$incDateFrom' AND incDate <= '$incDateTo' 
                AND loginID = '$loginID' ORDER BY incDate ASC";

        // 2つ入力されている場合
        // 5から2を選択する組み合わせ
        // x = 5! / 2! * (5 - 2)!
        // x = 5 * 4 * 3 * 2 * 1 / 2 * 1 * 3 * 2 * 1
        // x = 120 / 12
        // x = 10
        } elseif($incName !== "" && $incCategory !== ""){
            $query_refInc = "SELECT * FROM incomeTable WHERE incName LIKE '%{$incName}%' 
                AND incCategory LIKE '%{$incCategory}%' AND loginID = '$loginID' 
                ORDER BY incDate ASC";
        } elseif($incName !== "" && $incDateFrom !== ""){
            $query_refInc = "SELECT * FROM incomeTable WHERE incName LIKE '%{$incName}%' 
                AND incDate >= '$incDateFrom' AND loginID = '$loginID' 
                ORDER BY incDate ASC";
        } elseif($incName !== "" && $incDateTo !== ""){
            $query_refInc = "SELECT * FROM incomeTable WHERE incName LIKE '%{$incName}%' 
                AND incDate <= '$incDateTo' AND loginID = '$loginID' 
                ORDER BY incDate ASC";
        } elseif($incCategory !== "" && $incDateFrom !== ""){
            $query_refInc = "SELECT * FROM incomeTable WHERE incCategory LIKE '%{$incCategory}%' 
                AND incDate <= '$incDateFrom' AND loginID = '$loginID' 
                ORDER BY incDate ASC";
        } elseif($incCategory !== "" && $incDateTo !== ""){
            $query_refInc = "SELECT * FROM incomeTable WHERE incCategory LIKE '%{$incCategory}%' 
                AND incDate <= '$incDateTo' AND loginID = '$loginID' 
                ORDER BY incDate ASC";
        } elseif($incDateFrom !== "" && $incDateTo !== ""){
            $query_refInc = "SELECT * FROM incomeTable WHERE incDate >= '$incDateFrom' 
                AND incDate <= '$incDateTo' AND loginID = '$loginID' 
                ORDER BY incDate ASC";
        } elseif($incName !== "" && $incState !== ""){
            $query_refInc = "SELECT * FROM incomeTable WHERE incName LIKE '%{$incName}%' 
                AND incState LIKE '%{$incState}%' AND loginID = '$loginID' 
                ORDER BY incDate ASC";
        } elseif($incCategory !== "" && $incState !== ""){
            $query_refInc = "SELECT * FROM incomeTable WHERE incCategory LIKE '%{$incCategory}%' 
                AND incState LIKE '%{$incState}%' AND loginID = '$loginID' 
                ORDER BY incDate ASC";
        } elseif($incState !== "" && $incDateFrom !== ""){
            $query_refInc = "SELECT * FROM incomeTable WHERE incState LIKE '%{$incState}%' 
                AND incDate <= '$incDateFrom' 
                ORDER BY incDate ASC";
        } elseif($incState !== "" && $incDateTo !== ""){
            $query_refInc = "SELECT * FROM incomeTable WHERE incState LIKE '%{$incState}%' 
                AND incDate <= '$incDateTo' AND loginID = '$loginID' 
                ORDER BY incDate ASC";

       // 1つ入力されている場合
       // 5から1を選択する組み合わせ
       // x = 5! / 1! * (5 - 1)!
       // x = 5 * 4 * 3 * 2 * 1 / 1 * 4 * 3 * 2 * 1
       // x = 120 / 24
       // x = 5
        } elseif($incName !== ""){
            $query_refInc = "SELECT * FROM incomeTable 
                WHERE incName LIKE '%{$incName}%' AND loginID = '$loginID' 
                ORDER BY incDate ASC";
        } elseif($incCategory !== ""){
            $query_refInc = "SELECT * FROM incomeTable 
                WHERE incCategory LIKE '%{$incCategory}%' AND loginID = '$loginID' 
                ORDER BY incDate ASC";
        } elseif($incState !== ""){
            $query_refInc = "SELECT * FROM incomeTable 
                WHERE incState LIKE '%{$incState}%' AND loginID = '$loginID' 
                ORDER BY incDate ASC";
        } elseif($incDateFrom !== ""){
            $query_refInc = "SELECT * FROM incomeTable 
                WHERE incDate >= '$incDateFrom' AND loginID = '$loginID' 
                ORDER BY incDate ASC";
        } elseif($incDateTo !== ""){
            $query_refInc = "SELECT * FROM incomeTable 
                WHERE incDate <= '$incDateTo' AND loginID = '$loginID' 
                ORDER BY incDate ASC";

        // ひとつも入力されていない場合
        // 全件検索する
        } else {
            $query_refInc = "SELECT * FROM incomeTable 
                WHERE AND loginID = '$loginID' ORDER BY incDate ASC";
        }
        
        $result_refInc = mysqli_query($link, $query_refInc);
        $result_list = array();
        
        while($row = mysqli_fetch_assoc($result_refInc)) {
            array_push($result_list, $row);
        }
        
        // DB切断
        mysqli_close($link);

        return $result_list;
    }
}
