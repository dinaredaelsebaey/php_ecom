<?php
 include_once('includes/header.php');
 include_once('../middleware/adminMiddleware.php');
 ?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Add Category</h4>
                </div>
                <div class="card-body">
                    <form action="handelCatogery.php" method="Post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Name</label>
                                <input type="text" name="name" placeholder="Enter Category name" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="">Slug</label>
                                <input type="text" name="slug" placeholder="Enter slug" class="form-control">
                            </div>
                            <div class="col-md-12">
                                <label for="">Desciption</label>
                                <textarea name="description" placeholder="Enter description"
                                    class="form-control"></textarea>
                            </div>
                            <div class="col-md-6">
                                <label for="">Upload Image</label>
                                <input type="file" name="image" class="form-control">
                            </div>
                            <div class="col-md-12">
                                <label for="">Meta Title</label>
                                <input type="text" name="meta_title" placeholder="Enter meta title"
                                    class="form-control">
                            </div>
                            <div class="col-md-12">
                                <label for="">Meta Description</label>
                                <textarea name="meta_description" placeholder="Enter description"
                                    class="form-control"></textarea>
                            </div>
                            <div class="col-md-12">
                                <label for="">Meta Keywords</label>
                                <textarea name="meta_keywords" placeholder="Enter description"
                                    class="form-control"></textarea>
                            </div>
                            <div class="col-md-6">
                                <label for="">Status</label>
                                <input type="checkbox" name="status">
                            </div>
                            <div class="col-md-6">
                                <label for="">Popular</label>
                                <input type="checkbox" name="popular">
                            </div>
                            <div>
                                <button type="submit" name="add_category_btn" class="btn btn-primary">Submit</button>
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
<?php include_once('includes/footer.php');?>