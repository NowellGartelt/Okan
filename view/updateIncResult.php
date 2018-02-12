<!-- view/updateIncResult.php -->
<html>
 <head>
  <title>Okan：更新完了(もらったお金)</title>
  <meta charset="UTF-8">
  <meta name="description" content="収支管理システム「Okan」の収入の更新完了画面。">
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
   <p>Okan：更新完了(もらったお金)</p><br>
   <p><?php 
echo $incDate; 
?>に
<?php 
if ($moduleNameFlg == "1" && $incName !== "") {
    echo $incName;
?>
で、
<?php 
}
echo $income; 
?>円ね？</p>

   <p>覚えなおしたわよ</p><br>
   <img src="cosmetics/img/okan.gif">
   <br><br>
   <p></p>
   <form action="../../Okan/referenceIncResult.php" method="post">
    <button type="submit">もういっかい訊く</button>
   </form>
   <form action="../../Okan/menu.php" method="post">
    <button type="submit">戻る</button>
   </form>
  </div>
 </body>
</html>