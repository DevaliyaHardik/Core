
<?php $category = $this->getCategory(); 
print_r)
$hidden = ($category - >password) ? 'hidden' : 'password'; 
?>


<table border="1" width="100%" cellspacing="4">
    <tr>
        <td colspan="2"><b>Category Information</b></td>
    </tr>
    <tr>
        <td width="10%">First Name</td>
        <td><input type="text" name="category [ firstName]" value="<?php echo $category->firstName ?>"></td>
    </tr>
    
    <tr>
        <td width="10%">Last Name</td>
        <td><input type="text" name="category [ lastName]" value="<?php echo $category->lastName ?>"></td>
    </tr>
    <tr>
        <td width="10%">Email</td>
        <td><input type="text" name="category [ email]" value="<?php echo $category->email ?>"></td>
    </tr>
    <tr>
        <td width="10%">Password</td>
        <td><input type="<?php echo $hidden ?>" name="category [ password]" value="<?php echo $category - >password ?>" ></td>
    </tr>
    <tr>
        <td width="10%">Status</td>
        <td>
            <select name="category [ status]">
                    <option value="1" <?php echo ($category - >getStatus($category - >status)=='Enabel')?'selected':'' ?>>Enabel</option>
                    <option value="2" <?php echo ($category - >getStatus($category - >status)=='Disabled')?'selected':'' ?>>Disabled</option>
            </select>			
        </td>
    </tr>
        <td width="10%">&nbsp;</td>
        <td>
            <input type="button" id="submit" name="submit" value="save">
            <button type="button"><a href="<?php echo $this->getUrl('grid','category ' ,['id' => null]) ?>">Cancel</a></button>
        </td>
    </tr>		
</table>	
