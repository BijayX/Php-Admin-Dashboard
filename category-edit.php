<?php
   session_start();
   include('includes/header.php');
   include('includes/topbar.php');
   include('includes/sidebar.php');
   include('config/dbconn.php');

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<section class="content mt-4">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php include('message.php')  ?>
                <div class="card">
                    <div class="card-header">
                        <h5>
                          EDIT-Gift Category 
                            <a href="category.php"  class="btn btn-danger float-right">Back</a>
                        </h5>
                    </div>
                    <div class="card-body">

                    <form action="code.php" method="POST">
                        <?php
                          if(isset($_GET['id'])){
                            $cate_id=$_GET['id'];
                            $query="SELECT * FROM category WHERE id='$cate_id' ";
                            $query_run=mysqli_query($con,$query);
                            foreach($query_run as $item):
                            ?>
                            <input type="hidden" name="cate_id" value="<?=$item['id'];?>">
                           <div class="modal-body">
                            <div class="form-group">
                                <label for="">Category Name</label>
                                <input type="text" name="name" value="<?=$item['name']; ?>" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="">Description</label>
                                <textarea name="description" class="form-control" cols="" required rows="3"><?=$item['description'];?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Trending</label>
                                <input type="checkbox" name="trending" <?= $item['trending'] =='1' ? 'checked':''; ?> />Trending
                            <div class="form-group">
                                <label for="">Status</label>
                                <input type="checkbox" name="status" <?= $item['status'] =='1' ? 'checked':''; ?> />Status
                            </div>
                            
                        </div>
                        <div class="modal-footer">
                            <a href="category.php" class="btn btn-secondary" >Back</a>
                            <button type="submit" name="category_update" class="btn btn-primary">Update</button>
                        </div>
                        <?php
                         endforeach;
                        }
                        else
                        {
                            echo "No Id Found";
                        }

                        ?>
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