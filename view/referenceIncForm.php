<!-- view/referenceIncForm.php -->
<html>
 <head>
  <title>Okan：検索(もらったお金)</title>
  <meta charset="UTF-8">
  <meta name="description" content="収支管理システム「Okan」の収入の検索条件入力画面。">
  <meta name="keywords" content="収支管理,おかん">
 </head>
 <body>
  <div align="right">
   <p>LoginID：<?php echo $loginID; ?></p>
   <form action="../../Okan/logout.php" method="post">
    <button type="submit">ログアウト</button>
   </form>
  </div>
  <div align="center">
   <p>Okan：検索(もらったお金)</p><br>
<?php if ($errFlg == true) { ?>
<?php   if ($errResult == "emptyList" || $errResult == "emptyProperties") { ?>
   <p>悪いわねぇ、画面の表示に失敗しちゃったわ</p>
   <p>再読み込みして、もういっかい画面を開き直してくれる？</p><br>
<?php   } elseif ($errResult == "OverCapacity") { ?>
   <p>ちょっと、その条件じゃ件数が多すぎるわよ</p>
   <p>もっと少ない件数になりそうな条件にしなさいよね</p><br>
<?php   } elseif ($errResult == "noneResult") { ?>
   <p>ちょっと、その条件じゃ1件も引っかからないわよ</p>
   <p>条件を見直しなさいよね</p><br>
<?php   }?>
<?php } else { ?>
   <p>いつのを見たいの？？</p>
   <p>お金の使い方を振り返って、次は無駄遣いするんじゃないわよ</p><br>
<?php }?>
   <img src="cosmetics/img/okan.gif">
   <br><br>
   <p></p>
   <form action="../../Okan/referenceIncResult.php" method="post">
    <table>
     <tbody>
      <tr>
       <td>いつからいつまで？：</td>
       <td><input type="date" name="incDateFrom" style="width: 150px" value=<?php echo date("Y-m-d"); ?>>  ～  
        <input type="date" name="incDateTo" style="width: 150px" value=<?php echo date("Y-m-d"); ?>></td>
      </tr>
      <tr>
       <td>使ったものの名前は？：</td>
       <td><input type="text" name="incName" style="width: 150px"></td>
      </tr>
      <tr>
       <td>カテゴリは？：</td>
       <td>
        <select name="payCategory" style="width: 150px">
         <option value=0>なし</option>
<?php 
foreach ($cateList as &$categoryName) {
?>
         <option value=<?php 
            echo $categoryName['personalID'];
            ?>><?php echo $categoryName['categoryName'] ?></option>
<?php 
}
?>
        </select>
       </td>
      </tr>
      <tr>
       <td>一言メモは？：</td>
       <td><input type="text" name="incState" style="width: 150px"></td>
      </tr>
     </tbody>
    </table>
    <br>
    <input type="hidden" name="page" value="reference">
    <button type="submit">オカンに訊く</button>
   </form>
   <form action="../../Okan/menu.php" method="post">
    <button type="submit">戻る</button>
   </form>
  </div>
 </body>
</html>