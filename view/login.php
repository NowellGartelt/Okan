<!-- view/menu.php -->
<html>
　<head>
 　<title>Fuen-Works：ログイン</title>
 　<meta charset="UTF-8">
 　<meta name="description" content="Fuen-Works全体のログイン画面">
 　<meta name="keywords" content="Fuen-Works">
　</head>
 <body>
  <center>
  <p>ログイン</p><br>
  <form action="../controller/loginAction.php" method="post">
   <table>
    <tbody>
     <tr>
      <td>ログインID：</td>
      <td><input type="text" name="loginID"></td>
     </tr>
     <tr>
      <td>パスワード：</td>
      <td><input type="password" name="loginPassword"></td>
     </tr>
    </tbody>
   </table>
   <br>
   <input type="submit" value="ログインする">
  </form>
  </center>
　</body>
</html>