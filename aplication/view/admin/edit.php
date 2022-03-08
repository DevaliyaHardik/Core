
<?php $admin=$this->getAdmin(); ?>


<form action="<?php echo $this->getUrl('save','admin',['id'=>$admin->admin_id],true) ?>" method="POST">
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
			<td><input type="text" name="admin[password]" value="<?php echo $admin->password ?>"></td>
		</tr>
		<tr>
			<td width="10%">Status</td>
			<td>
				<select name="admin[status]">
						<option value="1" <?php echo ($this->getStatus($admin->status)=='Enabel')?'selected':'' ?>>Enabel</option>
						<option value="2" <?php echo ($this->getStatus($admin->status)=='Disabled')?'selected':'' ?>>Disabled</option>
				</select>			
			</td>
		</tr>
		<tr>
			<td width="10%">&nbsp;</td>
			<td>
				<input type="submit" name="submit" value="save">
				<button type="button"><a href="<?php echo $this->getUrl('grid','admin') ?>">Cancel</a></button>
			</td>
		</tr>
		
	</table>	
</form>