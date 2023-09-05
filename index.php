<?php
  include "includes/head.php";
  include "includes/nav.php";

  include_once("connection.php");
  include_once "session.php";
?>
    
<article class="pad-layout">
<div class="title">
  <h1>Insert Product</h1>
</div>
<div class="scrollDiv">
        <div class="scrollContent">
          <center>
          <form action="insert.php" method ="post" enctype="multipart/form-data"> <!--if uploading is included include enctype -->
            <table class="tb-index">
                <tr>
                  <td>Product Category</td>
                  <td><input type="text" name="category" placeholder="Enter Product Category" required ></td>
                </tr>
                <tr>
                  <td>Product Name</td>
                  <td><input type="text" name="name" placeholder="Enter Product Name" required></td>
                </tr>
                <tr>
                  <td>Product Code</td>
                  <td><input type="text" name="cd" placeholder="Enter Product Code" required></td>
                </tr>
                <tr>
                  <td>Product Price</td>
                  <td><input type="int" name="price" placeholder="Enter Product Price" required></td>
                </tr>
                <tr>
                  <td>Product Quantity</td>
                  <td><input type="int" name="quantity" placeholder="Enter Product Quantity" required></td>
                </tr>
                <tr>
                  <td>Product Description</td>
                  <td><textarea cols="35" rows="12" name="description" placeholder="Enter Product Description" required></textarea></td>
                </tr>
                <tr>
                  <td>Product Image</td>
                  <td><input type="file" name="image" accept="image/*" required></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>  
                  <td>&nbsp;</td>
                  <th><input  type="submit" name="insert" value="Insert Data" class="bttn"></th>
                </tr>
            </table> 
          </form>
          </center>
        </div>
    </div>
</article>

<?php
  include "includes/aside.php";
?>

</body>
</html>