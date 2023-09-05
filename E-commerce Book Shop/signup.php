<?php
  include "includes/head.php";
  include_once("connection.php");

?>


<div class="container">
  <div class="title">
    <img src="images/logo1.png" alt="" width="125px">
    <br>
  </div>
  <div class="form">
    <center>
    <form action="insert-acc.php" method ="post" > 
      <table class="tb-login">
        <tr>
          <th>
            <a href="login.php">&nbsp;Login&nbsp;</a>&nbsp;&nbsp;
            <a href="signup.php">Signup</a>
          </th>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
          <tr>
            <td><i class="fa fa-user icon"></i><input type="text" name="fname" placeholder="Fullname"required ></td>
          </tr>
          <tr>
            <td><i class="fas fa-at icon"></i><input type="text" name="uname" placeholder="Username" required></td>
          </tr>
          <tr>
            <td><i class="fas fa-envelope icon"></i><input type="email" name="email" placeholder="Email" required></td>
          </tr>
          <tr>
            <td><i class="fa fa-key icon"></i><input type="password" name="pword" placeholder="Password" required></td>
          </tr>
          <tr>
            <td><i class="fa fa-key icon" style="color:transparent"></i><input type="password" name="pword1" placeholder="Confirm Password" required></td>
          </tr>
          <tr>
            <td><i class="fas fa-map-marker-alt icon"></i><input type="text" name="address" placeholder="Home Address" required></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>  
            <th><input  type="submit" name="signup" value="Signup" class="bttn"></th>
          </tr>
      </table> 
    </form>
    <br>
    <p>Already a member?<a href="login.php" style="text-decoration: none; color:#f37064"><strong> Login now</strong></a></p>
    </center>
  </div>

</div>


</body>
</html>