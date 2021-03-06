<!-- view/referenceIncResult.php -->
<html>
 <head>
  <title>Okan：検索結果(もらったお金)</title>
  <meta charset="UTF-8">
  <meta name="description" content="収支管理システム「Okan」の収入の検索結果表示画面。">
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
   <p>Okan：検索結果(もらったお金)</p><br>
   <p>探したら、合計<?php echo $sumIncome; ?>円だったわよ</p>
   <p>もっと働いて稼ぎなさいよね</p><br>
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
      <th>一言メモ</th>
      <th></th>
      <th></th>
     </tr>
<?php $displayCount = 0; ?>
<?php while ($displayCount < $incCount) { ?>
     <tr>
      <td><?php echo $incList[$displayCount]['incDate']; ?></td>
      <td><?php echo $incList[$displayCount]['income']; ?></td>
      <td><?php echo $incList[$displayCount]['incName']; ?></td>
      <td><?php echo $incList[$displayCount]['categoryName']; ?></td>
      <td><?php echo $incList[$displayCount]['incState']; ?></td>
      <td>
       <form action="../../Okan/updateIncForm.php" method="post">
        <button type="submit">教えなおす</button>
        <input type="hidden" name="ID" value=<?php echo $incList[$displayCount]['incomeID']; ?>>
       </form>
      </td>
      <td>
       <form action="../../Okan/deleteIncForm.php" method="post">
        <button type="submit">取り消してもらう</button>
        <input type="hidden" name="ID" value=<?php echo $incList[$displayCount]['incomeID']; ?>>
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