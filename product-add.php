<?php
include('config/dbconn.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content mt-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php include('message.php') ?>
                    <div class="card">
                        <div class="card-header">
                            <h5>
                                Add-Gift Product
                                <a href="product.php" class="btn btn-danger float-right">Back</a>
                            </h5>
                        </div>
                        <div class="card-body">
                            <form action="code.php" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Select Category</label>
                                        <?php
                                        $query = "SELECT * FROM category";
                                        $query_run = mysqli_query($con, $query);
                                        if (mysqli_num_rows($query_run) > 0) {
                                            ?>
                                            <select name="category_id" class="form-control">
                                                <?php
                                                foreach ($query_run as $item) {
                                                    ?>
                                                    <option value="<?= $item['id'] ?>"><?= $item['name'] ?></option>
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
                                            <input type="text" name="name" class="form-control" required
                                                placeholder="Enter Product Name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Small Description</label>
                                            <textarea name="small_description" class="form-control" required
                                                rows="3" placeholder="Enter small Description"></textarea>
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Price</label>
                                            <input type="text" name="price" class="form-control" required
                                                placeholder="Enter Price">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Offer Price</label>
                                            <input type="text" name="offerprice" class="form-control" required
                                                placeholder="Enter Offer Price">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Tax</label>
                                            <input type="text" name="tax" class="form-control" required
                                                placeholder="Enter Tax">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">quantity</label>
                                            <input type="text" name="quantity" class="form-control" required
                                                placeholder="Enter quantity">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Status (checked = show | Hide) </label> <br>
                                            <input type="checkbox" name="status"> Show / Hide
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="">Upload Image</label>
                                            <input type="file" name="image" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="">Click to Save</label>
                                            <button type="submit" name="product_save"
                                                class="btn btn-primary btn-block">Save</button>
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
</div>

<?php include('includes/script.php'); ?>
<?php include('includes/footer.php'); ?>
