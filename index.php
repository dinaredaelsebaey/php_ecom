<?php
include("includes/header.php");

if(isset($_SESSION['message'])){
 ?>

<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>hi!</strong>
    <?= $_SESSION['message'] ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php unset($_SESSION['message']); }
?>

<h1>Hello, world!</h1>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link
    href="https://fonts.googleapis.com/css2?family=Joan&family=Kdam+Thmor+Pro&family=Nuosu+SIL&family=Oswald&family=Roboto:ital,wght@1,300&display=swap"
    rel="stylesheet">


<?php
include("includes/footer.php")
?>