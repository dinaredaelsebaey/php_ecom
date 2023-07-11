<?php 
 include_once('includes/header.php');
include_once "../functions/handelRegisterAndLogin.php";
include_once '../config/db.php';
include_once '../config/categoryDb.php';

    $database =new Database();
    $conn = $database->getConnection();

?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>All Category</h4>
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
                                $categories_table = "categories";
                                $categories = selectAllCategories($categories_table);
                                if (mysqli_num_rows($categories) > 0)
                                {
                                    foreach($categories as $category)
                                    {
                                    ?>
                            <tr>
                                <td><?= $category["id"]; ?></td>
                                <td><?= $category["name"]; ?></td>
                                <td><?= $category["description"]; ?></td>
                                <td>
                                    <img src="upload/<?= $category["image"];?>" width="50px" height="50px"
                                        alt="<?= $category["name"]; ?>">
                                </td>
                                <td><?= $category["status"] =='0' ? "visible" :"hidden"?></td>
                                <td>

                                    <a href="editCategory.php?id=<?= $category["id"]; ?>"
                                        class="btn btn-secondary">Edit</a>

                                    <form action="handelCatogery.php" method="POST">
                                        <input type="hidden" name="category_id" value="<?= $category['id'] ?>">
                                        <button name="delete_category_btn" type="submit" class="btn btn-danger">
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