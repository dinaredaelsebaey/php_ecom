<?php
 include_once('includes/header.php');
 include_once('../middleware/adminMiddleware.php');
 include_once '../config/db.php';
 include_once '../config/categoryDb.php';

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
            <?php
             if(isset($_GET['id']))
             { 
                $id = $_GET['id'];
                $sql = "SELECT * FROM categories WHERE id = $id";
                $result = mysqli_query($conn, $sql);
                if(mysqli_num_rows($result) > 0) {
                    $category = mysqli_fetch_assoc($result);
            ?>
            <div class="card">
                <div class="card-header">
                    <h4>Edit Category</h4>
                </div>
                <div class="card-body">
                    <form action="handelCatogery.php" method="Post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Name</label>
                                <input type="text" name="name" value="<?= $category['name'] ?>"
                                    placeholder="Enter Category name" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="">Slug</label>
                                <input type="text" name="slug" value="<?= $category['slug'] ?>" placeholder="Enter slug"
                                    class="form-control">
                            </div>
                            <div class="col-md-12">
                                <label for="">Desciption</label>
                                <textarea name="description" placeholder="Enter description"
                                    class="form-control"><?= $category['description'] ?></textarea>
                            </div>
                            <div class="col-md-6">
                                <label for="">Upload Image</label>
                                <input type="file" name="image" class="form-control">
                                <img src="upload/<?= $category['image'] ?>" alt="<?= $category['name'] ?>" width="50px">
                            </div>
                            <div class="col-md-12">
                                <label for="">Meta Title</label>
                                <input type="text" name="meta_title" value="<?= $category['meta_title'] ?>"
                                    placeholder="Enter meta title" class="form-control">
                            </div>
                            <div class="col-md-12">
                                <label for="">Meta Description</label>
                                <textarea name="meta_description" placeholder="Enter description"
                                    class="form-control"><?= $category['meta_description'] ?></textarea>
                            </div>
                            <div class="col-md-12">
                                <label for="">Meta Keywords</label>
                                <textarea name="meta_keywords" placeholder="Enter description"
                                    class="form-control"><?= $category['meta_keywords'] ?></textarea>
                            </div>
                            <div class="col-md-6">
                                <label for="">Status</label>
                                <input type="checkbox" name="status" <?= $category['status'] == 1 ? 'checked' : '' ?>>
                            </div>
                            <div class="col-md-6">
                                <label for="">Popular</label>
                                <input type="checkbox" name="popular" <?= $category['popular'] == 1 ? 'checked' : '' ?>>
                            </div>
                            <div>
                                <button type="submit" name="add_category_btn" class="btn btn-primary">Submit</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
            <?php
                } else {
                    echo "Category with ID $id does not exist";
                }
             }else{
                echo "id missing from url";
            }
            
            ?>
        </div>
    </div>
</div>
<!-- </div>
</div> -->
<?php include_once('../includes/footer.php');

$database->closeConnection();
?>