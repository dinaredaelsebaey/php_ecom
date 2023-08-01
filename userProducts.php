<?php
include("includes/header.php");
include("config/userDb.php");

$database =new Database();
$conn = $database->getConnection();

$category_table="categories" ;
$category_slug= $_GET['category'];
$category_data = getActiveSlugCategory($category_table,$category_slug);
$category = mysqli_fetch_array($category_data);
$category_id = $category['id'];
?>
<div class="py-3 bg-primary">
    <div class="container">
        <h6 class="text-white">
            <a class="text-white" href="userCategories.php">
                Home /
            </a>
            <a class="text-white" href="userCategories.php">
                Collections /
            </a>
            <?= $category["name"];?>
        </h6>
    </div>
</div>
<div class=" py-5 ">
    <div class=" container">
        <div class="row">
            <div class="col-md-12">
                <h1><?= $category["name"];?></h1>
                <div class="row">
                    <hr>
                    <?php
                
                $products=getProductByCategoryId($category_id);
                if (count($products)> 0)
                {
                    foreach($products as $product)
                    {
                    ?>

                    <div class="col-md-3 mb-2">
                        <a href="#">
                            <div class="card shadow">
                                <div class="card-body">
                                    <img src="admin/upload/<?= $product["image"];?>" class="w-100"
                                        alt="<?= $product["name"]; ?>">
                                    <h4 class="text-center"><?= $product["name"]; ?></h4>

                                </div>
                            </div>
                        </a>
                    </div>
                    <?php
                    }
                }else{
                    echo "Data not available";
                }
            ?>
                </div>
            </div>
        </div>
    </div>
</div>
</div>




<link rel=" preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link
    href="https://fonts.googleapis.com/css2?family=Joan&family=Kdam+Thmor+Pro&family=Nuosu+SIL&family=Oswald&family=Roboto:ital,wght@1,300&display=swap"
    rel="stylesheet">


<?php
include("includes/footer.php")
?>