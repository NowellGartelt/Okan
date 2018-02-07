<?php 
/**
 * 登録済みカテゴリ(支出)取得クラス
 * 
 * カテゴリIDに紐付く登録済みの支出のカテゴリを取得するクラス。
 * 
 * @access publc
 * @category model
 * @name searchPayCategoryByID
 * @method searchPayCategoryByID
 * @var string $loginID ログインID
 * @var int $personalID 個人用カテゴリID
 */
class searchPayCategoryByID {
    // 変数初期化
    private $loginID = null;
    private $personalID = null;
    
    /**
     * コンストラクタ
     * 何もしない
     *
     * @access public
     */
    public function __construct() {
        
    }
    
    /**
     * 登録済みカテゴリ(支出)取得関数
     * 
     * ログインIDと個人カテゴリIDを受け取り、DBに登録済みの支出カテゴリを取得するクエリを実行する。
     * 
     * @access public
     * @param string $loginID ログインID
     * @param int $personalID 個人用カテゴリID
     * @return array $resultList クエリ実行結果
     */
    public function searchPayCategoryByID(string $loginID, int $personalID) {
        // 引き渡された値の取得
        $this->loginID = $loginID;
        $this->personalID = $personalID;
        
        // いずれかの値がnullだった場合、nullを戻り値とする
        if ($loginID == null || $personalID == null) {
            $resultList = null;
            
        } else {
            // DB接続情報取得
            include '../model/tools/databaseConnect.php';
            
            // 返り値の初期化
            $resultList = array();
                  
            // IDで一致するカテゴリ情報の取得
            $query = "
                SELECT * FROM payCategoryTable 
                WHERE loginID = '$loginID' AND personalID = '$personalID'";
            $queryResult = mysqli_query($link, $query);
            
            //連想配列として取得した値を配列変数に格納する
            while($row = mysqli_fetch_assoc($queryResult)) {
                array_push($resultList, $row);
            }
            
            // DB切断
            mysqli_close($link);
            
        }

        return $resultList;

    }
}
