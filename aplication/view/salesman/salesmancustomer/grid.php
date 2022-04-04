<?php 
$customers = $this->getCustomers();
?>
<h3>Avalilabel Customer</h3>
<input type="button" id="salesmanCustomerFormSubmitBtn" class="btn btn-info" value="save">
<button type="button" id="salesmanCustomerFromCancelBtn" class="btn btn-info">Cancel</button>

<table class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>Select</th>
        <th>Customer Id</th>
        <th>First Name</th>
        <th>Last Name</th>
    </tr>
    </thead>
    <tbody>
    <?php if(!$customers): ?>
    <tr>
        <td colspan="8">No Record Found</td>
    </tr>
    <?php else: ?>
        <?php foreach ($customers as $customer): ?>
        <tr>
            <td><input type="checkbox" name="customer[]" value='<?php echo $customer->customer_id; ?>' <?php echo $this->selected($customer->customer_id); ?> ></td>
            <td><?php echo $customer->customer_id; ?></td>
            <td><?php echo $customer->firstName; ?></td>
            <td><?php echo $customer->lastName; ?></td>
        </tr>
    <?php endforeach; ?>
    <?php endif; ?>
    </tbody>
</table>


<script type="text/javascript">

jQuery("#salesmanCustomerFromCancelBtn").click(function(){
	admin.setUrl("<?php echo $this->getUrl('gridBlock','salesman',['id' => null]); ?>");
	admin.load();
});

jQuery("#salesmanCustomerFormSubmitBtn").click(function(){
	admin.setForm(jQuery("#indexForm"));
	admin.setUrl("<?php echo $this->getSaveUrl();?>");
	admin.load();
});
</script>