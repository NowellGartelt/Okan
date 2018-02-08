<?php 
/**
 * 登録済みカテゴリ(支出)取得クラス
 * 
 * ログインIDに紐付く登録済みの支出カテゴリを取得するクラス。
 * 
 * @access publc
 * @category model
 * @name searchPayCategory
 * @method searchPayCategory
 * @var string $loginID ログインID
 * @var int $maxRegist 取得最大数
 */
class searchPayCategory {
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
     * 登録済みカテゴリ(支出)取得関数
     * 
     * ログインIDに紐付く登録済みの支出カテゴリを取得するクラス。
     * 
     * @access public
     * @param string $loginID ログインID
     * @param int $maxRegist 取得最大数
     * @return array $resultList クエリ実行結果
     */
    public function searchPayCategory(string $loginID) {
        // 引き渡された値の取得
        $this->loginID = $loginID;
        
        // いずれかの値がnullだった場合、nullを戻り値とする
        if ($loginID == null) {
            $this->resultList = null;
            
        } else {
            // DB接続情報取得
            include '../model/tools/databaseConnect.php';
            
            // 戻り値の初期化
            $this->resultList = array();
            
            // IDで一致するカテゴリ情報の取得
            $query = "
                SELECT * FROM payCategoryTable 
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
    
    /**
     * カテゴリ名一覧取得クエリ実行関数
     * 
     * ログインIDを受け取り、カテゴリ名一覧を取得するクエリを実行する
     * 
     * @param string $loginID ログインID
     * @return array $resultList クエリ実行結果
     */
    public function searchPayCategoryName(string $loginID) {
        // 引き渡された値の取得
        $this->loginID = $loginID;
        
        // いずれかの値がnullだった場合、nullを戻り値とする
        if ($loginID == null) {
            $this->resultList = null;
            
        } else {
            // DB接続情報取得
            include '../model/tools/databaseConnect.php';
            
            // 戻り値の初期化
            $this->resultList = array();
            
            // IDで一致するカテゴリ情報の取得
            $query = "
                SELECT personalID, categoryName FROM payCategoryTable 
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
    
    /**
     * カテゴリ数取得クエリ実行関数
     * 
     * ログインIDを受け取り、カテゴリ数を取得するクエリを実行する
     * 
     * @param string $loginID ログインID
     * @return array $resultList クエリ実行結果
     */
    public function searchPayCategoryCount(string $loginID) {
        // 引き渡された値の取得
        $this->loginID = $loginID;
        
        // いずれかの値がnullだった場合、nullを戻り値とする
        if ($loginID == null) {
            $this->resultList = null;
            
        } else {
            // DB接続情報取得
            include '../model/tools/databaseConnect.php';
            
            // 戻り値の初期化
            $this->resultList = array();
            
            // IDで一致するカテゴリ情報の取得
            $query = "
                SELECT COUNT(*) FROM payCategoryTable
                WHERE loginID = '$loginID'";
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
