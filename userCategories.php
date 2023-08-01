<?php
include("includes/header.php");
include("config/userDb.php");

$database =new Database();
$conn = $database->getConnection();
?>
<div class="py-3 bg-primary">
    <div class="container">
        <h6 class="text-white">Home / Collections</h6>
    </div>
</div>
<div class=" py-5">
    <div class=" container">
        <div class="row">
            <div class="col-md-12">
                <h1>Our Collections</h1>
                <hr>
                <div class="row">
                    <?php
                $categories_table="categories" ;
                $categories =getActiveCategory($categories_table);
                if (mysqli_num_rows($categories) > 0)
                {
                    foreach($categories as $category)
                    {
                    ?>

                    <div class="col-md-3 mb-2">
                        <a href="userProducts.php?category=<?= $category["slug"];?>">
                            <div class="card shadow">
                                <div class="card-body">
                                    <img src="admin/upload/<?= $category["image"];?>" class="w-100"
                                        alt="<?= $category["name"]; ?>">
                                    <h4 class="text-center"><?= $category["name"]; ?></h4>
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





<link rel=" preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link
    href="https://fonts.googleapis.com/css2?family=Joan&family=Kdam+Thmor+Pro&family=Nuosu+SIL&family=Oswald&family=Roboto:ital,wght@1,300&display=swap"
    rel="stylesheet">


<?php
include("includes/footer.php")
?>