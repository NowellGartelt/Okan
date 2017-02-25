<!-- view/deleteIncResult.php -->
<html>
 <head>
  <title>Okan：削除完了</title>
  <meta charset="UTF-8">
  <meta name="description" content="収支管理システム「Okan」の削除完了画面。">
  <meta name="keywords" content="収支管理,おかん">
 </head>
 <body>
  <div align="right">
   <p>LoginID：<?php echo $loginID; ?></p>
   <form action="../controller/logout.php" method="post">
    <button type="submit">ログアウト</button>
   </form>
  </div>
  <div align="center">
   <p>Okan：削除完了</p><br>
   <p><?php echo $incName; ?>に<?php echo $income; ?>円使ったヤツね？</p>
   <p>取り消しといたたわよ</p><br>
   <img src="../cosmetics/img/カーチャン.gif">
   <br><br>
   <p></p>
   <form action="../controller/referenceIncResult.php" method="post">
    <button type="submit">もういっかい訊く</button>
   </form>
   <form action="../controller/menu.php" method="post">
    <button type="submit">戻る</button>
   </form>
  </div>
 </body>
</html>