<?php
    include_once "connection.php";
    include "includes/head.php";
    include "includes/nav.php";

    include_once "session.php";
?>
    
<article class="pad-layout">
<div class="title">
  <h1>View List of Products</h1>
</div>
<div class="scrollDiv">
    <div class="scrollContent">
        <center>
            <table class="tb-view">
               <thead>
                    <tr>
                        <th>Image</th>
                        <th>Category</th>
                        <th>Name</th>
                        <th>&nbsp;Price&nbsp;</th> 
                        <th>&nbsp;Quantity&nbsp;</th>
                        <th>Description</th>
                        <th>Code</th>
                        <th>&nbsp;&nbsp;Action&nbsp;&nbsp;</th>
                    </tr>
               </thead> 
               <tbody>
                   <?php
                        $query = $pdo->prepare("SELECT * FROM product_info"); // can add additonal filtering use WHERE
                        $query->execute();

                        while($rows = $query->fetch()){
                            $image = $rows['productImage']; //new variable naming , inside is the coloumn name in DB
                            $ctg = $rows['productCategory'];
                            $name = $rows['productName'];
                            $prc = $rows['productPrice'];
                            $qty = $rows['productQuantity'];
                            $dscp = $rows['productDescription'];
                            $code = $rows['code'];
                            $pid = $rows['productID'];
                   ?>
                    <tr>
                        <td><img src="photos/<?php echo $image;?>" alt="Product Image" width="150px"></td>
                        <td><?php echo $ctg;?></td>
                        <td><?php echo $name?></td>
                        <td><?php echo $prc?></td>
                        <td><?php echo $qty?></td>
                        <td><?php echo $dscp?></td>
                        <td><?php echo $code?></td>
                        <td><a href="edit.php?pid=<?php echo $pid;?>" style="text-decoration: none ; color:#F65D4E" class="tooltip" title="Edit"><i class="fas fa-edit" style="font-size:24px;"></i></a> | 
                        <a onclick="return confirm('Are you sure?')" href="remove.php?pid=<?php echo $pid;?>" style="text-decoration: none ; color:#F65D4E" class="tooltip" title="Remove"><i class="fas fa-trash-alt" style="font-size:24px;"></i></i></a></td> <!-- parameter variable -->
                    </tr>

                        <?php } ?> <!-- for cont.. looping-->
               </tbody>
            </table>
        </center>
    </div>
</div>
</article>

<?php
  include "includes/aside.php";
?>

</body>
</html>