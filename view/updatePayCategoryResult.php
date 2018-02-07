<!-- view/updatePayCategoryResult.php -->
<html>
 <head>
  <title>Okan：更新完了(つかったお金のカテゴリ)</title>
  <meta charset="UTF-8">
  <meta name="description" content="収支管理システム「Okan」の支出カテゴリの更新完了画面。">
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
   <p>Okan：更新完了(つかったお金のカテゴリ)</p><br>
   <p><?php echo $categoryNameBefore; ?>を<?php echo $categoryName; ?>に変更するのね？</p>
   <p>覚えなおしたわよ</p><br>
   <img src="cosmetics/img/okan.gif">
   <br><br>
   <p></p>
   <form action="../../Okan/refPayCategoryForm.php" method="post">
    <button type="submit">もういっかいカテゴリをみる</button>
   </form>
   <form action="../../Okan/menu.php" method="post">
    <button type="submit">戻る</button>
   </form>
  </div>
 </body>
</html>