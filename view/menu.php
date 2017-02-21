<!-- view/menu.php -->
<html>
 <head>
  <title>Okan：メニュー</title>
  <meta charset="UTF-8">
  <meta name="description" content="収支管理システム「Okan」のメニューを表示。">
  <meta name="keywords" content="収支管理,おかん">
 </head>
 <body>
  <div align="right">
   <form action="../controller/logout.php" method="post">
    <button type="submit">ログアウト</button>
   </form>
  </div>
  <div align="center">
   <p>Okan：メニュー</p><br>
   <p>何にお金使ったのか教えなさいよ</p>
   <p>ムダ遣いするんじゃないわよ</p><br>
   <img src="../cosmetics/img/カーチャン.gif">
   <br> <br>
   <p>やれること：</p>
   <table>
    <tbody>
     <tr>
      <td>使ったお金を記録する：</td>
      <td><a href="../controller/registPayForm.php">オカンに教える</a></td>
     </tr>
     <tr>
      <td>使ったお金を探す：</td>
      <td><a href="../controller/referencePayForm.php">オカンに訊く</a></td>
     </tr>
     <tr>
      <td>使ったお金をまとめて探す：</td>
      <td><a href="../controller/refPaySortByForm.php">オカンに訊く</a></td>
     </tr>
<!--
     <tr>
      <td>もらったお金を教える：</td>
      <td><a href="../controller/">オカンに教える</a></td>
     </tr>
     <tr>
      <td>使ったお金をまとめる：</td>
      <td><a href="../controller/">オカンに教える</a></td>
     </tr>
     <tr>
      <td>パスワードを変える：</td>
      <td><a href="../controller/">オカンに教える</a></td>
     </tr>
-->
    </tbody>
   </table>
  </div>
 </body>
</html>