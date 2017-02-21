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
    <input type="submit" value="ログアウト">
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
<?php } else { ?>
   <p>いつのを見たいの？？</p>
   <p>お金の使い方を振り返って、次は無駄遣いするんじゃないわよ</p><br>
<?php }?>
   <img src="../cosmetics/img/カーチャン.gif">
   <br><br>
   <p></p>
   <form action="../controller/referencePayResult.php" method="post">
    <table>
     <tbody>
      <tr>
       <td>使ったものの名前は？：</td>
       <td><input type="text" name="payName"></td>
      </tr>
      <tr>
       <td>見たいカテゴリは？：</td>
       <td><input type="text" name="payCategory"></td>
      </tr>
      <tr>
       <td>どこで？：</td>
       <td><input type="text" name="payState"></td>
      </tr>
      <tr>
       <td>いつからいつまで？：</td>
       <td><input type="date" name="payDateFrom" value=<?php echo date("Y-m-d"); ?>>  ～  
        <input type="date" name="payDateTo" value=<?php echo date("Y-m-d"); ?>></td>
      </tr>
     </tbody>
    </table>
    <br>
    <input type="hidden" name="page" value="reference">
    <input type="submit" value="オカンに訊く">
   </form>
   <form action="../controller/menu.php" method="post">
    <input type="submit" value="戻る">
   </form>
  </div>
 </body>
</html>