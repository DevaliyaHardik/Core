
<?php $config=$this->getConfig(); 
?>

<?php

	


?>
<html>
<head><title>Config Edit</title></head>
<body>

<form action="<?php echo $this->getUrl('save','config',['id'=>$config->config_id],true) ?>" method="POST">
	<table border="1" width="100%" cellspacing="4">
		<tr>
			<td colspan="2"><b>Config Information</b></td>
		</tr>
		<tr>
			<td width="10%">Name</td>
			<td><input type="text" name="config[name]" value="<?php echo $config->name ?>"></td>
		</tr>
		
		<tr>
			<td width="10%">Code</td>
			<td><input type="text" name="config[code]" value="<?php echo $config->code ?>"></td>
		</tr>
		<tr>
			<td width="10%">Value</td>
			<td><input type="text" name="config[value]" value="<?php echo $config->value ?>"></td>
		</tr>
		<tr>
			<td width="10%">Status</td>
			<td>
				<select name="config[status]">
					<?php if($config->status==1): ?>
					<option value="1" selected>Enabled</option>
					<option value="2">Disabled</option>
					<?php else: ?>
					<option value="1">Enabled</option>
					<option value="2" selected>Disabled</option>				
					<?php endif; ?>
				</select>
			</td>
		</tr>
		<tr>
			<td width="10%">&nbsp;</td>
			<td>
				<input type="submit" name="submit" value="save">
				<button type="button"><a href="<?php echo $this->getUrl('grid','config') ?>">Cancel</a></button>
			</td>
		</tr>
		
	</table>	
</form>
</body>
</html>