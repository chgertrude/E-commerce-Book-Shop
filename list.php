<?php
  include "includes/head.php";
  include "includes/nav-customer.php";

  include_once("connection.php");
  include_once "session.php";
?>
    
<article class="pad-layout">
<div class="title">
  <h1>List of Orders</h1>
</div>
<div class="scrollDiv">
        <div class="scrollContent">
          <center>
          <table class="tb-view" style="text-align: center;">
               <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                    </tr>
               </thead> 
               <tbody>
                   <?php
                        $uid = $_GET['uid']; 

                        $query = $pdo->prepare("SELECT * FROM orders WHERE userID = '$uid'"); // can add additonal filtering use WHERE
                        $query->execute();

                        while($rows = $query->fetch()){
                            $iName = $rows['itemName'];
                            $iPrice = $rows['itemPrice'];
                            $iQty = $rows['ItemQuantity'];
                   ?>
                    <tr>
                        <td><?php echo $iName;?></td>
                        <td><?php echo $iPrice;?></td>
                        <td><?php echo $iQty ;?></td>
                    </tr>

                        <?php }?> <!-- for cont.. looping-->
               </tbody>
            </table>
          </center>
        </div>
    </div>
</article>

<?php
  include "includes/aside-customer.php";
?>

</body>
</html>