<?php 
 include_once('includes/header.php');
include_once "../functions/handelRegisterAndLogin.php";

    $database =new Database();
    $conn = $database->getConnection();
    $sql = "SELECT * FROM categories";
    $categories = mysqli_query($conn, $sql);
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
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
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
                                <td><?= $category["status"]; ?></td>
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