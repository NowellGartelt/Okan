<!-- view/referencePayForm.php -->
<html>
 <head>
  <title>Okan：検索(つかったお金)</title>
  <meta charset="UTF-8">
  <meta name="description" content="収支管理システム「Okan」の支出の検索条件入力画面。">
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
   <p>Okan：検索(つかったお金)</p><br>
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
   <img src="cosmetics/img/okan.gif">
   <br><br>
   <p></p>
   <form action="../../Okan/referencePayResult.php" method="post">
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
    <button type="submit">オカンに訊く</button>
   </form>
   <form action="../../Okan/menu.php" method="post">
    <button type="submit">戻る</button>
   </form>
  </div>
 </body>
</html>