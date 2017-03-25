<!-- view/referenceIncResult.php -->
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
   <p>探したら、合計<?php echo $sumIncome; ?>円だったわよ</p>
   <p>もっと働いて稼ぎなさいよね</p><br>
   <img src="cosmetics/img/okan.gif">
   <br><br>
   <p></p>
   <table>
    <tbody>
     <tr>
      <th>日付</th>
      <th>名前</th>
      <th>金額</th>
      <th>カテゴリ</th>
      <th>場所</th>
      <th></th>
      <th></th>
     </tr>
<?php $displayCount = 0; ?>
<?php while ($displayCount < $incCount) { ?>
     <tr>
      <td><?php echo $income[$displayCount]['incDate']; ?></td>
      <td><?php echo $income[$displayCount]['incName']; ?></td>
      <td><?php echo $income[$displayCount]['income']; ?></td>
      <td><?php echo $income[$displayCount]['incCategory']; ?></td>
      <td><?php echo $income[$displayCount]['incState']; ?></td>
      <td>
       <form action="../../Okan/updateIncForm.php" method="post">
        <input type="submit" value="教えなおす">
        <input type="hidden" name="ID" value=<?php echo $income[$displayCount]['incomeID']; ?>>
       </form>
      </td>
      <td>
       <form action="../../Okan/deleteIncForm.php" method="post">
        <input type="submit" value="取り消してもらう">
        <input type="hidden" name="ID" value=<?php echo $income[$displayCount]['incomeID']; ?>>
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
     </tr>
    </tbody>
   </table>
   <br>
   <form action="../../Okan/referenceIncForm.php" method="post">
    <button type="submit">もういっかい訊く</button>
   </form>
   <form action="../../Okan/menu.php" method="post">
    <button type="submit">戻る</button>
   </form>
  </div>
 </body>
</html>