<?php 
$categoryData = $this->getCategory(); 
$categories = $this->getCategories();
?>

<section class="content">
    <div class="container-fluid">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
            <h3 class="card-title">Personal Information</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="col-sm-12">
                    <!-- select -->
                    <div class="form-group">
                        <label>Subcategory</label>
                        <select class="form-control" name="category[parent_id]" id="parentId">
                        <option value="<?php echo null; ?>" <?php echo ($categoryData->parent_id == NULL) ? 'selected' : ''; ?>>Root Category</option>
                        <?php foreach($categories as $category): ?>
                            <?php if($categoryData->category_id != $category->category_id):  ?>
                            <option value="<?php echo $category->category_id; ?>" <?php echo ($categoryData->parent_id == $category->category_id) ? 'selected' : ''; ?>><?php echo $this->getPath($category->category_id,$category->path); ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputFirstName1">Category Name</label>
                    <input type="text" name="category[name]" value="<?php echo $categoryData->name; ?>" class="form-control" id="exampleInputFirstName1" placeholder="Enter Category Name">
                </div>
                <div class="row">
                <div class="col-sm-12">
                    <!-- select -->
                    <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" name="category[status]">
                        <option value="1" <?php echo ($categoryData->getStatus($categoryData->status)=='Enabel')?'selected':'' ?>>Enabel</option>
                        <option value="2" <?php echo ($categoryData->getStatus($categoryData->status)=='Disabled')?'selected':'' ?>>Disabled</option>
                    </select>
                    </div>
                </div>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <input type="button" id="categoryFormSubmitBtn" class="btn btn-primary" name="submit" value="save">
                <button type="button" id="categoryFromCancelBtn" class="btn btn-primary" >Cancel</button>
            </div>
        </div>
        <!-- /.card -->
        </div>
    </div>
    <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>

<script type="text/javascript">
    
    jQuery("#categoryFromCancelBtn").click(function(){
        admin.setData({'id' : null});
        admin.setUrl("<?php echo $this->getUrl('gridBlock','category',['id' => null]); ?>");
        admin.load();
    });

    jQuery("#categoryFormSubmitBtn").click(function(){
        admin.setForm(jQuery("#indexForm"));
        admin.setUrl("<?php echo $this->getEdit()->getSaveUrl();?>");
        admin.load();
    });
</script>