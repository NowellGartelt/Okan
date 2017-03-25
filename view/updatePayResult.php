<!-- view/updatePayResult.php -->
<html>
 <head>
  <title>Okan：更新完了</title>
  <meta charset="UTF-8">
  <meta name="description" content="収支管理システム「Okan」の更新完了画面。">
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
   <p>Okan：更新完了</p><br>
   <p><?php echo $payName; ?>に<?php echo $payment; ?>円ね？</p>
   <p>覚えなおしたわよ</p><br>
   <img src="cosmetics/img/okan.gif">
   <br><br>
   <p></p>
   <form action="../../Okan/referencePayResult.php" method="post">
    <button type="submit">もういっかい訊く</button>
   </form>
   <form action="../../Okan/menu.php" method="post">
    <button type="submit">戻る</button>
   </form>
  </div>
 </body>
</html>