<?php $config=$this->getConfig(); ?>

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
					<option value="1" <?php echo ($this->getStatus($config->status)=='Enabel')?'selected':'' ?>>Enabel</option>
					<option value="2" <?php echo ($this->getStatus($config->status)=='Disabled')?'selected':'' ?>>Disabled</option>
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
