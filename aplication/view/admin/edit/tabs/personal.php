<?php 
$admin = $this->getAdmin(); 
$disabel = (!$admin->password) ? true : false;
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
                <div class="form-group">
                <label for="exampleInputFirstName1">First Name</label>
                <input type="text" name="admin[firstName]" value="<?php echo $admin->firstName ?>" class="form-control" id="exampleInputFirstName1" placeholder="Enter First Name">
                </div>
                <div class="form-group">
                <label for="exampleInputLastName1">Last Name</label>
                <input type="text" name="admin[lastName]" value="<?php echo $admin->lastName ?>" class="form-control" id="exampleInputLastName1" placeholder="Enter Last Name">
                </div>
                <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input type="email" name="admin[email]" value="<?php echo $admin->email ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter Email">
                </div>
                <?php if($disabel): ?>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="text" name="admin[password]" value="<?php echo $admin->password ?>" class="form-control" id="exampleInputPassword1" placeholder="Enter Password">
                  </div>
                <?php endif; ?>
                <div class="row">
                <div class="col-sm-6">
                    <!-- select -->
                    <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" name="admin[status]">
                        <option value="1" <?php echo ($admin->getStatus($admin->status)=='Enabel')?'selected':'' ?>>Enabel</option>
                        <option value="2" <?php echo ($admin->getStatus($admin->status)=='Disabled')?'selected':'' ?>>Disabled</option>
                    </select>
                    </div>
                </div>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <input type="button" id="adminFormSubmitBtn" class="btn btn-primary" name="submit" value="save">
                <button type="button" id="adminFromCancelBtn" class="btn btn-primary" >Cancel</button>
            </div>
        </div>
        <!-- /.card -->
        </div>
    </div>
    <!-- /.row -->
    </div>
</section>

<script type="text/javascript">
    
    jQuery("#adminFromCancelBtn").click(function(){
        admin.setUrl("<?php echo $this->getUrl('gridBlock','admin',['id' => null]); ?>");
        admin.load();
    });

    jQuery("#adminFormSubmitBtn").click(function(){
        admin.setForm(jQuery("#indexForm"));
        admin.setUrl("<?php echo $this->getEdit()->getSaveUrl();?>");
        admin.load();
    });
</script>