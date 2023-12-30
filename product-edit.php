<?php
include('config/dbconn.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <?php
    if(isset($_GET['prod_id'])){
        $prod_id= $_GET['prod_id'];
        $query="SELECT * FROM product WHERE id='$prod_id'";
        $query_run=mysqli_query($con,$query);
        if(mysqli_num_rows($query_run)>0){

            $prodItem=mysqli_fetch_array($query_run);
            ?>
                    <section class="content mt-4">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <?php include('message.php') ?>
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>
                                                Edit-Product
                                                <a href="product.php" class="btn btn-danger float-right">Back</a>
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            <form action="code.php" method="POST" enctype="multipart/form-data">
                                                <input type="hidden" name="product_id" value="<?=$prodItem['id']?>">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label>Select Category</label>
                                                        <?php
                                                        $query = "SELECT * FROM category";
                                                        $query_run = mysqli_query($con, $query);
                                                        if (mysqli_num_rows($query_run) > 0) {
                                                            ?>
                                                            <select name="category_id" required class="form-control">
                                                                <option value="">Select Category</option>
                                                                <?php
                                                                foreach ($query_run as $item) {
                                                                    ?>
                                                                    <option value="<?= $item['id'] ?>"><?= $prodItem['category_id']== $item['id'] ?'selected':'' ?></option>
                                                                <?php
                                                            }
                                                            ?>
                                                            </select>
                                                        <?php
                                                    }
                                                    ?>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <label for="">Product Name</label>
                                                            <input type="text" name="name" class="form-control" value="<?=$prodItem['name']?>" required
                                                                placeholder="Enter Product Name">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="">Small Description</label>
                                                            <textarea name="small_description" class="form-control" required
                                                                rows="3" placeholder="Enter small Description"><?=$prodItem['small_description']?></textarea>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <br>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="">Price</label>
                                                            <input type="text" name="price" class="form-control" value="<?=$prodItem['price']?>" required
                                                                placeholder="Enter Price">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="">Offer Price</label>
                                                            <input type="text" name="offerprice" class="form-control" value="<?=$prodItem['offerprice']?>" required
                                                                placeholder="Enter Offer Price">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="">Tax</label>
                                                            <input type="text" name="tax" class="form-control" value="<?=$prodItem['tax']?>" required
                                                                placeholder="Enter Tax">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="">quantity</label>
                                                            <input type="text" name="quantity" class="form-control"  value="<?=$prodItem['quantity']?>" required
                                                                placeholder="Enter quantity">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="">Status (checked = show | Hide) </label> <br>
                                                            <input type="checkbox" name="status" <?=$prodItem['status']=='1'? 'checked':''?>> Show / Hide
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <label for="">Upload Image</label>
                                                            <input type="file" name="image" class="form-control" required>
                                                            <input type="hidden" name="old_image" value="<?=$prodItem['image']?>">
                                                        </div>
                                                        <img src="uploads/product/<?=$prodItem['image']?>" width="50px" height="50px" alt="Image">
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <button type="submit" name="product_update"
                                                                class="btn btn-primary">Update</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
    <?php

        }
        else
        {
            echo "No such Product Found";
        }

        }
        ?>
        </div>

<?php include('includes/script.php'); ?>
<?php include('includes/footer.php'); ?>
