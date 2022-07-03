<?php

@include 'config.php';

if(isset($_POST['add_product'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_FILES['product_image']['name'];
   $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
   $product_image_folder = 'uploaded_img/'.$product_image;

   if(empty($product_name) || empty($product_price) || empty($product_image)){
echo "<script>alert('please fill out all the form!');</script>";
     
	//	$message[] = 'please fill out all the form!';
	
		 
   }else{
      $insert = "INSERT INTO products(name, price, image) VALUES('$product_name', '$product_price', '$product_image')";
      $upload = mysqli_query($conn,$insert);
      if($upload){
         move_uploaded_file($product_image_tmp_name, $product_image_folder);
echo "<script>alert('success adding new product');</script>";
      }else{
         $message[] = 'could not add the product';
      }
   }

};

if(isset($_GET['delete'])){
   $id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM products WHERE id = $id");
   header('location:index.php');
};

if(isset($message)){
   foreach($message as $message){
      echo '<span class="message">'.$message.'</span>';
   }
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Sample a simple Products</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

   <!-- bootstrap cdn link  -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

   <link rel="stylesheet" href="styles.css">

</head>
<body>

   
<div class="container">

   <div class="form-container">

      <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
         <h3>add a new product</h3>
         <input type="text" placeholder="what's the product name?" name="product_name" class="box">
         <input type="number" placeholder="how about the price?" name="product_price" class="box">
         <input type="file" accept="image/png, image/jpeg, image/jpg" name="product_image" class="box">
         <input type="submit" class="mybtn" name="add_product" value="add product">
      </form>

   </div>

   <?php
   
   $select = mysqli_query($conn, "SELECT * FROM products");

   ?>
   <div class="show-product">
      <table class="table">
         <thead>
         <tr>
            <th>product image</th>
            <th>product name</th>
            <th>product price</th>
            <th>action</th>
         </tr>
         </thead>
         <?php while($row = mysqli_fetch_assoc($select)){ ?>
         <tr>
            <td data-toggle="modal" data-target="#staticBackdrop" style="cursor: pointer;" ><img src="uploaded_img/<?php echo $row['image']; ?>" height="100" alt=""></td>
            <td data-toggle="modal" data-target="#staticBackdrop" style="cursor: pointer;"><?php echo $row['name']; ?></td>
            <td data-toggle="modal" data-target="#staticBackdrop" style="cursor: pointer;">$<?php echo $row['price']; ?></td>
            <td>
               <a href="update.php?edit=<?php echo $row['id']; ?>" class="mybtn"> <i class="fas fa-edit"></i> edit </a>
               <a href="index.php?delete=<?php echo $row['id']; ?>" class="mybtn"> <i class="fas fa-trash"></i> delete </a>
            </td>
         </tr>


      <?php } ?>
      </table>

      <?php
         // if(isset($_GET['product_name'])){
            // $nama = $_GET['product_name'];
            // $select = mysqli_query($conn, "SELECT * FROM products WHERE id = '$nama'");
         // }
         $select = mysqli_query($conn, "SELECT * FROM products");
         while($row = mysqli_fetch_assoc($select)){
      ?>
         <!-- Modal -->                   
            <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
               <div class="modal-content" method="get">
                  <div class="modal-header" method="get">
                     <h4 class="modal-title" id="staticBackdropLabel" method="get">
                        <?php
                           echo $row['name'] ;  
                        ?>
                     </h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
                  <div class="modal-body">
                     Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestias facilis expedita placeat ullam libero? Doloremque quam dolorem qui, at inventore aliquid voluptates quis! Maiores, tempora eum aperiam praesentium doloribus dolore.
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
               </div>
            </div>
            </div>
      <?php }; ?>

   </div>

</div>

</body>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
</html>