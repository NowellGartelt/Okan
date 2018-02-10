<!-- view/referencePayResult.php -->
<html>
 <head>
  <title>Okan：検索結果(つかったお金)</title>
  <meta charset="UTF-8">
  <meta name="description" content="収支管理システム「Okan」の支出の検索結果表示画面。">
  <meta name="keywords" content="収支管理,おかん">
  <link href="../../Okan/view/css/okanStyle.css" rel="stylesheet" type="text/css" media="all">
 </head>
 <body>
  <div align="right">
   <p>LoginID：<?php echo $loginID; ?></p>
   <form action="../../Okan/logout.php" method="post">
    <button type="submit">ログアウト</button>
   </form>
  </div>
  <div align="center">
   <p>Okan：検索結果(つかったお金)</p><br>
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
      <th>名前</th>
      <th>カテゴリ</th>
      <th>支払方法</th>
      <th>一言メモ</th>
      <th></th>
      <th></th>
     </tr>
<?php $displayCount = 0; ?>
<?php while ($displayCount < $payCount) { ?>
     <tr>
      <td><?php echo $payList[$displayCount]['payDate']; ?></td>
      <td><?php echo $payList[$displayCount]['payment']; ?></td>
      <td><?php echo $payList[$displayCount]['payName']; ?></td>
      <td><?php echo $payList[$displayCount]['categoryName']; ?></td>
      <td><?php echo $payList[$displayCount]['paymentName']; ?></td>
      <td><?php echo $payList[$displayCount]['payState']; ?></td>
      <td>
       <form action="../../Okan/updatePayForm.php" method="post">
        <button type="submit">教えなおす</button>
        <input type="hidden" name="ID" value=<?php echo $payList[$displayCount]['paymentID']; ?>>
       </form>
      </td>
      <td>
       <form action="../../Okan/deletePayForm.php" method="post">
        <button type="submit">取り消してもらう</button>
        <input type="hidden" name="ID" value=<?php echo $payList[$displayCount]['paymentID']; ?>>
       </form>
      </td>
     </tr>
<?php $displayCount++; ?>
<?php } ?>
     <tr>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
     </tr>
    </tbody>
   </table>
   <br>
   <form action="../../Okan/referencePayForm.php" method="post">
    <button type="submit">もういっかい訊く</button>
   </form>
   <form action="../../Okan/menu.php" method="post">
    <button type="submit">戻る</button>
   </form>
  </div>
 </body>
</html>