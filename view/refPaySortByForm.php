<!-- view/refPaySortByForm.php -->
<html>
 <head>
  <title>Okan：参照</title>
  <meta charset="UTF-8">
  <meta name="description" content="収支管理システム「Okan」の参照画面。">
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
   <p>Okan：参照</p><br>
   <p>いつのを見たいの？？</p>
   <p>お金の使い方を振り返って、次は無駄遣いするんじゃないわよ</p><br>
   <img src="../cosmetics/img/カーチャン.gif">
   <br><br>
   <table>
    <tbody>
     <tr>
      <td>
       <form action="../controller/refPaySortByDayForm.php" method="post">
        <button type="submit">日ごと</button>
       </form>
      </td>
      <td>
       <form action="../controller/refPaySortByMonthForm.php" method="post">
        <button type="submit">月ごと</button>
       </form>
      </td>
     </tr>
    </tbody>
   </table>
   <br>
   <form action="../controller/menu.php" method="post">
    <button type="submit">戻る</button>
   </form>
  </div>
 </body>
</html>