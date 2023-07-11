<?php 
 include_once('includes/header.php');
include_once "../functions/handelRegisterAndLogin.php";
include_once '../config/db.php';
include_once '../config/productDb.php';

    $database =new Database();
    $conn = $database->getConnection();

?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>All Products</h4>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $products_table = "products";
                                $products = selectAllProducts($products_table);
                                if (mysqli_num_rows($products) > 0)
                                {
                                    foreach($products as $product)
                                    {
                                    ?>
                            <tr>
                                <td><?= $product["id"]; ?></td>
                                <td><?= $product["name"]; ?></td>
                                <td><?= $product["description"]; ?></td>
                                <td>
                                    <img src="upload/<?= $product["image"];?>" width="50px" height="50px"
                                        alt="<?= $product["name"]; ?>">
                                </td>
                                <td><?= $product["status"] =='0' ? "visible" :"hidden"?></td>
                                <td>

                                    <a href="editProduct.php?id=<?= $product["id"]; ?>"
                                        class="btn btn-secondary">Edit</a>

                                    <form action="handelProduct.php" method="POST">
                                        <input type="hidden" name="category_id" value="<?= $category['id'] ?>">
                                        <button name="delete_product_btn" type="submit" class="btn btn-danger">
                                            Delete</button>
                                    </form>
                                </td>
                            </tr>
                            <?php
                                }
                            }else { echo "No records found." ; }
                          ?>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include_once('../includes/footer.php');
$database->closeConnection();

?>