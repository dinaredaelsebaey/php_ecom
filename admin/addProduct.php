<?php
 include_once('includes/header.php');
 include_once('../middleware/adminMiddleware.php');
 include_once '../config/db.php';
 include_once '../config/categoryDb.php';
 include_once '../config/productDb.php';

$database =new Database();
$conn = $database->getConnection();
 ?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php if(isset($_SESSION['message'])){ ?>

            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>hi!</strong>
                <?= $_SESSION['message'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['message']); }?>
            <div class="card">
                <div class="card-header">
                    <h4>Add Product</h4>
                </div>
                <div class="card-body">
                    <form action="handelProduct.php" method="Post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Category</label>
                                <select name="category_id" class="form-select">
                                    <option selected>Select Category</option>
                                    <?php
                                        $categories_table = "categories";
                                        $categories = selectAllCategories($categories_table);
                                        if(mysqli_num_rows($categories) > 0) {
                                            foreach($categories as $category)
                                            {
                                            ?>
                                    <option value="<?= $category['id']; ?>">
                                        <?= $category['name']; ?></option>
                                    <?php
                                        }
                                        }
                                        else{
                                            echo "No category available";
                                        }
                                    ?>

                                </select>
                            </div>
                            <div class=" col-md-6">
                                <label for="">Name</label>
                                <input type="text" name="name" placeholder="Enter Category name" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="">Slug</label>
                                <input type="text" name="slug" placeholder="Enter slug" class="form-control">
                            </div>
                            <div class="col-md-12">
                                <label for="">Small Desciption</label>
                                <textarea name="small_description" placeholder="Enter small description"
                                    class="form-control"></textarea>
                            </div>
                            <div class="col-md-12">
                                <label for="">Desciption</label>
                                <textarea name="description" placeholder="Enter description"
                                    class="form-control"></textarea>
                            </div>
                            <div class="col-md-6">
                                <label for="">Price:</label>
                                <input type="number" name="original_price" placeholder="Enter price"
                                    class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="">Selling Price:</label>
                                <input type="number" name="selling_price" placeholder="Enter Price"
                                    class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="">Upload Image</label>
                                <input type="file" name="image" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="">Quantity:</label>
                                <input type="number" required name="quantity" placeholder="Enter Quantity"
                                    class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="">Status</label>
                                <input type="checkbox" name="status" value="1">
                            </div>
                            <div class="col-md-6">
                                <label for="">Trending</label>
                                <input type="checkbox" name="trending" value="1">
                            </div>
                            <div class="col-md-12">
                                <label for="">Meta Title</label>
                                <input type="text" name="meta_title" placeholder="Enter meta title"
                                    class="form-control">
                            </div>
                            <div class="col-md-12">
                                <label for="">Meta Keywords</label>
                                <textarea name="meta_keywords" placeholder="Enter description"
                                    class="form-control"></textarea>
                            </div>
                            <div class="col-md-12">
                                <label for="">Meta Description</label>
                                <textarea name="meta_description" placeholder="Enter description"
                                    class="form-control"></textarea>
                            </div>
                            <div>
                                <button type="submit" name="add_product_btn" class="btn btn-primary">Submit</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- </div>
</div> -->
<?php include_once('../includes/footer.php');?>