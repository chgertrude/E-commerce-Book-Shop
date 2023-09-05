<?php
    include_once "connection.php";
    include "includes/head.php";
    include "includes/nav.php";

    include_once "session.php";

    $pid = $_GET['pid']; //get value from url,  variable from view.php

    // start selecting id first before updating.
    $query = $pdo->prepare("SELECT * FROM product_info WHERE productID = '$pid'");
    $query->execute();

        while($rows = $query->fetch()){
            $image = $rows['productImage']; //new variable naming , inside is the coloumn name in DB
            $ctg = $rows['productCategory'];
            $name = $rows['productName'];
            $prc = $rows['productPrice'];
            $qty = $rows['productQuantity'];
            $dscp = $rows['productDescription'];
            $code = $rows['code'];
        } //end selecting

        //start of updating
        if(isset($_POST['edit'])){ //inside the parenthesis is the name of submit button
            $category = $_POST['category']; //inside is the name of the input
            $name = $_POST['name'];
            $price = $_POST['price'];
            $quantity = $_POST['quantity'];
            $description = $_POST['description'];
            $_code = $_POST['cd'];

            //to process image upload
            $imgFile = $_FILES['image']['name']; //whole file name
            $temp_name = $_FILES['image']['tmp_name']; //temporary name of image
            $imgSize = $_FILES['image']['size'];

            if($imgFile){
                $upload_dir = "photos/"; //directory

                $imgExt = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION)); //get extension only of whole file name, strlower convert to all lowercase
                $valid_ext = array('jpeg', 'jpg', 'gif', 'png'); //valid extension

                //rename file name to avoid overwritten file
                $newname = rand(1000,10000000).".".$imgExt;

                //image extension validation and file size
                if(in_array($imgExt, $valid_ext )){ 
                    if($imgSize < 5242880 ){ //5MB
                        move_uploaded_file($temp_name, $upload_dir.$newname); //if true upload
                    }else{
                        echo "<script>alert('Sorry, your file is too large! Upload lower than 5MB.')</script>";
                        echo "<script>window.open('index.php','_self')</script>";
                    }
                }else{
                    echo "<script>alert('Sorry, only JPEG, JPG, GIF and PNG is allowed!')</script>";
                    echo "<script>window.open('index.php','_self')</script>";
                } //end photo processing
            }else{
                $newname = $image; //remain prevoius image
            }

            $query = $pdo->prepare("UPDATE product_info SET productCategory = :ctg, productName = :_name, productPrice = :price, 
            productQuantity = :qty, productDescription = :dscp, productImage = :img, code = :cd  WHERE productID = '$pid'");
            $query->bindParam(':ctg',$category);
            $query->bindParam(':_name',$name);
            $query->bindParam(':price',$price);
            $query->bindParam(':qty',$quantity);
            $query->bindParam(':dscp',$description);
            $query->bindParam(':img',$newname);
            $query->bindParam(':cd',$_code);
            $query->execute();

            echo "<script>alert('Successfully Updated!')</script>";
            echo "<script>window.open('view.php','_self')</script>";
        }//end of updating

?>
    
<article class="pad-layout">
<div class="title">
  <h1>Update Record</h1>
</div>
<div class="scrollDiv">
        <div class="scrollContent">
          <center>
          <form action="" method ="post" enctype="multipart/form-data"> <!--if uploading is included include enctype, process in the same page - no action --> 
            <table class="tb-index">
                <tr>
                  <td>Product Category</td>
                  <td><input type="text" name="category" value="<?php echo $ctg;?>" ></td>
                </tr>
                <tr>
                  <td>Product Name</td>
                  <td><input type="text" name="name" value="<?php echo $name;?>" ></td>
                </tr>
                <tr>
                  <td>Product Code</td>
                  <td><input type="text" name="cd" value="<?php echo $code;?>" ></td>
                </tr>
                <tr>
                  <td>Product Price</td>
                  <td><input type="int" name="price" value="<?php echo $prc;?>" ></td>
                </tr>
                <tr>
                  <td>Product Quantity</td>
                  <td><input type="int" name="quantity" value="<?php echo $qty;?>"></td>
                </tr>
                <tr>
                  <td>Product Description</td>
                  <td><textarea cols="35" rows="12" name="description"><?php echo $dscp;?></textarea></td>
                </tr>
                <tr>
                  <td>Product Image</td>
                  <td><input type="file" name="image" accept="image/*" ></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td>Image Preview</td>
                  <td><img src="photos/<?php echo $image;?>" alt="Product Image" width="100px"></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>  
                  <td>&nbsp;</td>
                  <th><input  type="submit" name="edit" value="Update" class="bttn"></th>
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