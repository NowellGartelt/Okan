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
   <form action="../controller/logout.php" method="post">
    <input type="submit" value="ログアウト">
   </form>
  </div>
  <div align="center">
   <p>Okan：検索結果</p><br>
   <p>探したら、合計<?php echo $sumPayment; ?>円だったわよ</p>
   <p>無駄遣いばっかりして...しょうがないわねー</p><br>
   <img src="../cosmetics/img/カーチャン.gif">
   <br><br>
   <p></p>
   <table>
     <tbody>
      <tr>
       <th>月</th>
       <th>金額</th>
      </tr>
      <?php $displayCount = 0; ?>
      <?php while ($displayCount < $payCount) { ?>
      <tr>
       <td><?php echo $payment[$displayCount]['payDateMonth']; ?></td>
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
   <form action="../controller/refPaySortByMonthForm.php" method="post">
    <input type="submit" value="もういっかい訊く">
   </form>
   <form action="../controller/menu.php" method="post">
    <input type="submit" value="戻る">
   </form>
  </div>
 </body>
</html>