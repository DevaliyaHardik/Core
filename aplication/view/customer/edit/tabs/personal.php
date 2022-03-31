<?php $customer = $this->getCustomer(); ?>
<p id="done"></p>
<table border="1" width="100%" cellspacing="4">
    <tr>
        <td colspan="2"><b>Personal Information</b></td>
    </tr>
    <tr>
        <td width="10%">First Name</td>
        <td><input type="text" name="customer[firstName]" value=<?php echo $customer->firstName ?>></td>
    </tr>
    
    <tr>
        <td width="10%">Last Name</td>
        <td><input type="text" name="customer[lastName]" value=<?php echo $customer->lastName ?>></td>
    </tr>
    <tr>
        <td width="10%">Email</td>
        <td><input type="text" name="customer[email]" value=<?php echo $customer->email ?>></td>
    </tr>
    <tr>
        <td width="10%" >Mobile</td>
        <td><input type="text" name="customer[mobile]" id="mobile" value=<?php echo $customer->mobile ?>></td>
    </tr>
    <tr>
        <td width="10%">Status</td>
        <td>
            <select name="customer[status]">
                <option value="1" <?php echo ($customer->getStatus($customer->status)=='Enabel')?'selected':'' ?>>Enabel</option>
                <option value="2" <?php echo ($customer->getStatus($customer->status)=='Disabled')?'selected':'' ?>>Disabled</option>
            </select>			
        </td>
    </tr>
    <tr>
        <td width="10%">&nbsp;</td>
        <td>
            <input type="button" id="customerSubmitBtn" name="submit" value="save & continue">
            <button type="button" id="customerGridBlockBtn">Cancel</button>
        </td>
    </tr>

</table>

<script>
    $("#customerSubmitBtn").click(function(){
        admin.setForm($("#indexForm"));
        admin.setUrl("<?php echo $this->getEdit()->getSaveUrl(); ?>");
        admin.load();
    });

    $("#customerGridBlockBtn").click(function(){
        admin.setUrl("<?php echo $this->getUrl('gridBlock','customer'); ?>");
        admin.load();
    });
</script>