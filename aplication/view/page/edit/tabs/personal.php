<?php $page=$this->getPage(); ?>

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
                <div class="form-group">
                <label for="exampleInputFirstName1">Name</label>
                <input type="text" name="page[name]" value="<?php echo $page->name ?>" class="form-control" id="exampleInputFirstName1" placeholder="Enter First Name">
                </div>
                <div class="form-group">
                <label for="exampleInputLastName1">Code</label>
                <input type="text" name="page[code]" value="<?php echo $page->code ?>" class="form-control" id="exampleInputLastName1" placeholder="Enter Last Name">
                </div>
                <div class="form-group">
                <label for="exampleInputEmail1">Content</label>
                <input type="email" name="page[content]" value="<?php echo $page->content ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter Email">
                </div>
                <div class="row">
					<div class="col-sm-6">
						<!-- select -->
						<div class="form-group">
						<label>Status</label>
						<select class="form-control" name="page[status]">
							<option value="1" <?php echo ($page->getStatus($page->status)=='Enabel')?'selected':'' ?>>Enabel</option>
							<option value="2" <?php echo ($page->getStatus($page->status)=='Disabled')?'selected':'' ?>>Disabled</option>
						</select>
						</div>
					</div>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <input type="button" id="pageFormSubmitBtn" class="btn btn-primary" name="submit" value="save">
                <button type="button" id="pageFromCancelBtn" class="btn btn-primary" >Cancel</button>
            </div>
        </div>
        <!-- /.card -->
        </div>
    </div>
    <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>

<script type="text/javascript">

jQuery("#pageFromCancelBtn").click(function(){
	admin.setUrl("<?php echo $this->getUrl('gridBlock','page',['id' => null]); ?>");
	admin.load();
});

jQuery("#pageFormSubmitBtn").click(function(){
	admin.setForm(jQuery("#indexForm"));
	admin.setUrl("<?php echo $this->getEdit()->getSaveUrl();?>");
	admin.load();
});
</script>
