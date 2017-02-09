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
   <form action="../controller/logout.php" method="post">
    <button type="submit">ログアウト</button>
   </form>
  </div>
  <div align="center">
  <p>Okan：参照</p><br>
<?php if ($errorReferencePayCount == true) { ?>
  <p>ちょっと、その条件じゃ件数が多すぎるわよ</p>
  <p>もっと少ない件数になりそうな条件にしなさいよね</p><br>
<?php } elseif ($errorReferencePayNone == true) { ?>
  <p>ちょっと、その条件じゃ1件も引っかからないわよ</p>
  <p>条件を見直しなさいよね</p><br>
<?php } elseif ($errorNecessaryInfo == true) { ?>
  <p>ちょっと、その条件じゃ1件も引っかからないわよ</p>
  <p>条件を見直しなさいよね</p><br>
<?php } else { ?>
  <p>いつのを見たいの？？</p>
  <p>お金の使い方を振り返って、次は無駄遣いするんじゃないわよ</p><br>
<?php }?>
  <img src="../cosmetics/img/カーチャン.gif">
   <br><br>
   <table>
    <tbody>
     <tr>
      <td>
       <form action="../controller/refPaySortByDayForm.php" method="post">
        <button type="submit" disabled="disabled">日ごと</button>
       </form>
      </td>
      <td>
       <form action="../controller/refPaySortByMonthForm.php" method="post">
        <button type="submit">月ごと</button>
       </form>
      </td>
     </tr>
    </tbody>
   </table>
  <br>
  <form action="../controller/refPaySortByDayResult.php" method="post">
   <table>
    <tbody>
     <tr>
      <td>
       <input type="radio" name="choiceKey" value="payName" checked="checked">
       名前で探す：
      </td>
      <td>
       <input type="text" name="payName">
      </td>
     </tr>
     <tr>
      <td>
       <input type="radio" name="choiceKey" value="payCategory">
       カテゴリで探す：
      </td>
      <td>
       <input type="text" name="payCategory">
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
      <td><input type="date" name="payDateFrom" value=<?php echo date("Y-m-d"); ?>>  ～  
      <input type="date" name="payDateTo" value=<?php echo date("Y-m-d"); ?>></td>
     </tr>
    </tbody>
   </table>
   <br>
   <button type="submit">オカンに訊く</button>
  </form>
  <form action="../controller/menu.php" method="post">
   <button type="submit">戻る</button>
  </form>
  </div>
　</body>
</html>