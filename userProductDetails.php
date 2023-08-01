<?php
include("includes/header.php");
include("config/userDb.php");

$database =new Database();
$conn = $database->getConnection();

if(isset($_GET['product'])){
    $product_table="products" ;
    $product_slug= $_GET['product'];
    $product_data = getActiveSlug($product_table,$product_slug);
    $product = mysqli_fetch_array($product_data);
    if($product)
    {
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
            <?= $product["name"];?>
        </h6>
    </div>
</div>
<div class=" py-5 ">
    <div class=" container">
        <div class="row">
            <div class="col-md-4">
                <img src="admin/upload/<?= $product["image"];?>" class="w-100" alt="<?= $product["name"]; ?>">
            </div>
            <div class="col-md-8">
                <h4><?= $product["name"];?>
                    <span class="float-end text-danger"><?php if($product["trending"]){ echo "Trending";} ?>
                    </span>
                </h4>
                <hr>
                <p><?= $product["small_description"];?></p>
                <div class="row">
                    <div class="col-md-6">
                        <h4> RS <span class="text-success"><?= $product["selling_price"];?> </pan>
                        </h4>
                    </div>
                    <div class="col-md-6">
                        <h4> RS <s class="text-danger"><?= $product["original_price"];?></s></h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <input type="text">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <button type="button" class="btn btn-primary" onclick="addToCart()">Add to
                            Cart</button>

                    </div>
                    <div class="col-md-6">

                        <button type="button" class="btn btn-danger" onclick="addToWishlist()">Add to
                            Wishlist</button>
                    </div>
                </div>

                <hr>
                <p><?= $product["description"];?></p>
            </div>
        </div>
    </div>
</div>
<?php
}else{
echo "product not found";
}

}else{
echo "some thing went wrong";
}
?>
<link rel=" preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link
    href="https://fonts.googleapis.com/css2?family=Joan&family=Kdam+Thmor+Pro&family=Nuosu+SIL&family=Oswald&family=Roboto:ital,wght@1,300&display=swap"
    rel="stylesheet">


<?php
include("includes/footer.php")
?>