<!-- view/referencePayResult.php -->
<html>
 <head>
  <title>Okan：検索結果</title>
  <meta charset="UTF-8">
  <meta name="description" content="収支管理システム「Okan」の検索結果画面。">
  <meta name="keywords" content="収支管理,おかん">
  <link href="../view/css/okanStyle.css" rel="stylesheet" type="text/css" media="all">
 </head>
 <body>
  <div align="right">
   <p>LoginID：<?php echo $loginID; ?></p>
   <form action="../../Okan/logout.php" method="post">
    <button type="submit">ログアウト</button>
   </form>
  </div>
  <div align="center">
   <p>Okan：検索結果</p><br>
   <p>探したら、合計<?php echo $sumPayment; ?>円だったわよ</p>
   <p>無駄遣いばっかりして...しょうがないわねー</p><br>
   <img src="cosmetics/img/okan.gif">
   <br><br>
   <p></p>
   <table>
    <tbody>
     <tr>
      <th>日付</th>
      <th>金額</th>
     </tr>
<?php $displayCount = 0; ?>
<?php while ($displayCount < $payCount) { ?>
     <tr>
      <td><?php echo $payment[$displayCount]['payDate']; ?></td>
      <td><?php echo $payment[$displayCount]['SUM(payment)']; ?></td>
     </tr>
<?php $displayCount++; ?>
<?php } ?>
      <tr>
       <td></td>
       <td></td>
      </tr>
     </tbody>
   </table>
   <br>
   <form action="../../Okan/refPaySortByDayForm.php" method="post">
    <button type="submit">もういっかい訊く</button>
   </form>
   <form action="../../Okan/menu.php" method="post">
    <button type="submit">戻る</button>
   </form>
  </div>
 </body>
</html>