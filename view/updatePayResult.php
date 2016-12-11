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
   <form action="../controller/logout.php" method="post">
    <input type="submit" value="ログアウト">
   </form>
  </div>
  <center>
  <p>Okan：更新完了</p><br>
  <p><?php echo $payName; ?>に<?php echo $payment; ?>円ね？</p>
  <p>覚えなおしたわよ</p><br>
  <img src="../cosmetics/img/カーチャン.gif">
  <br><br>
  <p></p>
  <form action="../controller/referencePayResult.php" method="post">
   <input type="submit" value="もういっかい訊く">
  </form>
  <form action="../controller/menu.php" method="post">
   <input type="submit" value="戻る">
  </form>
  </center>
　</body>
</html>