<!-- 
view/refPayCategoryForm.php
-->
<html>
 <head>
  <title>Okan：カテゴリ検索結果(つかったお金)</title>
  <meta charset="UTF-8">
  <meta name="description" content="収支管理システム「Okan」の支出のカテゴリ検索結果表示画面。">
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
   <p>Okan：カテゴリ検索結果(つかったお金)</p><br>
   <p>これが今の使ったお金のカテゴリよ</p>
   <p>変更したいなら、変更ボタンで変更しなさいよね</p><br>
   <img src="cosmetics/img/okan.gif">
   <br><br>
   <br>
   <table>
    <tbody>
     <tr>
      <th>No.</th>
      <th>カテゴリ名</th>
      <th></th>
     </tr>
<?php $displayCount = 0; ?>
<?php while ($displayCount < $maxRegist) { ?>
     <tr>
      <td><?php echo $result[$displayCount]['personalID']; ?></td>
      <td><?php echo $result[$displayCount]['categoryName']; ?></td>
      <td>
       <form action="../../Okan/updatePayCategoryForm.php" method="post">
        <input type="submit" value="教えなおす">
        <input type="hidden" name="ID" value=<?php echo $result[$displayCount]['categoryID']; ?>>
       </form>
      </td>
     </tr>
<?php $displayCount++; ?>
<?php } ?>
     <tr>
      <td></td>
      <td></td>
      <td></td>
     </tr>
    </tbody>
   </table>
   <br>
   <form action="../../Okan/menu.php" method="post">
    <button type="submit">戻る</button>
   </form>
  </div>
 </body>
</html>