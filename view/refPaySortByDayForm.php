<!-- view/referencePayForm.php -->
<html>
 <head>
  <title>Okan：参照</title>
  <meta charset="UTF-8">
  <meta name="description" content="収支管理システム「Okan」の参照画面。">
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
   <p>Okan：参照</p><br>
<?php if ($errFlg == true) { ?>
<?php   if ($errGetInfo == "emptyList" || $errGetInfo == "emptyProperties") { ?>
   <p>悪いわねぇ、画面の表示に失敗しちゃったわ</p>
   <p>再読み込みして、もういっかい画面を開き直してくれる？</p><br>
<?php   } elseif ($errInput == "errReferencePayCount") { ?>
   <p>ちょっと、その条件じゃ件数が多すぎるわよ</p>
   <p>もっと少ない件数になりそうな条件にしなさいよね</p><br>
<?php   } elseif ($errInput == "errReferencePayNone") { ?>
   <p>ちょっと、その条件じゃ1件も引っかからないわよ</p>
   <p>条件を見直しなさいよね</p><br>
<?php   } elseif ($errInput == "luckNecessaryInfo") { ?>
   <p>ちょっと、その条件だと不足してるわよ</p>
   <p>条件を見直しなさいよね</p><br>
<?php   }?>
<?php } else { ?>
   <p>いつのを見たいの？？</p>
   <p>お金の使い方を振り返って、次は無駄遣いするんじゃないわよ</p><br>
<?php }?>
   <img src="cosmetics/img/okan.gif">
   <br><br>
   <table>
    <tbody>
     <tr>
      <td>
       <form action="../../Okan/refPaySortByDayForm.php" method="post">
        <button type="submit" disabled="disabled">日ごと</button>
       </form>
      </td>
      <td>
       <form action="../../Okan/refPaySortByMonthForm.php" method="post">
        <button type="submit">月ごと</button>
       </form>
      </td>
     </tr>
    </tbody>
   </table>
   <br>
   <form action="../../Okan/refPaySortByDayResult.php" method="post">
    <table>
     <tbody>
      <tr>
       <td>
        <input type="radio" name="choiceKey" value="payName" checked="checked">
        名前で探す：
       </td>
       <td>
        <input type="text" name="payName" style="width: 150px">
       </td>
      </tr>
      <tr>
       <td>
        <input type="radio" name="choiceKey" value="payCategory">
        カテゴリで探す：
       </td>
       <td>
        <select name="payCategory" style="width: 150px">
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
       <td>
        <input type="radio" name="choiceKey" value="payment">
        支払方法で探す：
       </td>
       <td>
        <select name="methodOfPayment" style="width: 150px">
<?php
foreach ($mopList as &$methodOfPayment) {
?>
         <option value=<?php 
            echo $methodOfPayment['mopID']; 
            ?>><?php echo $methodOfPayment['paymentName']; ?></option>
<?php
}
?>
        </select>
       </td>
      </tr>
      <tr>
       <td>
        <input type="radio" name="choiceKey" value="all">
        ぜんぶ
       </td>
      </tr>
      <tr>
       <td><br></td>
      </tr>
      <tr>
       <td>いつからいつまで？：</td>
       <td><input type="date" name="payDateFrom" style="width: 150px" value="<?php echo date("Y-m-d"); ?>">  ～  
       <input type="date" name="payDateTo" style="width: 150px" value="<?php echo date("Y-m-d"); ?>"></td>
      </tr>
     </tbody>
    </table>
    <br>
    <button type="submit">オカンに訊く</button>
   </form>
   <form action="../../Okan/menu.php" method="post">
    <button type="submit">戻る</button>
   </form>
  </div>
 </body>
</html>