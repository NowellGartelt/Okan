<!-- view/menu.php -->
<html>
　<head>
　 <title>Okan：参照</title>
　 <meta charset="UTF-8">
　 <meta name="description" content="収支管理システム「Okan」の参照画面。">
　 <meta name="keywords" content="収支管理,おかん">
 </head>
 <body>
　<div align="right">
   <form action="../controller/logout.php" method="post">
    <input type="submit" value="ログアウト">
   </form>
  </div>
  <center>
  <p>Okan：参照</p><br>
  <p>いつのを見たいの？？</p>
  <p>お金の使い方を振り返って、次は無駄遣いするんじゃないわよ</p><br>
  <img src="../lib/img/カーチャン.gif">
  <br><br>
  <p></p>
  <form action="../controller/referencePayResult.php" method="post">
   <table>
    <tbody>
     <tr>
      <td>使ったものの名前は？：</td>
      <td><input type="text" name="payName"></td>
     </tr>
     <tr>
      <td>見たいカテゴリは？：</td>
      <td><input type="text" name="payCategory"></td>
     </tr>
     <tr>
      <td>どこで？：</td>
      <td><input type="text" name="payState"></td>
     </tr>
     <tr>
      <td>いつからいつまで？：</td>
      <td><input type="date" name="payDateFrom" value=<?php echo date("Y-m-d"); ?>></td>
      <td><input type="date" name="payDateTo" value=<?php echo date("Y-m-d"); ?>></td>
     </tr>
<!--
     <tr>
      <td>結果のまとめ方は？：</td>
      <td>
       <select name="sortBy">
        <option selected value="none">まとめない</option>
        <option value="none">日ごと</option>
        <option value="none">月ごと</option>
       </select>
      </td>
     </tr>
-->
    </tbody>
   </table>
   <br>
   <input type="submit" value="オカンに訊く">
  </form>
  <form action="../controller/menu.php" method="post">
   <input type="submit" value="戻る">
  </form>
  </center>
　</body>
</html>