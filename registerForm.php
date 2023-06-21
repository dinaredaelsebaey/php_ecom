<?php
include "includes/header.php";
include_once "./functions/handelRegisterAndLogin.php";


?>
<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class=" col-md-6">
                <?php if(isset($_SESSION['message'])){ ?>

                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>hi!</strong>
                    <?= $_SESSION['message'] ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php unset($_SESSION['message']); }?>

                <div class="card">
                    <div class="card-header">
                        <h1>Registeration form</h1>
                    </div>
                    <div class="card-body">
                        <form action="functions/handelRegisterAndLogin.php" method="Post">
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" placeholder="enter your name">
                            </div>
                            <div class=" mb-3">
                                <label for="exampleInputEmail1" class="form-label">Email address</label>
                                <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                                    placeholder="enter your email" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Phone</label>
                                <input type="number" name="phone" class="form-control" placeholder="enter your phone">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Password</label>
                                <input type="password" name="password" placeholder="enter your password"
                                    class="form-control" id="exampleInputPassword1">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Confirm Password</label>
                                <input type="password" name="cpassword" class="form-control"
                                    placeholder="enter your password again" id="exampleInputPassword1">
                            </div>

                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
<?php include("includes/footer.php") ?>