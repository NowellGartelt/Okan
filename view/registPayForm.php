<!-- view/menu.php -->
<html>
　<head>
　 <title>Okan：登録</title>
　 <meta charset="UTF-8">
　 <meta name="description" content="収支管理システム「Okan」の登録画面。">
　 <meta name="keywords" content="収支管理,おかん">
 </head>
 <body>
  <p>Okan：登録</p><br>
  <p>いったい、何に使ったの？？</p>
  <p>まーた変なものに使ったんじゃないでしょうね</p><br>
  <img src="../lib/img/カーチャン.gif">
  <br><br>
  <p></p>
  <form action="../controller/registPayResult.php" method="post">
   <table>
    <tbody>
     <tr>
      <td>使ったものは？：</td>
      <td><input type="text" name="payName"></td>
     </tr>
     <tr>
      <td>いくら？：</td>
      <td><input type="text" name="payment"></td>
     </tr>
     <tr>
      <td>カテゴリは？：</td>
      <td><input type="text" name="payCategory"></td>
     </tr>
     <tr>
      <td>いつ？：</td>
      <td><input type="date" name="payDate"></td>
     </tr>
    </tbody>
   </table>
   <br>
   <input type="submit" value="オカンに教える">
  </form>
  <form action="../controller/menu.php" method="post">
   <input type="submit" value="戻る">
  </form>
　</body>
</html>