<?php 
/**
 * 登録済みカテゴリ(支出)取得クラス
 * 
 * ログインIDに紐付く登録済みの支出のカテゴリを取得するクラス。
 * 与えられた最大値分、登録済みの支出のカテゴリを取得する。
 * 
 * @access publc
 * @category model
 * @name searchPayCategory
 * @method searchPayCategory
 */

class searchPayCategory {
    // 変数初期化
    private $loginID = null;
    private $maxRegist = null;
    
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
     * ログインIDに紐付く登録済みの支出のカテゴリを取得するクラス。
     * 与えられた最大値分、登録済みの支出のカテゴリを取得する。
     * 登録済みの支出のカテゴリが最大値から不足していた場合、その数だけ「登録なし」を返す
     * 
     * @access public
     * @param unknown $loginID
     * @param unknown $maxRegist
     * @return NULL|array
     */
    public function searchPayCategory($loginID, $maxRegist) {
        // 引き渡された値の取得
        $this->loginID = $loginID;
        $this->maxRegist = $maxRegist;
        
        // いずれかの値がnullだった場合、nullを戻り値とする
        if ($loginID == null || $maxRegist == null) {
            $cateInfo = null;
            return $cateInfo;
            
        } else {
            // DB接続情報取得
            include '../model/tools/databaseConnect.php';
            
            // 戻り値の初期化
            $result_list = array();
            
            // IDで一致するカテゴリ情報の取得
            $query_getCateInfo = "SELECT * FROM payCategoryTable 
                WHERE loginID = '$loginID' ORDER BY personalID";
            $result_getCateInfo = mysqli_query($link, $query_getCateInfo);
            
            //連想配列として取得した値を配列変数に格納する
            while($row = mysqli_fetch_assoc($result_getCateInfo)) {
                array_push($result_list, $row);
            }
            
            // DB切断
            mysqli_close($link);
            
            return $result_list;
        }
    }
}
