<?php 
/**
 * 登録済みカテゴリ(収入)取得クラス
 * 
 * ログインIDに紐付く登録済みの収入カテゴリを取得するクラス。
 * 与えられた最大値分、登録済みの収入カテゴリを取得する。
 * 
 * @access publc
 * @category model
 * @name searchIncCategory
 * @method searchIncCategory
 * @var string $loginID ログインID
 * @var int $maxRegist 取得最大数
 */

class searchIncCategory {
    // 変数初期化
    private $loginID = null;
    private $maxRegist = null;
    private $resultList = null;
    
    /**
     * コンストラクタ
     * 何もしない
     *
     * @access public
     */
    public function __construct() {
        
    }
    
    /**
     * 登録済みカテゴリ(収入)取得関数
     * 
     * ログインIDに紐付く登録済みの収入カテゴリを取得するクラス。
     * 与えられた最大値分、登録済みの収入カテゴリを取得する。
     * 登録済みの収入カテゴリが最大値から不足していた場合、その数だけ「登録なし」を返す
     * 
     * @access public
     * @param string $loginID ログインID
     * @param int $maxRegist 取得最大数
     * @return array $resultList クエリ実行結果
     */
    public function searchIncCategory(string $loginID, int $maxRegist) {
        // 引き渡された値の取得
        $this->loginID = $loginID;
        $this->maxRegist = $maxRegist;
        
        // いずれかの値がnullだった場合、nullを戻り値とする
        if ($loginID == null || $maxRegist == null) {
            $this->resultList = null;
            
        } else {
            // DB接続情報取得
            include '../model/tools/databaseConnect.php';
            
            // 戻り値の初期化
            $this->resultList = array();
            
            // IDで一致するカテゴリ情報の取得
            $query = "
                SELECT * FROM incCategoryTable 
                WHERE loginID = '$loginID' ORDER BY personalID";
            $queryResult = mysqli_query($link, $query);
            
            //連想配列として取得した値を配列変数に格納する
            while($row = mysqli_fetch_assoc($queryResult)) {
                array_push($this->resultList, $row);
            }
            
            // DB切断
            mysqli_close($link);
            
        }

        return $this->resultList;

    }
}
