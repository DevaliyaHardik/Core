
<?php $admin=$this->getAdmin(); 
$hidden = ($admin->password) ? 'hidden' : 'password'; 
?>


<table border="1" width="100%" cellspacing="4">
    <tr>
        <td colspan="2"><b>Admin Information</b></td>
    </tr>
    <tr>
        <td width="10%">First Name</td>
        <td><input type="text" name="admin[firstName]" value="<?php echo $admin->firstName ?>"></td>
    </tr>
    
    <tr>
        <td width="10%">Last Name</td>
        <td><input type="text" name="admin[lastName]" value="<?php echo $admin->lastName ?>"></td>
    </tr>
    <tr>
        <td width="10%">Email</td>
        <td><input type="text" name="admin[email]" value="<?php echo $admin->email ?>"></td>
    </tr>
    <tr>
        <td width="10%">Password</td>
        <td><input type="<?php echo $hidden ?>" name="admin[password]" value="<?php echo $admin->password ?>" ></td>
    </tr>
    <tr>
        <td width="10%">Status</td>
        <td>
            <select name="admin[status]">
                    <option value="1" <?php echo ($admin->getStatus($admin->status)=='Enabel')?'selected':'' ?>>Enabel</option>
                    <option value="2" <?php echo ($admin->getStatus($admin->status)=='Disabled')?'selected':'' ?>>Disabled</option>
            </select>			
        </td>
    </tr>
        <td width="10%">&nbsp;</td>
        <td>
            <input type="button" id="adminFormSubmitBtn" name="submit" value="save">
            <button type="button" id="adminFromCancelBtn" >Cancel</button>
        </td>
    </tr>		
</table>	

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
