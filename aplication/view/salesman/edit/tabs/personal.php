<?php $salesman = $this->getSalesman(); ?> 

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
                <input type="text" name="salesman[firstName]" value="<?php echo $salesman->firstName ?>" class="form-control" id="exampleInputFirstName1" placeholder="Enter First Name">
                </div>
                <div class="form-group">
                <label for="exampleInputLastName1">Last Name</label>
                <input type="text" name="salesman[lastName]" value="<?php echo $salesman->lastName ?>" class="form-control" id="exampleInputLastName1" placeholder="Enter Last Name">
                </div>
                <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input type="email" name="salesman[email]" value="<?php echo $salesman->email ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter Email">
                </div>
                <div class="form-group">
                <label for="exampleInputMobile1">Mobile</label>
                <input type="text" name="salesman[mobile]" value="<?php echo $salesman->mobile ?>" class="form-control" id="exampleInputMobile1" placeholder="Enter Email">
                </div>
                <div class="form-group">
                <label for="exampleInputMobile1">Persantage</label>
                <input type="text" name="salesman[percentage]" value="<?php echo $salesman->percentage ?>" class="form-control" id="exampleInputMobile1" placeholder="Enter Email">
                </div>
                <div class="row">
                <div class="col-sm-12">
                    <!-- select -->
                    <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" name="salesman[status]">
                        <option value="1" <?php echo ($salesman->getStatus($salesman->status)=='Enabel')?'selected':'' ?>>Enabel</option>
                        <option value="2" <?php echo ($salesman->getStatus($salesman->status)=='Disabled')?'selected':'' ?>>Disabled</option>
                    </select>
                    </div>
                </div>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <input type="button" id="slaesmanFormSubmitBtn" class="btn btn-primary" name="submit" value="save">
                <button type="button" id="slaesmanFromCancelBtn" class="btn btn-primary" >Cancel</button>
            </div>
        </div>
        <!-- /.card -->
        </div>
    </div>
    <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>

<script type="text/javascript">

jQuery("#slaesmanFromCancelBtn").click(function(){
	admin.setUrl("<?php echo $this->getUrl('gridBlock','salesman',['id' => null]); ?>");
	admin.load();
});

jQuery("#slaesmanFormSubmitBtn").click(function(){
	admin.setForm(jQuery("#indexForm"));
	admin.setUrl("<?php echo $this->getEdit()->getSaveUrl();?>");
	admin.load();
});
</script>

