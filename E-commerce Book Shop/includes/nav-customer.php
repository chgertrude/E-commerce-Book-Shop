<?php
    include_once("connection.php");
    include_once "session.php";
?>
<nav>
    <div>
        <img src="images/logo.png" alt="" width="120px" style="padding: 25px 0px 0px 10px;">
        <br><br><br>
        <div class= "link" >
            <h2><a href="index-customer.php"> Browse</a></h2>
        </div>
        <div class= "link" >
             <h2><a href="history.php">History</a></h2>
        </div>  
        <div class= "link" >
             <h2><a href="acc.php">Account</a></h2>
        </div>  
        <div class= "link" >
            <h2><a href="logout.php">Logout</a></h2>
        </div>

        <br><br><br>
        <div class="profile">
            <center>
            <table class= "tb-profile">
                <tr>
                    <td>Hello, <br> <?php  echo ucfirst($name)."!";?></td>
                    <td><i class="fas fa-user" style="font-size:36px; color: #f37064;" ></i></td>
                </tr>
            </table>
            </center>
        </div>
    </div> 
</nav>