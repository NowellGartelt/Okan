<!-- view/login.php -->
<div align="center">
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
</div>