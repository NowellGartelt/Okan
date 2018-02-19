<!-- view/refPayCategoryForm.php -->
<html>
 <head>
  <title>Okan：カテゴリ検索結果(もらったお金)</title>
  <meta charset="UTF-8">
  <meta name="description" content="収支管理システム「Okan」の収入カテゴリ検索結果表示画面。">
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
   <p>Okan：カテゴリ検索結果(もらったお金)</p><br>
<?php if ($errFlg == true) { ?>
<?php   if ($errGetInfo == "emptyList" || $errGetInfo == "emptyProperties") { ?>
   <p>悪いわねぇ、画面の表示に失敗しちゃったわ</p>
   <p>再読み込みして、もういっかい画面を開き直してくれる？</p><br>
<?php   } ?>
<?php } else { ?>
   <p>これが今のもらったお金のカテゴリよ</p>
   <p>変更したいなら、「教えなおす」ボタンで変更しなさいよね</p><br>
<?php } ?>
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
<?php while ($displayCount < $count) { ?>
     <tr>
      <td><?php echo $cateList[$displayCount]['personalID']; ?></td>
      <td><?php echo $cateList[$displayCount]['categoryName']; ?></td>
      <td>
       <form action="../../Okan/updateIncCategoryForm.php" method="post">
        <button type="submit">教えなおす</button>
        <input type="hidden" name="personalID" value=<?php echo $cateList[$displayCount]['personalID']; ?>>
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
   <form action="../../Okan/refUserConfMenu.php" method="post">
    <button type="submit">戻る</button>
   </form>
  </div>
 </body>
</html>