<?php
/**
 * 収入カテゴリ更新クエリ実行クラス
 * 
 * 収入カテゴリ更新情報を受け取り、カテゴリ名を更新するクエリを実行する
 * 
 * @author NowellGartelt
 * @access public
 * @package model
 * @name updateIncCategory
 * @var string $loginID  ログインID
 * @var string $query カテゴリ更新クエリ
 * @var string $categoryName カテゴリ名
 * @var int $categoryID カテゴリID(個人用のカテゴリID)
 */
class updateIncCategory {
    private $loginID = null;
    private $categoryName = null;
    private $categoryID = null;
    
    /**
     * コンストラクタ
     * 何もしない
     *
     * @access public
     */
    public function __construct() {
        
    }
    
    /**
     * 収入カテゴリ更新用クエリ実行関数
     * 
     * 収入カテゴリ更新情報を受け取り、DBにカテゴリ名を更新するクエリを実行する
     * 
     * @access public
     * @param string $loginID ログインID
     * @param string $categoryName カテゴリ名
     * @param int $categoryID カテゴリID(個人用のカテゴリID)
     * @return array $updateResult クエリ実行結果
     */
    public function updateIncCategory(string $loginID, string $categoryName, int $categoryID){
        // 引き渡された値の取得
        $this->loginID = $loginID;
        $this->categoryName = $categoryName;
        $this->categoryID = $categoryID;
        
        // いずれかの値がnullだった場合、nullを戻り値とする
        if ($loginID == null || $categoryName == null || $categoryID == null) {
            $updateResult = null;
            
        } else {
            // DB接続情報取得
            include '../model/tools/databaseConnect.php';
            
            // 入力された情報で支出情報の更新
            $query = "
                UPDATE incCategoryTable 
                SET categoryName = '$categoryName' 
                WHERE personalID = '$categoryID' AND loginID = '$loginID'";
            $queryResult = mysqli_query($link, $query);
            $updateResult = mysqli_fetch_array($queryResult);
            
            // DB切断
            mysqli_close($link);
            
        }
        
        return $updateResult;

    }
}
