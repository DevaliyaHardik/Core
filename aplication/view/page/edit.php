<?php $page=$this->getPage(); ?>

<form action="<?php echo $this->getUrl('save','page',['id'=>$page->page_id]) ?>" method="POST">
	<table border="1" width="100%" cellspacing="4">
		<tr>
			<td colspan="2"><b>Page Information</b></td>
		</tr>
		<tr>
			<td width="10%">Name</td>
			<td><input type="text" name="page[name]" value="<?php echo $page->name ?>"></td>
		</tr>
		
		<tr>
			<td width="10%">Code</td>
			<td><input type="text" name="page[code]" value="<?php echo $page->code ?>"></td>
		</tr>
		<tr>
			<td width="10%">Value</td>
			<td><textarea name="page[content]" value="<?php echo $page->content ?>" id="" cols="30" rows="10"><?php echo $page->content ?></textarea></td>
		</tr>
		<tr>
			<td width="10%">Status</td>
			<td>
				<select name="page[status]">
					<option value="1" <?php echo ($page->getStatus($page->status)=='Enabel')?'selected':'' ?>>Enabel</option>
					<option value="2" <?php echo ($page->getStatus($page->status)=='Disabled')?'selected':'' ?>>Disabled</option>
				</select>			
			</td>
		</tr>
		<tr>
			<td width="10%">&nbsp;</td>
			<td>
				<input type="submit" name="submit" value="save">
				<button type="button"><a href="<?php echo $this->getUrl('grid','page',['id' => null]) ?>">Cancel</a></button>
			</td>
		</tr>
		
	</table>	
</form>